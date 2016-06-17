<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Booking;
use App\Models\City;
use App\Models\Contexts\Club;
use App\Models\Contexts\Court;
use App\Models\Contract;
use App\Models\CourtRate;
use App\Models\Deal;
use App\Models\Payments\Payment;
use App\Models\Player;
use App\Models\RefundTransaction;
use App\Models\SetOpenDay;
use App\Models\TimeUnavailable;
use Carbon\Carbon;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use DB;
use DateTime;
use Illuminate\Http\Request;
use Validator;
use Exception;

class ManageBookingController extends Controller
{

    public function getManageBooking()
    {
        \Assets::addJavascript(['select2','uniform', 'monthly', 'moment', 'ionslider', 'timepicker', 'datetimepicker', 'daterangepicker', 'bootstrap-multiselect', 'jquery-ui']);
        \Assets::addStylesheets(['select2','uniform', 'monthly', 'ionslider', 'timepicker', 'datetimepicker', 'daterangepicker', 'bootstrap-multiselect', 'jquery-ui']);
        return view('admin.booking.index');
    }

    //ajax search player
    public function getSearchPlayers(Request $request){
        $players = User::whereHas('roles', function($query){
            //$query->where('context','players');
        })->where('email','LIKE','%'.$request['q'].'%')->limit(10)
            ->select(['id','email','address1'])->get();
        return $players;
    }

    public function postCheckPlayerforBooking($player_id){
        $player = User::where('id',$player_id)->first();
        if(!isset($player)){
            return ['error' => true, "messages" => ["Not found data. Please, select user member"]];
        }
        return response()->json([
            'error' => false,
            'player' => $player
        ]);
    }

    //getInfoGridAvailable
    public function getInfoGridAvailable(Request $request){

        $date = Carbon::createFromFormat('m/d/Y', $request->input('date'))->format("Y-m-d");
        $hour = $request->input('hour');
        $court_id = $request->input('court_id');
        $limit_hour = $hour + 5 <= 22 ? 5 : (int)(22 - $hour);

        $arr_lb_hour = [];
        $tmp_inc_hour = 1;

        for($i=$hour; $i< $hour + $limit_hour; $i++) {
            $lb_hour['text'] = ($hour <=12 ? str_replace(".5",":30",$hour)."am" : str_replace(".5",":30",($hour - 12))."pm") . "-" .
                ($hour + $tmp_inc_hour <=12 ? str_replace(".5",":30",$hour + $tmp_inc_hour)."am" : str_replace(".5",":30",$hour + $tmp_inc_hour - 12)."pm");
            $lb_hour['value'] = $tmp_inc_hour;
            $arr_lb_hour[] = $lb_hour;
            $tmp_inc_hour+=0.5;
        }

        $price_member = [];
        $tmp_inc_hour = 1;
        for($i=$hour; $i< $hour + $limit_hour; $i++) {
            $r = calPriceForBooking($court_id,$date,$hour, $tmp_inc_hour,1,'open');
            $price_member[] = !$r['error'] ? "$".$r['price']: "N/A - ".(isset($r['message']) ? $r['message'] : (isset($r['status']) ? $r['status'] : ""));
            $tmp_inc_hour+=0.5;
        }

        $tmp_inc_hour = 1;
        $price_nonmember = [];
        for($i=$hour; $i< $hour + $limit_hour; $i++) {
            $r = calPriceForBooking($court_id,$date,$hour, $tmp_inc_hour,0,'open');
            $price_nonmember[] = !$r['error'] ? "$".$r['price']: "N/A - ".(isset($r['message']) ? $r['message'] : (isset($r['status']) ? $r['status'] : ""));
            $tmp_inc_hour+=0.5;
        }

        $data['lb_hour'] = $arr_lb_hour;
        $data['price_member'] = $price_member;
        $data['price_nonmember'] = $price_nonmember;

        return [
            'error' => false,
            'data' => $data
        ];
    }

    //makeTimeUnavailable
    public function postMakeTimeUnavailable(Request $request){
        if(!empty($request->input('multi_make_time_unavailable'))) {
            $v = Validator::make((array) json_decode($request->input('multi_make_time_unavailable')), [
                'date' => 'required',
                'reason' => 'required',
            ]);

            if($v->fails())
            {
                return ['error' => true,"messages"=>$v->errors()->all()];
            }
            $input = json_decode($request->input('multi_make_time_unavailable'));
            $grids_selected = json_decode($request->input('grids_selected'));
            if(count($grids_selected) == 0)
            {
                return ['error' => true,"messages"=>['Please, select a grid time']];
            }
            foreach($grids_selected as $grid){
                TimeUnavailable::create([
                    'date' => $input->date,
                    'court_id' => $grid->c,
                    'hour' => $grid->h,
                    'hour_length' => 1,
                    'reason' => $input->reason,
                ]);
            }

            return [
                'error' => false,
            ];
        }else{
            $v = Validator::make($request->all(), [
                'date' => 'required',
                'hour' => 'required',
                'hour_length' => 'required',
                'reason' => 'required',
                'court_id' => 'required',
            ]);

            if ($v->fails()) {
                return ['error' => true, "messages" => $v->errors()->all()];
            }

            $time_available = TimeUnavailable::create([
                'date' => $request->input('date'),
                'court_id' => $request->input('court_id'),
                'hour' => $request->input('hour'),
                'hour_length' => $request->input('hour_length'),
                'reason' => $request->input('reason'),
            ]);
            if ($time_available)
                return [
                    'error' => false,
                ];
            else return [
                'error' => true
            ];
        }
    }

    //getInfoGridAvailable
    public function getInfoGridForDeal(Request $request){
        $date = Carbon::createFromFormat('m/d/Y', $request->input('date'))->format("Y-m-d");
        $hour = $request->input('hour');
        $hour_length = $request->input('hour_length');
        $court_id = $request->input('court_id');

        //court
        $court = Court::where('id',$court_id)->select('name')->first();

        $data['court_name'] = $court['name'];
        $price_member = calPriceForBooking($court_id,$date,$hour, $hour_length,1,'open');
        $data['price_member']= !$price_member['error'] ? $price_member['price']: $price_member['message'];

        $price_nonmember = calPriceForBooking($court_id,$date,$hour, $hour_length,0,'open');
        $data['price_nonmember']= !$price_nonmember['error'] ? $price_nonmember['price']: $price_member['message'];

        $data['date_text'] = Carbon::createFromFormat('m/d/Y', $request->input('date'))->format("l jS \of F Y");
        $data['time'] = ($hour <=12 ? str_replace(".5",":30",$hour)."am" : str_replace(".5",":30",($hour - 12))."pm") . "-" .
            ($hour + $hour_length <=12 ? str_replace(".5",":30",$hour + $hour_length)."am" : str_replace(".5",":30",$hour + $hour_length - 12)."pm");

        return [
            'error' => false,
            'data' => $data
        ];
    }

    //new deal
    public function postNewDeal(Request $request){
        if(!empty($request->input('multi_deal'))) {
            $v = Validator::make((array)json_decode($request->input('multi_deal')), [
                'date' => 'required',
                'hour_length' => 'required',
                'new_price_member' => 'required | numeric ',
                'new_price_nonmember' => 'required | numeric ',
            ]);

            if ($v->fails()) {
                return ['error' => true, "messages" => $v->errors()->all()];
            }
            $input = json_decode($request->input('multi_deal'));
            $grids_selected = json_decode($request->input('grids_selected'));
            foreach($grids_selected as $grid){
                Deal::create([
                    'date' => $input->date,
                    'court_id' => $grid->c,
                    'hour' => $grid->h,
                    'hour_length' => $input->hour_length,
                    'price_member' => $input->new_price_member,
                    'price_nonmember' => $input->new_price_nonmember,
                ]);
            }
            return [
                'error' => false,
            ];
        }else
        {
            $v = Validator::make($request->all(), [
                'date' => 'required',
                'new_price_member' => 'required | numeric ',
                'new_price_nonmember' => 'required | numeric ',
                'hour' => 'required',
                'hour_length' => 'required',
                'court_id' => 'required',
            ]);

            if ($v->fails()) {
                return ['error' => true, "messages" => $v->errors()->all()];
            }

            $deal = Deal::create([
                'date' => $request->input('date'),
                'court_id' => $request->input('court_id'),
                'hour' => $request->input('hour'),
                'hour_length' => $request->input('hour_length'),
                'price_member' => $request->input('new_price_member'),
                'price_nonmember' => $request->input('new_price_nonmember'),
            ]);
            if ($deal)
                return [
                    'error' => false,
                ];
            else return [
                'error' => true
            ];
        }
    }

    public function getDataOfDateOfClub(Request $request){
//        $date = Carbon::createFromFormat('m/d/Y', $request->input('date'))->format("Y-m-d");
//        $courts = Court::with('court_rate_details')
//            ->join('clubs', 'clubs.id', '=', 'courts.club_id')
//            ->join('date_club', 'clubs.id', '=', 'date_club.club_id')
//            ->where('courts.club_id',$request->input('club_id'))
//            ->where('date_club.date', $date)
//            ->get(['courts.*']);
//
//        if(empty($courts))
//            return response()->json(['error' => true,"messages"=>['Data invalid']]);
//        return response()->json([
//            'error' => false,
//            'data' => $courts
//        ]);
    }

    public function getDataOfClub(Request $request){
        $date = Carbon::createFromFormat('m/d/Y', $request->input('date'))->format("Y-m-d");
        $hours = range(5,22.5,0.5);
        $courts = Court::where('club_id',$request->input('club_id'))
            ->select(['id','name'])->orderBy('name')->get();

        //check date close
        $date_close = SetOpenDay::where('club_id',$request->input('club_id'))->where('date',$date)->where('is_close',1)->first();
        if(isset($date_close)){
            foreach($courts as $k=>$court){
                $arr_hour_tmp = [];
                foreach($hours as $key=>$hour) {
                    $arr_hour["h_" . $hour]['hour'] = $hour;
                    $arr_hour["h_" . $hour]['status'] = 'day_close';
                    $arr_hour["h_" . $hour]['content'] = '';
                    $arr_hour["h_" . $hour]['booking_id'] = '';
                }
                foreach($arr_hour as $v)
                    $arr_hour_tmp[] = $v;
                $courts[$k]['hours'] = $arr_hour_tmp;
            }
            return response()->json([
                'error' => false,
                'data' => $courts
            ]);
        }

        foreach($courts as $k=>$court){
            $arr_hour = [];
            foreach($hours as $key=>$hour) {
                $arr_hour["h_" . $hour]['hour'] = $hour;
                $arr_hour["h_" . $hour]['status'] = 'available';
                $arr_hour["h_" . $hour]['content'] = '';
                $arr_hour["h_" . $hour]['booking_id'] = '';
            }

            //get booking
            $bookings = Booking::where('status_booking','!=','cancel')->where(['date'=>$date,'court_id'=>$court['id']])->get();
            foreach($bookings as $booking){
                $tmp_i = 0;
                for($i=$booking['hour']; $i < $booking['hour'] + $booking['hour_length']; $i+=0.5){
                    $index = floatval($i);
                    if(isset($arr_hour["h_".$index]['hour'])) {
                        $arr_hour["h_" . $index]['content'] = $booking['billing_info']['first_name'] . " " . $booking['billing_info']['last_name'];
                        $arr_hour["h_" . $index]['status'] = $booking['type'];
                        $arr_hour["h_" . $index]['booking_id'] = $booking['id'];
                        if(is_null($booking['payment_id']) && json_decode($booking['payment_info'])->type)
                            $arr_hour["h_" . $index]['is_cash'] = true;
                        if ($tmp_i % 2 == 0)
                            $arr_hour["h_" . $index]['g_start'] = "start";
                        else
                            $arr_hour["h_" . $index]['g_end'] = "end";
                        $tmp_i++;
                    }
                }
            }

            //get unavailable
            $unavailables = TimeUnavailable::where('date',$date)->where('court_id',$court['id'])->get();
            foreach($unavailables as $unavailable){
                $tmp_i = 0;
                for($i=$unavailable['hour']; $i < $unavailable['hour'] + $unavailable['hour_length']; $i+=0.5){
                    $arr_hour["h_".$i]['status'] = 'unavailable';
                    $arr_hour["h_".$i]['content'] = $unavailable['reason'];
                    $tmp_i++;
                }
            }

            //copy arr_hour, edit key arr hour
            $arr_hour_temp = [];
            foreach($arr_hour as $v)
                $arr_hour_temp[] = $v;
            $courts[$k]['hours'] = $arr_hour_temp;
        }

        return response()->json([
            'error' => false,
            'data' => $courts
        ]);
    }

    //view price order
    public function postViewPriceOrder(Request $request){
        $input = [
            'date'=> $request->input('date'),
            'type' => $request->input('type'),
            'contract_id' => $request->input('contract_id'),
            'dayOfWeek' => $request->input('dayOfWeek'),
            'extra_id' => $request->input('extra_id'),
            'teacher_id' => $request->input('teacher_id'),
            'hour_start'=> $request->input('hour_start'),
            'hour_length'=> $request->input('hour_length'),
            'court_id'=> $request->input('court_id'),
            'club_id'=> $request->input('club_id'),
            'member'=> $request->input('member')
        ];
        $result = getPriceForBooking($input);
        return response()->json($result);
    }

    public function postCheckCourtBooking(Request $request){
        $input = [
            'date'=> $request->input('date'),
            'type' => $request->input('type'),
            'contract_id' => $request->input('contract_id'),
            'dayOfWeek' => $request->input('dayOfWeek'),
            'extra_id' => $request->input('extra_id'),
            'teacher_id' => $request->input('teacher_id'),
            'hour_start'=> $request->input('hour_start'),
            'hour_length'=> $request->input('hour_length'),
            'court_id'=> $request->input('court_id'),
            'club_id'=> $request->input('club_id'),
            'member'=> $request->input('member')
        ];
        $result = getPriceForBooking($input);

        if($result['error'] == false){
            $result['court_detail'] = Court::whereId($request->input('court_id'))->first();
            return response()->json($result);
        }
        return response()->json($result);
    }

    public function postCheckInputCustomer(Request $request){
        $v = Validator::make($request->all(), [
            'title' => 'sometimes',
            'first_name' => 'required',
            'last_name' => 'required',
            'zip_code' => 'required | max: 6',
            'address1' => 'required',
            'state' => 'required',
            'city' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        if($v->fails())
        {
            return ['error' => true,"messages"=>$v->errors()->all()];
        }

        return [
            'error' => false,
        ];

    }

    //payment
    public function postPayment(Request $request){
        $inputBookingDetail = json_decode($request->input('infoBooking'));
        $customerDetail = (array)json_decode($request->input('customer'));
        $paymentDetail = json_decode($request->input('payment'));

        $fields_validate = [
            'cost_adj' =>'sometimes|integer',
        ];

        if($paymentDetail->type != 'cash' && !empty($paymentDetail->cost_adj)){
            $fields_validate['adj_reason'] = "required";
        }
        $v = \Validator::make((array) $paymentDetail, $fields_validate);


        if($v->fails())
        {
            return ['error' => true,"messages"=>$v->errors()->all()];
        }

        if($paymentDetail->type != 'cash') {
            $v = \Validator::make($request->all(), [
                'nonce' => 'required',
            ], [
                'nonce.required' => "Method payment invalid"
            ]);


            if ($v->fails()) {
                return ['error' => true, "messages" => $v->errors()->all()];
            }
        }

        $data_order['bookingDetail'] = [];
        $data_order['paymentDetail'] = [];
        $data_order['customerDetail'] = [];
        $data_order['players'] = [];

        $data_order['bookingDetail'] = [
            'date'=> $inputBookingDetail->date,
            'type' => $inputBookingDetail->type,
            'contract_id' => $inputBookingDetail->contract_id,
            'dayOfWeek' => $inputBookingDetail->dayOfWeek,
            'extra_id' => $inputBookingDetail->extra_id,
            'teacher_id' => $inputBookingDetail->teacher_id,
            'hour_start'=> $inputBookingDetail->hour_start,
            'hour_length'=> $inputBookingDetail->hour_length,
            'court_id'=> $inputBookingDetail->court_id,
            'member'=> $inputBookingDetail->member
        ];

        if($request->type && $request->type == 'contract'){
            $data_order['bookingDetail']['type'] = 'contract';
            $data_order['bookingDetail']['contract_id'] = $request->contract_id ? $request->contract_id :null;
            $data_order['bookingDetail']['dayOfWeek'] = $request->dayOfWeek ? $request->dayOfWeek :null;
        }

        $data_order['nonce'] = $request->nonce;
        $data_order['paymentDetail']=[
            'cost_adj' => $paymentDetail->cost_adj,
            'adj_reason' => $paymentDetail->adj_reason,
            'type' => $paymentDetail->type
        ];

        $result_prices = getPriceForBooking($data_order['bookingDetail']); // get prices

        if(!$result_prices['error']) {

            $data_order['customerDetail'] = $customerDetail;

//            $data_order['players']['names'] = $request->input('player_name') ? $request->input('player_name') : [];
//            $data_order['players']['emails'] = $request->input('player_email') ? $request->input('player_email') : [];
//            $data_order['players']['player_num'] = $request->input('player_num');
            $data_order['players']['source'] = 0;

            //call booking from helper
            $booking = booking($data_order);

            if(!$booking['error']) {
                $payment_type = "Cash";
                $last4 = '';
                if($booking['booking']['payment_id'] != null) {
                    $payment = Payment::whereId($booking['booking']['payment_id'])->first();
                    $payment_type = $payment['card_type'] != null ? "Credit Card | " . $payment['card_type'] : "Paypal";
                    $last4 = $payment['card_type'] != null ? "****-****-****-".$payment['last_4']: '';
                }
                return response()->json([
                    'error' => false,
                    'total_price' => $booking['booking']['total_price'],
                    'booking_reference' => $booking['booking']['id'],
                    'payment_type' => $payment_type,
                    'last4' => $last4
                ]);
            }
            else{
                return response()->json([
                    'error' => true,
                    'messages' => $booking['messages'] ? $booking['messages'] : "An error occurred in the implementation process"
                ]);
            }

        }
        return response()->json([
            'error' => true,
            "messages" => ['Error. Input invalid or it is booking']
        ]);
    }

    //get view booking
    public function getView($booking_id){
        $booking = Booking::whereId($booking_id)->with('court')->first();
        if(!isset($booking)){
            return ['error' => true, "messages" => ["Not found data"]];
        }

        $booking['payment_info'] = json_decode($booking['payment_info']);
//        if($booking['player_id'] != 0) {
//            $billing_info = User::where('id',$booking['player_id'])->select(["first_name","last_name","email","phone","address1","city","state"])->first();
//            if($billing_info)
//                $booking['billing_info'] = $billing_info;
//        }
        return response()->json([
            'error' => false,
            'booking' => $booking
        ]);
    }

    //search
    public function getSearch(Request $request){
        $ref = $request->input('reference');
        $name = $request->input('name');
        $bookings = Booking::join('courts','courts.id','=','bookings.court_id')
            ->orWhere(function ($q) use ($ref) {
                if ($ref != null && $ref != '') {
                    $q->where('bookings.id',"like","%".$ref."%");
                }})
            ->orWhere(function ($q) use ($name) {
                if ($name != null && $name != '' && $name != 'null') {
                    $q->where('bookings.billing_info',"like","%".$name."%");
                }})
            ->get(['bookings.*','courts.name as court_name']);

        return response()->json([
            'error' => false,
            'bookings' => $bookings
        ]);
    }

    //accept payment
    public function getAcceptPayment($booking_id){
        $booking = Booking::where('id',$booking_id)->first();
        if(!isset($booking)){
            return ['error' => true, "messages" => ["Not found data"]];
        }
        $booking['status'] = "paid";
        $booking->update();
        return response()->json([
            'error' => false,
        ]);
    }

    //cancel booking
    public function getCancel($booking_id){
        $booking = Booking::with('payment')->where('id',$booking_id)->first();
        if(!isset($booking)){
            return ['error' => true, "messages" => ["Not found data"]];
        }
        try {
            $tmp_refund_sucess = false;
            if(is_null($booking['payment_id']) && json_decode($booking['payment_info'])->type)
                $tmp_refund_sucess =true;
            else {
                $refund = \Braintree_Transaction::refund('8e628z83');

                if ($refund->success) {
                    $tmp_refund_sucess = true;
                    RefundTransaction::create([
                        'refund_id' => $booking['payment']['transaction_id'],
                        'amount' => $booking['payment']['amount']
                    ]);
                }else{
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
            if($tmp_refund_sucess){
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
        }catch (Exception $e){
            return response()->json([
                'error' => true,
                'message' => "Charge has already been refunded. Please contact Admin website"//$e->getMessage()
            ]);
        }

    }

    //get address lookup
    public function getAddressLookup($zipcode){
        $city = City::join('states','states.state_code','=','citys.state_code')
            ->join('zipcodes','citys.id','=','zipcodes.city_id')
            ->select(['citys.name as city','states.name as state'])
            ->where('zipcodes.zipcode',"like","%".$zipcode."%")
            ->first();
        if(!isset($city)){
            return ['error' => true, "messages" => ["Not found data"]];
        }
        return response()->json([
            'error' => false,
            'address' => $city
        ]);
    }
    public function getCustomerLookup($search){
        $user = User::search($search)
            ->first();
        return response()->json([
            'error' => false,
            'user' => $user
        ]);
    }

    public function postPrintReceipt(Request $request){
        $id = $request->input('id');
        $booking = Booking::with('court','court.club','court.surface')->where(['bookings.id'=>$id])->first();
        $print = true;
        return view('home.bookings.print_confirmation',compact('booking','print'));
    }

    public function getCheckIn($id){
        $booking = Booking::where(['id'=>$id])->first();
        if(isset($booking)){
            $booking->is_CheckIn = true;
            $booking->save();
            return response()->json([
                'error' => false,
            ]);
        }
        return response()->json([
            'error' => true,
            'messsage' => 'Data not found'
        ]);
    }

    public function getClientToken(){
        $client_token = \Braintree\ClientToken::generate();
        return response()->json([
            'error' => false,
            'client_token' => $client_token
        ]);
    }
}