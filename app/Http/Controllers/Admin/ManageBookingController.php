<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Contexts\Club;
use App\Models\Contexts\Court;
use App\Models\CourtRate;
use App\Models\CourtRateDetail;
use App\Models\DateClub;
use App\Models\Player;
use App\Models\SetOpenDay;
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
        \Assets::addJavascript(['select2','uniform', 'monthly', 'moment', 'ionslider', 'timepicker', 'datetimepicker', 'daterangepicker', 'bootstrap-multiselect']);
        \Assets::addStylesheets(['select2','uniform', 'monthly', 'ionslider', 'timepicker', 'datetimepicker', 'daterangepicker', 'bootstrap-multiselect']);
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
        //[5,5.5,6,6.5,7,7.5,8,8.5,9,9.5,10,10.5,11,11.5,12,12.5,13,13.5,
          //  14,14.5,15,15.5,16,16.5,17,17.5,18,18.5,19,19.5,20,20.5,21,21.5,22];
        $courts = Court::where('club_id',$request->input('club_id'))
            ->select(['id','name'])->get();
        foreach($courts as $k=>$court){
            $arr_hour = [];
            foreach($hours as $key=>$hour) {
                $arr_hour["h_" . $hour]['hour'] = $hour;
                $arr_hour["h_" . $hour]['status'] = 'available';
                $arr_hour["h_" . $hour]['content'] = '';
                $arr_hour["h_" . $hour]['booking_id'] = '';
            }
            $bookings = Booking::where('date',$date)->where('court_id',$court['id'])->get();
            foreach($bookings as $booking){
                $tmp_i = 0;
                for($i=$booking['hour']; $i < $booking['hour'] + $booking['hour_length']; $i+=0.5){
                    $user_info = json_decode($booking['user_info']);
                    $arr_hour["h_".$i]['status'] = $booking['type'];
                    $arr_hour["h_".$i]['booking_id'] = $booking['id'];
                    $arr_hour["h_".$i]['content'] = $user_info->firstname. " ". $user_info->lastname;
                    if($tmp_i % 2 == 0)
                        $arr_hour["h_" . $i]['g_start'] = "start";
                    else
                        $arr_hour["h_" . $i]['g_end'] = "end";
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

    //caculator price and check is book
    function calPrice($request){
        $errors = array();
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

            //check book
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

            //cal price
            $court_rate = CourtRate::where('start_date','<=',$date)
                ->where('end_date','>=',$date)
                ->where('court_id',$request->input('court_id'))
                ->where('is_member',$request->input('member'))
                ->first();
            if(empty($court_rate))
                return ['error' => true,"messages"=>["Can't found data"]];

            $dayOfWeek = date('w', strtotime($date));
            $index_json = "A".strval($dayOfWeek == 0 ? 7 : $dayOfWeek);
            $rates = $court_rate['rates'];
            $total_price = 0;
            $index_hour = $request->input('hour_start') - 5; // hour begin: 5am

            for($i=0; $i < $request->input('hour_length'); $i++){
                $total_price += $rates[$index_hour+$i][$index_json];
            }
            return [
                'success' => true,
                'total_price' => $total_price
            ];
        }

        return ['error' => true,"messages"=>["Booking type invalid"]];
    }
    //view price order
    public function  getViewPriceOrder(Request $request){
        $result = $this->calPrice($request);
        return response()->json($result);
    }

    public function getCheckInputBooking(Request $request){
        $result = $this->calPrice($request);
        if(isset($result['success'])){
            $result['court_detail'] = Court::find($request->input('court_id'))->first();
            return response()->json($result);
        }
        return response()->json($result);
    }

    public function getCheckInputCustomer(Request $request){
        $v = Validator::make($request->all(), [
            'title' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'zipcode' => 'required',
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

    public function postCheckInputPayment(Request $request){
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
            'player_id' => 1,
            'num_player' => $inputBookingDetail->num_player,
            'user_info' => $request->input('customer'),
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
        return response()->json([
            'success' => true,
            'booking' => $booking
        ]);
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

    //ajax search player
    public function getSearchPlayers(Request $request){
        $players = Player::where('email','LIKE','%'.$request['q'].'%')->limit(10)->select(['email','id','address1'])->get();
        return $players;
    }
}
