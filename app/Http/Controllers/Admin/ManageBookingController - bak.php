<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Booking;
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
use Cartalyst\Stripe\Exception\CardErrorException;
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
            $query->where('context','players');
        })->where('email','LIKE','%'.$request['q'].'%')->limit(10)
            ->select(['id','email','address1'])->get();
        return $players;
    }

    public function postCheckPlayerforBooking($player_id){
        $player = User::where('id',$player_id)->first();
        if(!isset($player)){
            return ['error' => true, "messages" => ["Not found data"]];
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
            $arr_lb_hour[] = ($hour <=12 ? str_replace(".5",":30",$hour)."am" : str_replace(".5",":30",($hour - 12))."pm") . "-" .
                ($hour + $tmp_inc_hour <=12 ? str_replace(".5",":30",$hour + $tmp_inc_hour)."am" : str_replace(".5",":30",$hour + $tmp_inc_hour - 12)."pm") ." (".$tmp_inc_hour." hour)";
            $tmp_inc_hour+=0.5;
        }

        $price_member = [];
        $tmp_inc_hour = 1;
        for($i=$hour; $i< $hour + $limit_hour; $i++) {
            $r = calPriceForBooking($court_id,$date,$hour, $tmp_inc_hour,1,'open');
            //$price_member[] = !$r['error'] ? $r['price']: $r['message'];
            $price_member[] = !$r['error'] ? $r['price']: $r['message'];
            $tmp_inc_hour+=0.5;
        }

        $tmp_inc_hour = 1;
        $price_nonmember = [];
        for($i=$hour; $i< $hour + $limit_hour; $i++) {
            $r = calPriceForBooking($court_id,$date,$hour, $tmp_inc_hour,0,'open');
            $price_nonmember[] = !$r['error'] ? $r['price']: $r['message'];
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
        $date_close = SetOpenDay::where('date',$date)->where('is_close',1)->first();
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
                    if($booking['player_id'] == 0) {
                        $arr_hour["h_".$i]['content'] = $booking['billing_info']['first_name']. " ". $booking['billing_info']['last_name'];
                    }else{
                        $billing_info = Player::where('id',$booking['billing_info'])->first();
                        if($billing_info)
                            $arr_hour["h_".$i]['content'] = $billing_info['first_name']. " ". $billing_info['last_name'];
                        $arr_hour["h_".$i]['content'] = "";
                    }
                    $arr_hour["h_".$i]['status'] = $booking['type'];
                    $arr_hour["h_".$i]['booking_id'] = $booking['id'];

                    if($tmp_i % 2 == 0)
                        $arr_hour["h_" . $i]['g_start'] = "start";
                    else
                        $arr_hour["h_" . $i]['g_end'] = "end";
                    $tmp_i++;
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
            $arr_hour_tmp = [];
            foreach($arr_hour as $v)
                $arr_hour_tmp[] = $v;
            $courts[$k]['hours'] = $arr_hour_tmp;
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
            $result['court_detail'] = Court::find($request->input('court_id'))->first();
            return response()->json($result);
        }
        return response()->json($result);
    }

    public function postCheckInputCustomer(Request $request){
        $v = Validator::make($request->all(), [
            'title' => 'required',
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

    public function postPayment(Request $request){
        $fields_validate = [
            'type' => 'required',
            'card_number' => 'required',
            'expiry' => 'required',
            'cvv' => 'required|integer',
            'cost_adj' =>'sometimes|integer',
        ];

        $cc_info_payment = json_decode($request->input('payment'));
        if(!empty($cc_info_payment->cost_adj)){
            $fields_validate['adj_reason'] = "required | min: 6";
        }
        $v = Validator::make((array) $cc_info_payment, $fields_validate);

        //dd($request->input('payment'));
        if($v->fails())
        {
            return ['error' => true,"messages"=>$v->errors()->all()];
        }

        $inputBookingDetail = json_decode($request->input('infoBooking'));
        $customerDetail = json_decode($request->input('customer'));
        $paymentDetail = json_decode($request->input('payment'));

        $input = [
            'date'=> $inputBookingDetail->date,
            'type' => $inputBookingDetail->type,
            'contract_id' => $inputBookingDetail->contract_id,
            'dayOfWeek' => $inputBookingDetail->dayOfWeek,
            'extra_id' => $inputBookingDetail->extra_id,
            'teacher_id' => $inputBookingDetail->teacher_id,
            'hour_start'=> $inputBookingDetail->hour_start,
            'hour_length'=> $inputBookingDetail->hour_length,
            'court_id'=> $inputBookingDetail->court_id,
            'club_id'=> $inputBookingDetail->club_id,
            'member'=> $inputBookingDetail->member
        ];

        $result_prices = getPriceForBooking($input);
        if(!$result_prices['error']) {

            $text_notes = ""; //notes

            //check Cost Adjustment
            if(!empty($cc_info_payment->cost_adj)){
                $cc_info_payment->cost_adj = abs($cc_info_payment->cost_adj);
                if($cc_info_payment->cost_adj > $result_prices['total_price']){
                    return response()->json([
                        'error' => true,
                        "messages" => ['Cost Adjustment greater than total price']
                    ]);
                }else{
                    $text_notes .= "Amount: $".$result_prices['total_price'];
                    $text_notes .=" . Cost Adjustment: $".$cc_info_payment->cost_adj;
                    $result_prices['total_price'] -= $cc_info_payment->cost_adj;
                    $text_notes .=" . The remaining price: $".$result_prices['total_price'];
                }
            }

            if ($inputBookingDetail->member == 1) {
                $player_id = $customerDetail->player_id;
                $billing_info = json_encode([]);
            } else {
                $player_id = 0;
                $billing_info = $request->input('customer');
            }

            $expiry = explode("/", $paymentDetail->expiry);
            //stripe
            try {
                $token = Stripe::tokens()->create([
                    'card' => [
                        'number' => $paymentDetail->card_number,
                        'exp_month' => $expiry[0],
                        'exp_year' => $expiry[1],
                        'cvv' => $paymentDetail->cvv,
                    ],
                ]);
            } catch (CardErrorException $e) {
                return ['error' => true, "messages" => [$e->getMessage()]];
            }

            $customer = Stripe::customers()->create([
                'email' => $customerDetail->email,
                'source' => $token['id'],
            ]);

            $charge = Stripe::charges()->create([
                'customer' => $customer['id'],
                'currency' => 'USD',
                'amount' => $result_prices['total_price'],
            ]);

            $payment = Payment::create([
                'user_id' => 0,
                'card_number' => $paymentDetail->card_number,
                'amount' => $request->input('total_price'),
                'exp_month' => $expiry['0'],
                'exp_year' => $expiry['1'],
                'cvv' => $paymentDetail->cvv,
                'stripe_transaction_id' => $charge['id'],
            ]);

            //save with type open
            if($inputBookingDetail->type == 'open' || $inputBookingDetail->type == 'lesson') {
                $booking = Booking::create([
                    'payment_id' => $payment['id'],
                    'type' => $inputBookingDetail->type,
                    'date' => $inputBookingDetail->date,
                    'status' => 'required',
                    'status_booking' => 'create',
                    'contract_id' => $inputBookingDetail->contract_id,
                    'day_of_week' => is_numeric($inputBookingDetail->dayOfWeek) ? $inputBookingDetail->dayOfWeek : 0,
                    'court_id' => $inputBookingDetail->court_id,
                    'extra_id' => json_encode($inputBookingDetail->extra_id),
                    'teacher_id' => is_numeric($inputBookingDetail->teacher_id) ? $inputBookingDetail->teacher_id : 0,
                    'is_member' => $inputBookingDetail->member,
                    'price_teacher' => $result_prices['price_teacher'] ? $result_prices['price_teacher'] : 0,
                    'total_price' => $result_prices['total_price'],
                    'hour' => $inputBookingDetail->hour_start,
                    'hour_length' => $inputBookingDetail->hour_length,
                    'player_id' => $player_id,
                    'num_player' => $inputBookingDetail->num_player,
                    'billing_info' => $billing_info,
                    'payment_info' => $request->input('payment'),
                    'source' => 1,
                    'notes' => $text_notes
                ]);
                return [
                    'error' => false,
                    'payment_id' => $payment['id']
                ];
            }else if($inputBookingDetail->type == 'contract') { //save with type contract

                $contract = Contract::where('id',$inputBookingDetail->contract_id)->first();
                $range_date = createRangeDate($contract['start_date'],$contract['end_date'],$input['dayOfWeek']);
                foreach($range_date as $date) {
                    $booking = Booking::create([
                        'payment_id' => $payment['id'],
                        'type' => $inputBookingDetail->type,
                        'date' => $date,
                        'date_range_of_contract' => json_encode(['from'=>$contract['start_date'],'to'=>$contract['end_date']]),
                        'day_of_week' => is_numeric($inputBookingDetail->dayOfWeek) ? $inputBookingDetail->dayOfWeek : 0,
                        'contract_id' => $inputBookingDetail->contract_id,
                        'court_id' => $inputBookingDetail->court_id,
                        'extra_id' => json_encode($inputBookingDetail->extra_id),
                        'teacher_id' => is_numeric($inputBookingDetail->teacher_id) ? $inputBookingDetail->teacher_id : 0,
                        'is_member' => $inputBookingDetail->member,
                        'total_price' => $result_prices['total_price'],
                        'hour' => $inputBookingDetail->hour_start,
                        'hour_length' => $inputBookingDetail->hour_length,
                        'player_id' => $player_id,
                        'num_player' => $inputBookingDetail->num_player,
                        'billing_info' => $billing_info,
                        'payment_info' => $request->input('payment'),
                        'source' => 1,
                        'notes' => $text_notes
                    ]);
                }

                return response()->json([
                    'error' => false,
                    'total_price' => $result_prices['total_price'],
                    'payment_id' => $payment['id']
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
        if($booking['player_id'] != 0) {
            $billing_info = User::where('id',$booking['player_id'])->select(["first_name","last_name","email","phone","address1","city","state"])->first();
            if($billing_info)
                $booking['billing_info'] = $billing_info;
        }
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
            ->orWhere('bookings.id',"like","%".$ref."%")
            ->orWhere('billing_info',"like","%".$name."%")
            ->get(['bookings.*','courts.name as court_name']);

        foreach($bookings as $k=>$booking){
            $bookings[$k]['billing_info'] = (array)json_decode($booking['billing_info']);
        }
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
                $booking->update(['status_booking'=>'cancel']);
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
}