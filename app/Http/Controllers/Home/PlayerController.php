<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlayerRequest;
use App\Models\Auth\User;
use App\Models\Booking;
use App\Models\Player;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PlayerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',['except' => ['getSignUp','postSignUp']]);
    }

    public function getIndex()
    {
        return view('home.index');
    }

    public function getSignUp()
    {
        return view('home.users.signup');
    }

    public function postSignUp(PlayerRequest $request)
    {
        $user = new User();
        $user->first_name = $request->firstname;
        $user->last_name = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->remember_token = $request->_token;
        $user->verify_code = str_random(30);
        $user->save();

        $user_id = $user->id;

        $player = new Player();
        $player->user_id = $user_id;
        $player->receive_discount_offers = $request->cb_offers;
        $player->is_receive_notification = 1;
        $player->save();

        Auth::attempt(['email'=>$request->input('email'),'password'=>$request->input('password')]);
        return redirect(route("home.acount"));
    }

    public function getAccount()
    {
        $bookings = Booking::join('courts', 'courts.id', '=', 'bookings.court_id')
            ->join('clubs', 'clubs.id', '=', 'courts.club_id')
            ->where('player_id', Auth::user()->id)
            ->orderBy('created_at','desc')
            ->groupBy('payment_id')
            ->get(['bookings.*','courts.name as court_name','clubs.id as club_id','clubs.image as club_image','clubs.name as club_name', 'clubs.address as club_address']);
        return view('home.users.account', compact('bookings'));
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

    public function updateSettingOther(Request $request)
    {
        $player = Player::where('user_id',Auth::user()->id)->first();
        if(isset($player)) {
            $player['receive_discount_offers'] = isset($request->cb_offers) ? $request->cb_offers : 0;
            $player['tenis_level'] = $request->skill;

            $player->save();
        }else{
            $player = [
                'user_id' => Auth::user()->id,
                'receive_discount_offers' => isset($request->cb_offers) ? 1 : 0,
                'tenis_level' => $request->skill
            ];
            Player::create($player);
        }
        return back()->withInput()->with(['flash_level' => 'success', 'flash_message' => 'Update Successful!']);
    }
}