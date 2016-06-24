<?php

namespace App\Http\Controllers\Home;

use App\Events\UserBookingEvent;
use App\Http\Controllers\Admin\ManageBookingController;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlayerRequest;
use App\Models\Auth\User;
use App\Models\Booking;
use App\Models\Contexts\Club;
use App\Models\Contexts\Court;
use App\Models\Payments\Payment;
use App\Models\RefundTransaction;
use Carbon\Carbon;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Exception;

class BookingController extends Controller{
    
    public function checkout(Request $request)
    {
        $msg_errors = null;
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
                if(isset($request->contract_id) && isset($request->dayOfWeek)){
                    $input['type'] = 'contract';
                    $input['contract_id'] = $request->contract_id;
                    $input['dayOfWeek'] = $request->dayOfWeek;
                    $court['booking_type'] = "contract";
                }

                $court['price'] = getPriceForBooking($input);
            }else{
                $msg_errors[] = "Data invalid. Not found data";
            }
        }
        return view('home.bookings.checkout',compact('request','court','msg_errors'));
    }

    //post checkOut
    public function postBooking(Request $request){
      
        ini_set('max_execution_time', 90); // 1.5 miniute

        //return $_POST;
        $input_validate = [
            'date' => 'required',
            'court' => 'required',
            'hour_start' => 'required',
            'hour_length' => 'required',
            //'customer.title' => 'required',
            'customer.first_name' => 'required',
            'customer.last_name' => 'required',
            'customer.phone' => 'required',
            'customer.zip_code' => 'required',
            'customer.address1' => 'required',
            'customer.city' => 'required',
            'customer.state' => 'required',
            'payment.type' => 'required',
            'payment_method_nonce' => 'required'
        ];
        if($request->input('is_customer') == 0 && !Auth::check()){
            $input_validate['customer.email'] = 'required|max:60|min:6|unique:users,email';
            $input_validate['customer.password'] = 'required|min:8|confirmed';
            $input_validate['customer.password_confirmation'] = 'required|min:8';
        }

        $v = \Validator::make($request->all(), $input_validate);
        if($v->fails())
            return response()->json(['error' => true,"messages"=>$v->errors()->all()]);
        else{
            $data_order['bookingDetail'] = [];
            $data_order['paymentDetail'] = [];
            $data_order['customerDetail'] = [];
            $data_order['nonce'] = $request->payment_method_nonce;
            $data_order['players'] = [];

            $data_order['bookingDetail'] = [
                'date'=> $request->input('date'),
                'type' => 'open',
                'contract_id' => null,
                'dayOfWeek' => null,
                'extra_id' => null,
                'teacher_id' => null,
                'hour_start'=> $request->input('hour_start'),
                'hour_length'=> $request->input('hour_length'),
                'court_id'=> $request->input('court'),
                'member'=> 0
            ];

            if($request->type && $request->type == 'contract'){
                $data_order['bookingDetail']['type'] = 'contract';
                $data_order['bookingDetail']['contract_id'] = $request->contract_id ? $request->contract_id :null;
                $data_order['bookingDetail']['dayOfWeek'] = $request->dayOfWeek ? $request->dayOfWeek :null;
            }

            $data_order['paymentDetail']= $request->input('payment');

            $input_customer = $request->input('customer');
            unset($input_customer['password_confirmation']);

            $result_prices = getPriceForBooking($data_order['bookingDetail']); // get prices

            if(isset($result_prices['error']) && !$result_prices['error']) {

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
                }
                unset($input_customer['password']);


                $data_order['customerDetail'] = $input_customer;

                $data_order['players']['names'] = $request->input('player_name') ? $request->input('player_name') : [];
                $data_order['players']['emails'] = $request->input('player_email') ? $request->input('player_email') : [];
                $data_order['players']['player_num'] = $request->input('player_num');
                $data_order['players']['source'] = 1;

                //call booking from helper
                $booking = booking($data_order);

                if(!$booking['error'])
                    return response()->json([
                        'error' => false,
                        'payment_id' => $booking['booking']['id']
                    ]);
                else{
                    return response()->json([
                        'error' => true,
                        'messages' => $booking['messages'] ? $booking['messages'] : "An error occurred in the implementation process"
                    ]);
                }
            }
            else{
                $msg = "Error. Input invalid";
                if(isset($result_prices['status']) && $result_prices['status'] == 'booking')
                    $msg.= "This is is booked";
                if(isset($result_prices['messages']) && is_array($result_prices['messages']))
                    foreach($result_prices['messages'] as $message)
                    $msg.= "<br>".$message;
                return response()->json( ['error' => true, "messages" => [$msg]]);
            }
        }

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

            if($booking['status_booking'] == 'cancel')
            {
                return response()->json([
                    'error' => true,
                    'message' => 'This is cancel booking!'
                ]);
            }

            $date_booking = date_create($booking['date']);
            $intpart = floor($booking['hour']);
            $fraction = $booking['hour'] - $intpart;
            date_time_set($date_booking, $intpart, $fraction);

            if($booking['type'] == 'contract') {
                $date_from = date_create($booking['date_range_of_contract']['from']);
                date_time_set($date_from, $intpart, $fraction);

                if (strtotime(date_format($date_from, 'Y-m-d H:i:s')) - strtotime("now") < 86400) // < 24hour
                {
                    return response()->json([
                        'error' => true,
                        'message' => 'A Reservation cannot be cancelled 24 hours before the booking time.'
                    ]);
                }
            }else{
                if (strtotime(date_format($date_booking, 'Y-m-d H:i:s')) - strtotime("now") <= 0) // < 24hour
                {
                    return response()->json([
                        'error' => true,
                        'message' => 'A Reservation cannot be cancelled 24 hours before the booking time.'
                    ]);
                }
                if (strtotime(date_format($date_booking, 'Y-m-d H:i:s')) - strtotime("now") <= 86400) // < 24hour
                {
                    return response()->json([
                        'error' => false,
                        'less_than_24_hour' => true,
                        'message' => 'A Reservation is cancelled LESS than 24 hours, we don\'t give a refund'
                    ]);
                }
            }
        }
        return response()->json([
            'error' => false,
            'message' => 'Amount for booking will full refund after cancel booking'
        ]);
    }

    //cancel booking
    public function cancelBooking(Request $request){
        $checkCancelBooking = $this->checkActionUpdateBooking($request);
        $tmp_check = $checkCancelBooking->getData();

        if($tmp_check->error){
            return response()->json([
                'error' => true,
                'message' =>$tmp_check->message
            ]);
        }else{
            $booking = Booking::with('payment')->where(['id'=>$request['id'],'player_id'=>Auth::user()->id])->first();

            $tmp_refund_success = false;
            if(isset($tmp_check->less_than_24_hour) && $tmp_check->less_than_24_hour){
                $tmp_refund_success = true;
            }else {
                if (is_null($booking['payment_id']) && json_decode($booking['payment_info'])->type)
                    $tmp_refund_success = true;
                else {
                    $payment = Payment::whereId($booking['payment_id'])->first();
                    $refund = \Braintree_Transaction::refund($payment['transaction_id']);

                    if ($refund->success) {
                        $tmp_refund_success = true;
                        RefundTransaction::create([
                            'refund_id' => $booking['payment']['transaction_id'],
                            'amount' => $booking['payment']['amount']
                        ]);
                    } else {
                        $errorString = "";
                        foreach ($refund->errors->deepAll() as $error) {
                            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
                        }
                        return response()->json([
                            'error' => true,
                            'message' => $errorString
                        ]);
                    }
                }
            }
            if($tmp_refund_success){
                if($booking['type'] == 'contract') {
                    $bookingContracts = Booking::where(['payment_id' => $booking['payment_id'], 'player_id' => Auth::user()->id])
                        ->update(['status_booking'=>'cancel']);
                }else{
                    $booking->update(['status_booking'=>'cancel']);
                }
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
        }
    }

    //print confirmation
    public function printConfirmation(Request $request){
        $id = $request->input('id');
        if(!Auth::check()){
            return redirect('error');
        }
        $booking = Booking::with('court','court.club','court.surface')->where(['bookings.id'=>$id,'bookings.player_id'=>Auth::user()->id])->first();
        return view('home.bookings.print_confirmation',compact('booking'));
    }

    //send mail
    public function sendMailOrder(Request $request){
        $id = $request->input('id');
        if(!Auth::check()){
            return redirect('error');
        }
        try{
            $booking = Booking::with('court','court.club','court.surface')->where(['bookings.id'=>$id])->first();
            event(new UserBookingEvent(Auth::user()->id, $id));
            return response()->json([
                'error' => false,
                'message' => 'Order detail has been sent to email "'.$booking['billing_info']['email'].'" please check your email.'
            ]);

        }catch(Exception $e){
            return response()->json([
                'error' => true,
                'message' => 'Error. Can"t send email. Mail not exist'
            ]);
        }
    }

    //calendar google
    public function getCalendarGoogle($id){
        if(!Auth::check()){
            return redirect('error');
        }
        try {
            $booking = Booking::with('court', 'court.club', 'court.surface')->where(['bookings.id' => $id])->first();
            if($booking) {
                $param = "text=Tennis court at " . $booking['court']['club']['name']. " Club&location=".$booking['court']['club']['address'];
                $param .= "&details=Phone club: ".$booking['court']['club']['phone']." , "." Confirmation: ".$booking['id'];
                if($booking['type'] == 'contract'){
                    $intpart = floor($booking->hour);
                    $fraction = str_replace("0.5","30",$booking->hour - $intpart);
                    $param .= "&dates=".date_from_database($booking['date_range_of_contract']['from'],'Ymd')."T".str_pad($intpart, 2, '0', STR_PAD_LEFT).str_pad($fraction, 2, '0', STR_PAD_LEFT)."00"."/";
                    $intpart = floor($booking->hour + $booking->hour_length);
                    $fraction = str_replace("0.5","30",$booking->hour + $booking->hour_length - $intpart);
                    $param .= date_from_database($booking['date_range_of_contract']['to'],'Ymd')."T".str_pad($intpart, 2, '0', STR_PAD_LEFT).str_pad($fraction, 2, '0', STR_PAD_LEFT)."00";
                }else{
                    $intpart = floor($booking->hour);
                    $fraction = str_replace("0.5","30",$booking->hour - $intpart);
                    $param .= "&dates=".date_from_database($booking['date'],'Ymd')."T".str_pad($intpart, 2, '0', STR_PAD_LEFT).str_pad($fraction, 2, '0', STR_PAD_LEFT)."00"."/";
                    $intpart = floor($booking->hour + $booking->hour_length);
                    $fraction = str_replace("0.5","30",$booking->hour + $booking->hour_length - $intpart);
                    $param .= date_from_database($booking['date'],'Ymd')."T".str_pad($intpart, 2, '0', STR_PAD_LEFT).str_pad($fraction, 2, '0', STR_PAD_LEFT)."00";
                }
                return redirect()->away("https://calendar.google.com/calendar/render?action=TEMPLATE&tpr=true&".$param);
            }else
                return redirect()->route('error');

        }catch(Exception $e){

        }
    }
}