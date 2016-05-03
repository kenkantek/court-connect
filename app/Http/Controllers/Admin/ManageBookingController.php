<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Contexts\Club;
use App\Models\Contexts\Court;
use App\Models\CourtRate;
use App\Models\Deal;
use App\Models\Payments\Payment;
use App\Models\Player;
use App\Models\SetOpenDay;
use App\Models\TimeUnavailable;
use App\Repositories\Interfaces\Admin\ClubInterface;
use Carbon\Carbon;
use DateTime;
use DB;
use Illuminate\Http\Request;
use Validator;

class ManageBookingController extends Controller
{

    public function getManageBooking()
    {
        \Assets::addJavascript(['select2','uniform', 'monthly', 'moment', 'ionslider', 'timepicker', 'datetimepicker', 'daterangepicker', 'bootstrap-multiselect', 'jquery-ui']);
        \Assets::addStylesheets(['select2','uniform', 'monthly', 'ionslider', 'timepicker', 'datetimepicker', 'daterangepicker', 'bootstrap-multiselect', 'jquery-ui']);
        return view('admin.booking.index');
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
//            'success' => true,
//            'data' => $courts
//        ]);
    }

    public function getDataOfClub(Request $request){
        $date = Carbon::createFromFormat('m/d/Y', $request->input('date'))->format("Y-m-d");
        $hours = range(5,22.5,0.5);

        $courts = Court::where('club_id',$request->input('club_id'))
            ->select(['id','name'])->get();

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
                'success' => true,
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
            $bookings = Booking::where('date',$date)->where('court_id',$court['id'])->get();
            foreach($bookings as $booking){
                $tmp_i = 0;
                for($i=$booking['hour']; $i < $booking['hour'] + $booking['hour_length']; $i+=0.5){
                    if($booking['player_id'] == 0) {
                        $player_info = json_decode($booking['player_info']);
                        $arr_hour["h_".$i]['content'] = $player_info->first_name. " ". $player_info->last_name;
                    }else{
                        $player_info = Player::where('id',$booking['player_info'])->first();
                        if($player_info)
                            $arr_hour["h_".$i]['content'] = $player_info['first_name']. " ". $player_info['last_name'];
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
            'success' => true,
            'data' => $courts
        ]);
    }

    //get price
    private function getPrice($court_id, $date, $hour_start, $hour_length, $is_member){
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
                'message' => "Unavailable (".$unavailable[0]['reason'].")"
            ];
        }
        $court_rate= CourtRate::where('start_date','<=',$date)
            ->where('end_date','>=',$date)
            ->where('court_id',$court_id)
            ->where('is_member',$is_member)
            ->orderBy('updated_at','DESC')
            ->first();

        if(!isset($court_rate)){
            return [
                'error' => true,
                'message' => "The court is not a set price"
            ];
        }

        $dayOfWeek = date('w', strtotime($date));
        $index_json = "A".strval($dayOfWeek == 0 ? 7 : $dayOfWeek);
        $total_price = 0;

        $rates = $court_rate['rates'];
        $deals = Deal::where('date',$date)->where('court_id',$court_id)
            ->orderBy('updated_at','asc')
            ->get();

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
            $total_price += $rates_full[$tmp_index][$index_json] / 2;
        }
        return [
            'error' => false,
            'price' => $total_price
        ];
    }

    //accept payment
    public function getAcceptPayment($booking_id){
        $booking = Booking::find($booking_id)->first();
        if(!isset($booking)){
            return ['error' => true, "messages" => ["Not found data"]];
        }
        $booking['status'] = "paid";
        $booking->update();
        return response()->json([
            'success' => true,
        ]);
    }

    //cancle booking
    public function putDelete($booking_id){
        $booking = Booking::find($booking_id)->first();
        if(!isset($booking)){
            return ['error' => true, "messages" => ["Not found data"]];

        }
        $booking->delete();
        return response()->json([
            'success' => true,
        ]);
    }

    //ajax search player
    public function getSearchPlayers(Request $request){
        $players = Player::where('email','LIKE','%'.$request['q'].'%')->limit(10)->select(['email','id','address1'])->get();
        return $players;
    }

    //get address lookup
    public function getAddressLookup($zipcode){
        $city = City::with('state')->where('zipcode',$zipcode)->select(['citys.name as city','states.name as state'])->first();
        if(!isset($booking)){
            return ['error' => true, "messages" => ["Not found data"]];
        }
        return response()->json([
            'success' => true,
            'data' => $city
        ]);
    }

    public function getCheckPlayerforBooking($player_id){
        $player = Player::where('id',$player_id)->first();
        if(!isset($player)){
            return ['error' => true, "messages" => ["Not found data"]];
        }
        return response()->json([
            'success' => true,
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
            $r = $this->getPrice($court_id,$date,$hour, $tmp_inc_hour,1);
            $price_member[] = !$r['error'] ? $r['price']: $r['message'];
            $tmp_inc_hour+=0.5;
        }

        $tmp_inc_hour = 1;
        $price_nonmember = [];
        for($i=$hour; $i< $hour + $limit_hour; $i++) {
            $r = $this->getPrice($court_id,$date,$hour, $tmp_inc_hour,0);
            $price_nonmember[] = !$r['error'] ? $r['price']: $r['message'];
            $tmp_inc_hour+=0.5;
        }

        $data['lb_hour'] = $arr_lb_hour;
        $data['price_member'] = $price_member;
        $data['price_nonmember'] = $price_nonmember;

        return [
            'success' => true,
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
                'success' => true,
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
                    'success' => true,
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
        $price_member = $this->getPrice($court_id,$date,$hour, $hour_length,1);
        $data['price_member']= !$price_member['error'] ? $price_member['price']: $price_member['message'];

        $price_nonmember = $this->getPrice($court_id,$date,$hour, $hour_length,0);
        $data['price_nonmember']= !$price_nonmember['error'] ? $price_nonmember['price']: $price_nonmember['message'];

        $data['date_text'] = Carbon::createFromFormat('m/d/Y', $request->input('date'))->format("l jS \of F Y");
        $data['time'] = ($hour <=12 ? str_replace(".5",":30",$hour)."am" : str_replace(".5",":30",($hour - 12))."pm") . "-" .
            ($hour + $hour_length <=12 ? str_replace(".5",":30",$hour + $hour_length)."am" : str_replace(".5",":30",$hour + $hour_length - 12)."pm");

        return [
            'success' => true,
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
                'success' => true,
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
                    'success' => true,
                ];
            else return [
                'error' => true
            ];
        }
    }


    /*BOOKING*/
    //caculator price and check is book
    function calPriceForBooking($request){
        $errors = array();
        if(!$request->input('date'))
            return ['error' => true, "messages" => ["Select a date"]];

        $date = Carbon::createFromFormat('m/d/Y', $request->input('date'))->format("Y-m-d");
        if($request->input('type') == 'open'){
            $messages = [
                'hour_start'    => 'The Select a Time field is required.',
                'hour_length'    => 'The Select a Court field is required.',
                'court_id.exists'  => 'The selected court is invalid.',
                'club_id.exists'      => 'The selected club is invalid.',
                'court_id.required'  => 'The selected court is invalid.',
                'club_id.required'      => 'The selected club is invalid.',
            ];
            $v = Validator::make($request->all(), [
                'date' => 'required',
                'hour_start' => 'required',
                'hour_length' => 'required',
                'court_id' => 'required|exists:courts,id',
                'club_id' => 'required|exists:clubs,id',
            ],$messages);

            if($v->fails())
            {
                return ['error' => true,"messages"=>$v->errors()->all()];
            }

            //check book is exist
            $check_book = Booking::where('date',$date)
                ->where(function ($q) use($request) {
                    $q->whereIn('hour', range($request->input('hour_start'), $request->input('hour_start') + $request->input('hour_length') - 0.5,0.5))
                        ->orWhere(function ($q) use ($request) {
                            $q->where('hour', '<', $request->input('hour_start'))
                                ->whereRaw('hour + hour_length > '.$request->input('hour_start'));
                        })
                        ->orWhere(function ($q) use ($request) {
                            $q->whereRaw('hour + hour_length < '.$request->input('hour_length'))
                                ->whereRaw('hour + hour_length > '.$request->input('hour_length'));
                        });
                })
                ->first();
            if(!empty($check_book))
                return ['error' => true, "messages" => ["This was book. Please select another time or date"]];

            $r = $this->getPrice($request->input('court_id'),$date,
                $request->input('hour_start'),$request->input('hour_length'),$request->input('member'));

            if($r['error']){
                return ['error' => true,"messages"=>[$r['message']]];
            }else {
                $total_price = $r['price'];
                return [
                    'success' => true,
                    'total_price' => $total_price
                ];
            }
        }

        return ['error' => true,"messages"=>["Booking type invalid"]];
    }
    //view price order
    public function getViewPriceOrder(Request $request){
        $result = $this->calPriceForBooking($request);
        return response()->json($result);
    }

    public function getCheckCourtBooking(Request $request){
        $result = $this->calPriceForBooking($request);
        if(isset($result['success'])){
            $result['court_detail'] = Court::find($request->input('court_id'))->first();
            return response()->json($result);
        }
        return response()->json($result);
    }

    public function getCheckInputCustomer(Request $request){
        $v = Validator::make($request->all(), [
            'title' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'zip_code' => 'required | integer | min: 5',
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
            'success' => true,
        ];

    }

    public function postPayment(Request $request){
        $v = Validator::make((array) json_decode($request->input('payment')), [
            'type' => 'required',
            'card_number' => 'required|integer',
            'expiry' => 'required',
            'cvv' => 'required|integer',
        ]);

        if($v->fails())
        {
            return ['error' => true,"messages"=>$v->errors()->all()];
        }

        $inputBookingDetail = json_decode($request->input('infoBooking'));
        $customerDetail = json_decode($request->input('customer'));
        $paymentDetail = $request->input('payment');
        if($inputBookingDetail->member == 1) {
            $player_id =  $customerDetail->player_id;
            $player_info = json_encode([]);
        }
        else{
            $player_id = 0;
            $player_info = $request->input('customer');
        }

        $expiry = explode("/",$paymentDetail['expiry']);
        //stripe
        try {
            $token = Stripe::tokens()->create([
                'card' => [
                    'number' => $paymentDetail['card_number'],
                    'exp_month' => $expiry[0],
                    'exp_year' => $expiry[1],
                    'cvc' => $paymentDetail['cvc'],
                ],
            ]);
        }catch (Exception $e){
            return ['error' => true,"messages"=>[$e->getMessage()]];
        }

        $customer = Stripe::customers()->create([
            'email'       => $customerDetail['email'],
            'source'      => $token['id'],
        ]);

        $charge = Stripe::charges()->create([
            'customer' => $customer['id'],
            'currency' => 'USD',
            'amount'   => 50.49,
        ]);

        Payment::create([
            'user_id' => 0,
            'card_number' => $paymentDetail['card_number'],
            'amount' => $request->input('total_price'),
            'exp_month' => $expiry['0'],
            'exp_year' => $expiry['1'],
            'cvv'       => $paymentDetail['cvv'],
            'stripe_transaction_id' => $charge['id'],
        ]);

        $booking = Booking::create([
            'type' => $inputBookingDetail->type,
            'date' => $inputBookingDetail->date,
            'date_range' => $inputBookingDetail->date_range,
            'day_of_week' => is_numeric($inputBookingDetail->dayOfWeek) ? $inputBookingDetail->dayOfWeek : 0,
            'court_id' => $inputBookingDetail->court_id,
            'extra_id' => json_encode($inputBookingDetail->extra_id),
            'teacher_id' => is_numeric($inputBookingDetail->teacher_id) ? $inputBookingDetail->teacher_id : 0,
            'is_member' => $inputBookingDetail->member,
            'total_price' => $request->input('total_price'),
            'hour' => $inputBookingDetail->hour_start,
            'hour_length' => $inputBookingDetail->hour_length,
            'player_id' => $player_id,
            'num_player' => $inputBookingDetail->num_player,
            'player_info' => $player_info,
            'payment_info'=> $request->input('payment')
        ]);
        return [
            'success' => true,
            'booking_id' => $booking['id']
        ];
    }

    //get view booking
    public function getView($booking_id){
        $booking = Booking::whereId($booking_id)->with('court')->first();
        if(!isset($booking)){
            return ['error' => true, "messages" => ["Not found data"]];
        }
        if($booking['player_id'] != 0) {
            $player_info = Player::where('id',$booking['player_id'])->select(["first_name","last_name","email","phone","address1","city","state"])->first();
            if($player_info)
                $booking['player_info'] = json_encode($player_info);
        }
        return response()->json([
            'success' => true,
            'booking' => $booking
        ]);
    }

}
