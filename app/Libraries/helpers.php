<?php

use App\Models\Auth\User;
use App\Models\Booking;
use App\Models\Contexts\Court;
use App\Models\Contract;
use App\Models\CourtRate;
use App\Models\Deal;
use App\Models\TimeUnavailable;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        ->select(['deals.*','courts.name as court_name','clubs.name as club_name', 'clubs.address', 'clubs.image'])
        ->limit(12)
        ->get();
    return $deals;
}

function calPriceForBooking($court_id, $date, $hour_start, $hour_length, $is_member,$type = 'open'){
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
        $court = Court::where('id',$court_id)->first();
        $table_rate = Contract::where('start_date', '<=', $date)
            ->where('end_date', '>=', $date)
            ->where('club_id', $court['club_id'])
            ->where('is_member', $is_member)
            ->orderBy('updated_at', 'DESC')
            ->first();
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
                'error' => false,
                'price' => "N/A"
            ];
        }
        $total_price += $rates_full[$tmp_index][$index_json] / 2;
    }
    return [
        'error' => false,
        'price' => $total_price
    ];
}

//caculator price and check is book
function getPriceForBooking($input){//[date,type,hour_start,hour_length,court_id,club_id,contract_id,member]
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
                'total_price' => $total_price
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
            'club_id.exists'      => 'The selected club is invalid.',
            'court_id.required'  => 'The selected court is invalid.',
            'club_id.required'      => 'The selected club is invalid.',
        ];
        $v = Validator::make($input, [
            'contract_id' => 'required',
            'dayOfWeek' => 'required',
            'hour_start' => 'required',
            'hour_length' => 'required',
            'court_id' => 'required|exists:courts,id',
            'club_id' => 'required|exists:clubs,id',
        ],$messages);

        if($v->fails())
        {
            return ['error' => true,"messages"=>$v->errors()->all()];
        }

        //contract
        $contract = Contract::where('id',$input['contract_id'])->first();
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
                $err .= "Detail: Date " . $date . " at " . $input['hour_start'] . "hour - " . ($input['hour_start'] + $input['hour_length']) . "hour";
                return ['error' => true, "messages" => [$err]];
            }
        }

        $total_price = 0;
        $price_extra = 0;
        $r= calPriceForBooking($input['court_id'],$range_date[0],$input['hour_start'],$input['hour_length'],$input['member'],'contract');
        if(isset($input['extra_id']) && is_array($input['extra_id']))
        foreach($input['extra_id'] as $item){
            foreach($contract['extras'] as $extra){
                if($item == $extra['name'])
                    $price_extra += $extra['value'];
            }
        }

        if($r['error']){
            return ['error' => true,"status"=>$r['status']];
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