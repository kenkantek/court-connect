<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlayerRequest;
use App\Models\Auth\User;
use App\Models\Booking;
use App\Models\Player;
use App\Models\RefundTransaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Cartalyst\Stripe\Laravel\Facades\Stripe;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',['except' => ['getSignUp','checkUpdateBooking']]);
    }

    public function getIndex()
    {
        return view('home.index');
    }

    public function getSignUp()
    {
        return view('home.signup');
    }

    public function postSignUp(PlayerRequest $request)
    {
        $user = new User();
        $user->first_name = $request->firstname;
        $user->last_name = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->remember_token = $request->_token;
        $user->fullname = $request->firstname . " " . $request->lastname;
        $user->save();

        $user_id = $user->id;

        $player = new Player();
        $player->user_id = $user_id;
        $player->receive_discount_offers = $request->cb_offers;
        $player->is_recive_notification = 1;
        $player->save();

        return view('home.index');
    }

    public function getAccount()
    {
        $bookings = Booking::join('courts', 'courts.id', '=', 'bookings.court_id')
            ->join('clubs', 'clubs.id', '=', 'courts.club_id')
            ->where('player_id', Auth::user()->id)
            ->get(['bookings.*','courts.name as court_name','clubs.id as club_id','clubs.name as club_name', 'clubs.address as club_address']);
        return view('home.user.account', compact('bookings'));
    }

    public function updateSettingPassword(Request $request)
    {
        $user = Auth::user();
        if ($request->password != $request->cfrpassword) {
            return back()->withInput()->with(['flash_level' => 'danger', 'flash_message' => 'Password Is Not Match']);
        }else if (!Hash::check($request->old_password, $user->password)) {
            return back()->withInput()->with(['flash_level' => 'danger', 'flash_message' => 'Old Password Is Not Correct']);
        } else {
            if ($request->password == "") {
                return back()->withInput()->with(['flash_level' => 'danger', 'flash_message' => 'Please Enter New Password']);
            } else {
                $user->password = Hash::make($request->password);
                $user->save();
                return back()->withInput()->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Update Password!']);
            }

        }
    }

    public function updateSettingContact(Request $request)
    {
        $user = Auth::user();
        $user->phone = $request->phone;
        $user->save();
        return back()->withInput()->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Update Contact!']);
    }

    public function updateSettingAddress(Request $request)
    {
        $user = Auth::user();
        $user->zip_code = $request->zip_code;
        $user->address1 = $request->address1;
        $user->address2 = $request->address2;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->save();
        return back()->withInput()->with(['flash_level' => 'success', 'flash_message' => 'Success! Complete Update Address!']);
    }

    //check update booking
    public function checkActionUpdateBooking(Request $request){
        $id = $request->input('id');
        if(!Auth::check()){
            return response()->json([
                'error' => true,
                'message' =>'Not login'
            ]);
        }
        $booking = Booking::where(['id'=>$id,'player_id'=>Auth::user()->id])->first();
        if(!isset($booking)){
            return response()->json([
                'error' => true,
                'message' => 'Booking not exist'
            ]);
        }else{

            $date_booking = date_create($booking['date']);
            $intpart = floor($booking['hour']);
            $fraction = $booking['hour'] - $intpart;
            date_time_set($date_booking, $intpart, $fraction);

            if(strtotime(date_format($date_booking, 'Y-m-d H:i:s')) - strtotime("now") < 86400) // < 24hour
            {
                return response()->json([
                    'error' => true,
                    'message' => 'A Reservation cannot be cancelled 24 hours before the booking time.'
                ]);
            }
            return response()->json([
                'error' => false,
                'message' => 'Amount for booking will full refund after cancel booking'
            ]);
        }
    }

    //cancel booking
    public function cancelBooking(Request $request){
        $check = json_decode($this->checkActionUpdateBooking($request));
        if($check['error']){
            return response()->json([
                'error' => true,
                'message' =>$check['message']
            ]);
        }else{
            $booking = Booking::with('payment')->where(['id'=>$request['id'],'player_id'=>Auth::user()->id])->first();
            try {
                $refund = Stripe::refunds()->create($booking['payment']['stripe_transaction_id'],$booking['payment']['amount'],[
                    'metadata' => [
                        'reason'      => 'Customer requested for the refund.',
                        'refunded_by' => 'Court Connect',
                    ],
                ]);
                if($refund['status'] == 'succeeded'){

                    RefundTransaction::create([
                        'refund_id' => $refund['id'],
                        'amount' => $booking['payment']['amount']
                    ]);
                    $booking->update(['status_update'=>'cancel']);
                    return response()->json([
                        'error' => false,
                        'message' => 'Cancel success.'
                    ]);
                }else{
                    return response()->json([
                        'error' => true,
                        'message' => "Transaction error. Please contact Admin website"
                    ]);
                }
            }catch (Exception $e){
                dd($e->getMessage());
                return response()->json([
                    'error' => true,
                    'message' => "Charge has already been refunded. Please contact Admin website"//$e->getMessage()
                ]);
            }

            return $refund;
        }
    }
}