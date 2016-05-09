<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Admin\ManageBookingController;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlayerRequest;
use App\Models\Auth\User;
use App\Models\Booking;
use App\Models\Contexts\Club;
use App\Models\Contexts\Court;
use App\Models\Payments\Payment;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class CheckoutController extends Controller
{

    public function index(Request $request)
    {
        $errors = [];
        $court = null;
        if(!Input::has('court') || !Input::has('hour_start') ||  !Input::has('hour_length') || !Input::has('date') ){
        }
        else{
            $court = Court::with('club','surface')->find($request->input('court'));
            if($court){
                $input = [
                    'date' => $request->input('date'),
                    'type' => 'open',
                    'hour_start' => $request->input('hour_start'),
                    'hour_length' => $request->input('hour_length'),
                    'member' => 0,
                    'court_id' => $court['id']
                ];
                $court['booking_type'] = "open";
                $court['price'] = getPriceForBooking($input);
            }else{
                $errors[] = "Not found data";
            }
        }
        return view('home.checkout.index',compact('request','court'));
    }

<<<<<<< .mine
    //post checkOut
    public function postCheckout(Request $request){
        //return $_POST;
        $input_validate = [
            'date' => 'required',
            'court' => 'required',
            'hour_start' => 'required',
            'hour_length' => 'required',
            'customer.title' => 'required',
            'customer.first_name' => 'required',
            'customer.last_name' => 'required',
            'customer.phone' => 'required',
            'customer.zip_code' => 'required',
            'customer.address1' => 'required',
            'customer.city' => 'required',
            'customer.state' => 'required',
            'payment.method' => 'required',
            'payment.card-number' => 'required',
            'payment.card-expiry' => 'required',
            'payment.cvv' => 'required',
        ];
        if($request->input('is_customer') == 0 && !Auth::check()){
            $input_validate['customer.email'] = 'required|max:60|min:6|unique:users,email';
            $input_validate['customer.password'] = 'required|min:8|confirmed';
            $input_validate['customer.password_confirmation'] = 'required|min:8';





































        }
=======
    //post checkOut
    public function postCheckout(Request $request){
        //return $_POST;
        $v = \Validator::make($request->all(), [
            'date' => 'required',
            'court' => 'required',
            'hour_start' => 'required',
            'hour_length' => 'required',
            'customer.title' => 'required',
            'customer.first_name' => 'required',
            'customer.last_name' => 'required',
            'customer.phone' => 'required',
            'customer.email' => 'required|email',
            'customer.zipcode' => 'required',
            'customer.address1' => 'required',
            'customer.city' => 'required',
            'customer.state' => 'required',
            'payment.method' => 'required',
            'payment.card-number' => 'required',
            'payment.card-expiry' => 'required',
            'payment.cvv' => 'required',
        ]);
        if($v->fails())
            return ['error' => true,"messages"=>$v->errors()->all()];
        else{
            $input = [
                'date'=> $request->input('date'),
                'type' => 'open',
                'contract_id' => null,
                'dayOfWeek' => '',
                'extra_id' => [],
                'teacher_id' => null,
                'hour_start'=> $request->input('hour_start'),
                'hour_length'=> $request->input('hour_length'),
                'court_id'=> $request->input('court'),
                'member'=> 0
            ];
            $bookingClass = new ManageBookingController();
            $result_prices = $bookingClass->calPriceForBooking($input);
            if(isset($result_prices['success'])) {

                //if ($inputBookingDetail->member == 1) {
                    //$player_id = $customerDetail->player_id;
                    //$billing_info = json_encode([]);
//                } else {
                    $player_id = 0;
                    $billing_info = json_encode($request->input('customer'));
//                }

                $expiry = explode("/", $request->input('payment.card-expiry'));
                //stripe
                try {
                    $token = Stripe::tokens()->create([
                        'card' => [
                            'number' => $request->input('payment.card-number'),
                            'exp_month' => $expiry[0],
                            'exp_year' => $expiry[1],
                            'cvv' => $request->input('payment.cvv'),
                        ],
                    ]);
                } catch (CardErrorException $e) {
                    return ['error' => true, "messages" => [$e->getMessage()]];
                }
>>>>>>> .theirs

<<<<<<< .mine
        $v = \Validator::make($request->all(), $input_validate);
        if($v->fails())
            return response()->json(['error' => true,"messages"=>$v->errors()->all()]);
        else{
            $input_customer = $request->input('customer');
            unset($input_customer['password_confirmation']);

            $input_booking = [
                'date'=> $request->input('date'),
                'type' => 'open',
                'contract_id' => null,
                'dayOfWeek' => '',
                'extra_id' => [],
                'teacher_id' => null,
                'hour_start'=> $request->input('hour_start'),
                'hour_length'=> $request->input('hour_length'),
                'court_id'=> $request->input('court'),
                'member'=> 0
            ];
            $result_prices = getPriceForBooking($input_booking); // get prices

            if(isset($result_prices['success'])) {
                $expiry = explode("/", $request->input('payment.card-expiry'));
                //stripe check validate card
                try {
                    $token = Stripe::tokens()->create([
                        'card' => [
                            'number' => $request->input('payment.card-number'),
                            'exp_month' => $expiry[0],
                            'exp_year' => $expiry[1],
                            'cvv' => $request->input('payment.cvv'),
                        ],
                    ]);
                } catch (CardErrorException $e) {
                    return response()->json(['error' => true, "messages" => [$e->getMessage()]]);










=======
                $customer = Stripe::customers()->create([
                    'email' => $request->input('customer.email'),
                    'source' => $token['id'],
                ]);

                $charge = Stripe::charges()->create([
                    'customer' => $customer['id'],
                    'currency' => 'USD',
                    'amount' => $result_prices['total_price'],
                ]);

                $payment = Payment::create([
                    'user_id' => 0,
                    'card_number' => $request->input('payment.card-number'),
                    'amount' => $result_prices['total_price'],
                    'exp_month' => $expiry['0'],
                    'exp_year' => $expiry['1'],
                    'cvv' => $request->input('payment.cvv'),
                    'stripe_transaction_id' => $charge['id'],
                ]);

                //save with type open
                {
                    $booking = Booking::create([
                        'payment_id' => $payment['id'],
                        'type' => 'open',
                        'date' => $request->input('date'),
                        'contract_id' => null,
                        'day_of_week' => null,
                        'court_id' => $request->input('court'),
                        'extra_id' => json_encode([]),
                        'teacher_id' => 0,
                        'is_member' => 0,
                        'total_price' => $result_prices['total_price'],
                        'hour' => $request->input('hour_start'),
                        'hour_length' => $request->input('hour_length'),
                        'player_id' => $player_id,
                        'num_player' => $request->input('player_num'),
                        'billing_info' => json_encode($billing_info),
                        'payment_info' => json_encode($request->input('payment'))
                    ]);
                    return [
                        'success' => true,
                        'payment_id' => $payment['id']
                    ];
>>>>>>> .theirs
                }

<<<<<<< .mine
                if($request->input('is_customer') == 0 && !Auth::check()){ //create user
                    $user = new User;
                    $input_customer['password'] = bcrypt($input_customer['password']);
                    $user->fill($input_customer)->save();
                    $user->assignRole('player', 'players', 0);
                    Auth::attempt(['email'=>$user['email'],'password'=>$request->input('customer.password')]);
                    $input_customer['player_id'] = $user['id'];
                }else{ //get info user is login
                    $input_customer['player_id'] = Auth::user()->id;
                    $input_customer['email'] = Auth::user()->email;
                    unset($input_customer['password']);
                }

                // payment
                $customer = Stripe::customers()->create([
                    'email' => $input_customer['email'],
                    'source' => $token['id'],
                ]);

                $charge = Stripe::charges()->create([
                    'customer' => $customer['id'],
                    'currency' => 'USD',
                    'amount' => $result_prices['total_price'],
                ]);

                $payment = Payment::create([
                    'user_id' => $input_customer['player_id'],
                    'card_number' => $request->input('payment.card-number'),
                    'amount' => $result_prices['total_price'],
                    'exp_month' => $expiry['0'],
                    'exp_year' => $expiry['1'],
                    'cvv' => $request->input('payment.cvv'),
                    'stripe_transaction_id' => $charge['id'],
                ]);

                //save with type open
                $booking = Booking::create([
                    'payment_id' => $payment['id'],
                    'type' => 'open',
                    'date' => $request->input('date'),
                    'contract_id' => null,
                    'day_of_week' => null,
                    'court_id' => $request->input('court'),
                    'extra_id' => json_encode([]),
                    'teacher_id' => 0,
                    'is_member' => 0,
                    'total_price' => $result_prices['total_price'],
                    'hour' => $request->input('hour_start'),
                    'hour_length' => $request->input('hour_length'),
                    'player_id' => $input_customer['player_id'],
                    'num_player' => $request->input('player_num'),
                    'players_info' => json_encode(['name'=>$request->input('player_name'),'email'=>$request->input('player_email')]),
                    'billing_info' => json_encode($input_customer),
                    'payment_info' => json_encode($request->input('payment'))
                ]);
                return response()->json([
                    'success' => true,
                    'payment_id' => $payment['id']
                ]);

            }
            else{
                return response()->json( ['error' => true, "messages" => ['Error. Input invalid'],'data'=>$result_prices]);
            }
        }

    }
}
=======
            }else{
                return ['error' => true, "messages" => ['Error. Input invalid'],'data'=>$result_prices];









            }
        }

    }
}




















































>>>>>>> .theirs
