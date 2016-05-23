<?php

use App\Models\Auth\User;
use App\Models\Booking;
use App\Models\Contexts\Court;
use App\Models\Contract;
use App\Models\CourtRate;
use App\Models\Deal;
use App\Models\SetOpenDay;
use App\Models\TimeUnavailable;
use Carbon\Carbon;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Payments\Payment;

function format_time(DateTime $timestamp, $format = 'j M Y H:i')
{
    $first = Carbon::create(0000, 0, 0, 00, 00, 00);
    if ($timestamp->lte($first)) {
        return '';
    }

    return $timestamp->format($format);
}

function date_from_database($time, $format = 'Y-m-d')
{
    return format_time(Carbon::parse($time), $format);
}

function get_lat_long($address)
{
    $address = str_replace(" ", "+", $address);
    $key = "AIzaSyC4Bb68mvFmien-T9YQXJfuNpCLFJw4bic";
    $json = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=" . $address . "&key=" . $key);
    $json = json_decode($json);
    $lat="";
    $long="";
    if(isset($json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'}))
    {
        $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
        $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
    }
    return ['lat' => round($lat,6), 'lng' => round($long,6)];
}

//get 12 deal
function getDeals(){
    $deals = Deal::where('deals.date', '>=', date("Y-m-d"))
        ->whereIn('deals.created_at',function($query){
        $query->select(DB::raw("MAX(created_at)"))
            ->from('deals')
            ->groupBy("date", "court_id", "hour", "hour_length");
        })
        ->join('courts','courts.id','=','deals.court_id')
        ->join('clubs','clubs.id','=','courts.club_id')
        ->orderBy('date','asc')
        ->select(['deals.*','courts.name as court_name','clubs.name as club_name', 'clubs.city', 'clubs.state', 'clubs.image'])
        ->limit(12)
        ->get();
    return $deals;
}

function calPriceForBooking($court_id, $date, $hour_start, $hour_length, $is_member,$type = 'open',$contract_id=0){
    $court = Court::where('id',$court_id)->first();

    //check day close
    $check_close = SetOpenDay::where(['date' => $date, 'club_id' => $court['club_id']])
        ->where('is_close',1)
        ->get();
    if(isset($check_close) && count($check_close) > 0){
        return [
            'error' => true,
            'status' => "close"
        ];
    }
    $unavailable = TimeUnavailable::where(['date' => $date, 'court_id' => $court_id])
        ->where(function ($q) use($hour_start,$hour_length) {
            $q->orWhere('hour', $hour_start)
                ->orWhere(function ($q) use ($hour_start,$hour_length) {
                    $q->where('hour',"<",$hour_start)
                        ->whereRaw('hour + hour_length > '.$hour_start);
                });
        })
        ->get();
    if(isset($unavailable) && count($unavailable) > 0){
        return [
            'error' => true,
            'status' => "unavailable"
        ];
    }

    if($type == "open") {
        $table_rate = CourtRate::where('start_date', '<=', $date)
            ->where('end_date', '>=', $date)
            ->where('court_id', $court_id)
            ->where('is_member', $is_member)
            ->orderBy('updated_at', 'DESC')
            ->first();
    }else if($type == "contract") {
        $table_rate = Contract::where('id', $contract_id)
            ->where('start_date', '<=', $date)
            ->where('end_date', '>=', $date)
            ->where('club_id', $court['club_id'])
            ->where('is_member', $is_member)
            ->orderBy('updated_at', 'DESC')
            ->first();
        if(!$table_rate)
            return [
                'error' => true,
                'status' => "Contract invalid"
            ];
    }
    $deals = Deal::where('date',$date)->where('court_id',$court_id)
        ->orderBy('updated_at','asc')
        ->get();

    if(!isset($table_rate)){
//            return [
//                'error' => true,
//                'message' => "The court is not a set price"
//            ];
        for($i=0; $i<17; $i++){
            $rates[$i]['A1'] = "N/A";
            $rates[$i]['A2'] = "N/A";
            $rates[$i]['A3'] = "N/A";
            $rates[$i]['A4'] = "N/A";
            $rates[$i]['A5'] = "N/A";
            $rates[$i]['A6'] = "N/A";
            $rates[$i]['A7'] = "N/A";
        }
    }else
        $rates = $table_rate['rates'];


    $dayOfWeek = date('w', strtotime($date));
    $index_json = "A".strval($dayOfWeek == 0 ? 7 : $dayOfWeek);
    $total_price = 0;

    foreach($deals as $deal){
        for($i=$deal['hour']; $i< $deal['hour'] + $deal['hour_length']; $i++) {
            if($is_member)
                $rates[$i - 5][$index_json] = $deal['price_member'];
            else $rates[$i - 5][$index_json] = $deal['price_nonmember'];
        }
    }
    $rates_full = [];
    foreach($rates as $rate){
        $rates_full[] = $rate;
        $rates_full[] = $rate;
    }

    for($i= $hour_start; $i< $hour_start + $hour_length; $i+=0.5){
        $tmp_index = ($i - 5) *2;
        if(!isset($rates_full[$tmp_index][$index_json])){
            $total_price ="ERROR";
            break;
        }
        if($rates_full[$tmp_index][$index_json] == "N/A"){
            return [
                'error' => true,
                'price' => "N/A",
                'status' => 'nosetprice'
            ];
        }
        $total_price += $rates_full[$tmp_index][$index_json] / 2;
    }
    return [
        'error' => false,
        'price' => $total_price
    ];
}

//caculator price and check was booked
function getPriceForBooking($input){//[date,type,hour_start,hour_length,court_id,contract_id,member]
    if($input['type'] == 'open' || $input['type'] == 'lesson'){
        $messages = [
            'hour_start'    => 'The Select a Time field is required.',
            'hour_length'    => 'The Select a Court field is required.',
            'court_id.exists'  => 'The selected court is invalid.',
            'court_id.required'  => 'The selected court is invalid.',
        ];
        $v = Validator::make($input, [
            'date' => 'required',
            'hour_start' => 'required',
            'hour_length' => 'required',
            'court_id' => 'required|exists:courts,id',
        ],$messages);

        if($v->fails())
        {
            return ['error' => true,"messages"=>$v->errors()->all()];
        }

        //$date = Carbon::createFromFormat('m/d/Y', $input['date'])->format("Y-m-d");
        $date = Carbon::createFromTimestamp(strtotime($input['date']))->format("Y-m-d");;
        //check book is exist
        $check_book = Booking::where('date',$date)
            ->where('court_id',$input['court_id'])
            ->where('status_booking','!=','cancel')
            ->where(function ($q) use($input) {
                $q->whereIn('hour', range($input['hour_start'], $input['hour_start'] + $input['hour_length'] - 0.5,0.5))
                    ->orWhere(function ($q) use ($input) {
                        $q->where('hour', '<', $input['hour_start'])
                            ->whereRaw('hour + hour_length > '.$input['hour_start']);
                    })
                    ->orWhere(function ($q) use ($input) {
                        $q->whereRaw('hour + hour_length < '.$input['hour_length'])
                            ->whereRaw('hour + hour_length > '.$input['hour_length']);
                    });
            })
            ->first();

        if(!empty($check_book))
            return ['error' => true, "status" => "booking"];

        $r = calPriceForBooking($input['court_id'],$date,
            $input['hour_start'],$input['hour_length'],$input['member'],'open');

        $total_price = 0;
        $price_teacher = 0;
        //price teacher
        if($input['type'] == 'lesson'){
            $teacher = User::with('teacher')->where('id',$input['teacher_id'] ? $input['teacher_id'] : -1)->first();
            if(isset($teacher['id'])){
                $price_teacher = $teacher->teacher->rate;
            }
        }
        if($r['error']){
            return ['error' => true,"status"=>$r['status']];
        }else {
            $total_price = $price_teacher + $r['price'];
            return [
                'error' => false,
                'price_teacher' => $price_teacher,
                'total_price' => $total_price,
            ];
        }
    }
    else if($input['type'] == 'contract'){
        $messages = [
            'contract_id'    => 'The Date range field is required.',
            'dayOfWeek'    => 'The day of weekfield is required.',
            'hour_start'    => 'The Select a Time field is required.',
            'hour_length'    => 'The Select a Court field is required.',
            'court_id.exists'  => 'The selected court is invalid.',
            'court_id.required'  => 'The selected court is invalid.',
        ];
        $v = Validator::make($input, [
            'contract_id' => 'required',
            'dayOfWeek' => 'required',
            'hour_start' => 'required',
            'hour_length' => 'required',
            'court_id' => 'required|exists:courts,id',
        ],$messages);

        if($v->fails())
        {
            return ['error' => true,"messages"=>$v->errors()->all()];
        }

        //court
        $court = Court::where('id',$input['court_id'])->first();
        if(!$court){
            return ['error' => true,"messages"=>["Data invalid"]];
        }
        //contract
        $contract = Contract::where(['id'=>$input['contract_id'],'club_id'=>$court['club_id']])->first();

        if(!$contract){
            return ['error' => true,"messages"=>"Data invalid"];
        }

        $range_date = createRangeDate($contract['start_date'],$contract['end_date'],$input['dayOfWeek']);

        foreach($range_date as $date) {
            //check book yet
            $check_book = Booking::where('date', $date)
                ->where('status_booking','!=','cancel')
                ->where(function ($q) use ($input) {
                    $q->whereIn('hour', range($input['hour_start'], $input['hour_start'] + $input['hour_length'] - 0.5, 0.5))
                        ->orWhere(function ($q) use ($input) {
                            $q->where('hour', '<', $input['hour_start'])
                                ->whereRaw('hour + hour_length > ' . $input['hour_start']);
                        })
                        ->orWhere(function ($q) use ($input) {
                            $q->whereRaw('hour + hour_length < ' . $input['hour_length'])
                                ->whereRaw('hour + hour_length > ' . $input['hour_length']);
                        });
                })
                ->first();
            if (!empty($check_book)) {
                $err = "Please select another time or range date. ";
                $err .= "Detail: Date " . $date . " at " . $input['hour_start'] . " - " . ($input['hour_start'] + $input['hour_length']) . "hour was booked";
                return ['error' => true, "messages" => [$err]];
            }
        }

        $total_price = 0;
        $price_extra = 0;
        $r= calPriceForBooking($input['court_id'],$range_date[0],$input['hour_start'],$input['hour_length'],$input['member'],'contract',$contract['id']);
        if(isset($input['extra_id']) && is_array($input['extra_id']))
        foreach($input['extra_id'] as $item){
            foreach($contract['extras'] as $extra){
                if($item == $extra['name'])
                    $price_extra += $extra['value'];
            }
        }
        if($r['error']){
            return ['error' => true,'messages'=>'Error',"status"=>isset($r['status']) ? $r['status'] : "Error. Contract not exist"];
        }else {
            $total_price += $price_extra + $r['price'];
            return [
                'error' => false,
                'total_price' => $total_price
            ];
        }
    }
    return ['error' => true,"messages"=>["Booking type invalid. Check all fill is full"]];
}

//create range
function createRangeDate($s,$e,$dayOfWeek){
    $startDate =  new DateTime($s);
    $endDate = new DateTime($e);

    $range_date = [];
    for($i = $startDate; $startDate <= $endDate; $i->modify('+1 day')){
        $tmp_date = $i->format("Y-m-d");
        if(date("N",strtotime($tmp_date)) == $dayOfWeek)
            $range_date[] = $tmp_date;
    }
    return$range_date;
}

//order
function booking($input){ //$input['bookingDetail'], $input['paymentDetail'], $input['customerDetail']

    $input_get_price = [
        'date'=> $input['bookingDetail']['date'],
        'type' => $input['bookingDetail']['type'],
        'contract_id' => $input['bookingDetail']['contract_id'],
        'dayOfWeek' => $input['bookingDetail']['dayOfWeek'],
        'teacher_id' => $input['bookingDetail']['teacher_id'],
        'hour_start'=> $input['bookingDetail']['hour_start'],
        'hour_length'=> $input['bookingDetail']['hour_length'],
        'court_id'=> $input['bookingDetail']['court_id'],
        'member'=> $input['bookingDetail']['member']
    ];

    $result_prices = getPriceForBooking($input_get_price);

    if(!$result_prices['error']) {

        $text_notes = ""; //notes

        //check Cost Adjustment
        if(isset($input['paymentDetail']['cost_adj']) && !empty($input['paymentDetail']['cost_adj'])){
            $input['paymentDetail']['cost_adj'] = abs($input['paymentDetail']['cost_adj']);
            if($input['paymentDetail']['cost_adj']> $result_prices['total_price']){
                return [
                    'error' => true,
                    "messages" => ['Cost Adjustment greater than total price']
                ];
            }else{
                $text_notes .= "Amount: $".$result_prices['total_price'];
                $text_notes .=" . Cost Adjustment: $".$input['paymentDetail']['cost_adj'];
                $result_prices['total_price'] -= $input['paymentDetail']['cost_adj'];
                $text_notes .=" . The remaining price: $".$result_prices['total_price'];
            }
        }

        if ($input['bookingDetail']['member'] == 1 && isset($input['bookingDetail']['player_id'])) {
            $billing_info = [];
        } else {
            $billing_info = $input['customerDetail'];
        }

        //stripe
        try {
            $token = Stripe::tokens()->create([
                'card' => $input['paymentDetail'],
            ]);
        } catch (CardErrorException $e) {
            return ['error' => true, "messages" => [$e->getMessage()]];
        }

        try {
            $customer_stripe = Stripe::customers()->create([
                'email' => $input['customerDetail']['email'],
                'source' => $token['id'],
            ]);
        } catch (CardErrorException $e) {
            return ['error' => true, "messages" => [$e->getMessage()]];
        }

        try {
            $charge = Stripe::charges()->create([
                'customer' => $customer_stripe['id'],
                'currency' => 'USD',
                'amount' => $result_prices['total_price'],
            ]);
        } catch (CardErrorException $e) {
            return ['error' => true, "messages" => [$e->getMessage()]];
        }

        $payment = Payment::create([
            'card_number' => $input['paymentDetail']['number'],
            'amount' => $result_prices['total_price'],
            'exp_month' => $input['paymentDetail']['exp_month'],
            'exp_year' => $input['paymentDetail']['exp_year'],
            'cvv' => $input['paymentDetail']['cvv'],
            'stripe_transaction_id' => $charge['id'],
        ]);

        //save with type open
        if($input['bookingDetail']['type'] == 'open' || $input['bookingDetail']['type'] == 'lesson') {
            $booking = Booking::create([
                'payment_id' => $payment['id'],
                'type' => $input['bookingDetail']['type'],
                'date' => $input['bookingDetail']['date'],
                'status' => 'required',
                'status_booking' => 'create',
                'day_of_week' => isset($input['bookingDetail']['dayOfWeek']) ? $input['bookingDetail']['dayOfWeek'] : null,
                'court_id' => $input['bookingDetail']['court_id'],
                'extra_id' => json_encode(isset($input['bookingDetail']['extra_id']) ? $input['bookingDetail']['extra_id'] : []),
                'teacher_id' => $input['bookingDetail']['teacher_id'] ? $input['bookingDetail']['teacher_id'] : 0,
                'is_member' => $input['bookingDetail']['member'],
                'price_teacher' => isset($result_prices['price_teacher']) ? $result_prices['price_teacher'] : 0,
                'total_price' => $result_prices['total_price'],
                'hour' => $input['bookingDetail']['hour_start'],
                'hour_length' => $input['bookingDetail']['hour_length'],
                'player_id' => $input['customerDetail']['player_id'],
                'num_player' => isset($input['players']['player_num']) ? $input['players']['player_num'] : null,
                'billing_info' => json_encode($billing_info),
                'payment_info' => json_encode($input['paymentDetail']),
                'players_info' => json_encode(['name'=>isset($input['players']['names']) ? $input['players']['names']: [],
                    'email'=>isset($input['players']['emails']) ? $input['players']['emails'] : [] ]),
                'source' => isset($input['players']['source']) ? $input['players']['source'] : 0,
                'notes' => isset($text_notes) ? $text_notes : null
            ]);
            return [
                'error' => false,
                'booking' => $booking
            ];
        }else if($input['bookingDetail']['type'] == 'contract') { //save with type contract

            $contract = Contract::where('id',$input['bookingDetail']['contract_id'])->first();
            $range_date = createRangeDate($contract['start_date'],$contract['end_date'],$input['bookingDetail']['dayOfWeek']);

            $booking = null;
            foreach($range_date as $date) {
                $booking = Booking::create([
                    'payment_id' => $payment['id'],
                    'type' => $input['bookingDetail']['type'],
                    'date' => $date,
                    'date_range_of_contract' => json_encode(['from'=>$contract['start_date'],'to'=>$contract['end_date']]),
                    'status' => 'required',
                    'status_booking' => 'create',
                    'info_contract' => json_encode(['id'=>$contract['id'], 'start_date'=> $contract['start_date'],'end_date'=> $contract['end_date']]),
                    'day_of_week' => isset($input['bookingDetail']['dayOfWeek']) ? $input['bookingDetail']['dayOfWeek'] : null,
                    'court_id' => $input['bookingDetail']['court_id'],
                    'extra_id' => json_encode(isset($input['bookingDetail']['extra_id']) ? $input['bookingDetail']['extra_id'] : []),
                    'teacher_id' => $input['bookingDetail']['teacher_id'] ? $input['bookingDetail']['teacher_id'] : 0,
                    'is_member' => $input['bookingDetail']['member'],
                    'price_teacher' => isset($result_prices['price_teacher']) ? $result_prices['price_teacher'] : 0,
                    'total_price' => $result_prices['total_price'],
                    'hour' => $input['bookingDetail']['hour_start'],
                    'hour_length' => $input['bookingDetail']['hour_length'],
                    'player_id' => $input['customerDetail']['player_id'],
                    'num_player' => isset($input['players']['player_num']) ? $input['players']['player_num'] : null,
                    'billing_info' => json_encode($billing_info),
                    'payment_info' => json_encode($input['paymentDetail']),
                    'players_info' => json_encode(['name'=>isset($input['players']['names']) ? $input['players']['names']: [],
                        'email'=>isset($input['players']['emails']) ? $input['players']['emails'] : [] ]),
                    'source' => isset($input['players']['source']) ? $input['players']['source'] : 0,
                    'notes' => isset($text_notes) ? $text_notes : null
                ]);
            }

            return [
                'error' => false,
                'booking' => $booking
            ];
        }

    }
    return response()->json([
        'error' => true,
        "messages" => ['Error. Input invalid or it was booked']
    ]);
}