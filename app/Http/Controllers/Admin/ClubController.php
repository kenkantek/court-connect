<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contexts\Court;
use App\Models\CourtRateDetail;
use App\Models\SetOpenDay;
use App\Repositories\Interfaces\Admin\ClubInterface;
use DateTime;
use DB;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function __construct(ClubInterface $clubRepository)
    {
        $this->clubRepository = $clubRepository;
    }

    public function getSetting()
    {
        \Assets::addJavascript(['select2', 'bootstrap-switch', 'uniform', 'monthly', 'moment', 'timepicker', 'datetimepicker', 'daterangepicker', 'bootstrap-multiselect']);
        \Assets::addStylesheets(['select2', 'bootstrap-switch', 'uniform', 'monthly', 'timepicker', 'datetimepicker', 'daterangepicker', 'bootstrap-multiselect', 'jquery-ui']);
        $title = 'Club Setting';
        return view('admin.clubs.setting', compact('title'));
    }

    public function getCourts(Request $request)
    {
        $take    = $request->take ?: 10;
        $clubid    = $request->clubid;
        $courts = Court::where('club_id', $clubid)->with('surface', 'rates')->orderBy('name', 'asc')->paginate($take)->appends(['take' => $take]);
        return $courts;
    }
    public function getListDays(Request $request){
        $tmp = date_format(date_create($request->input('year')."-".$request->input('month')),"Y-m");
        $data = SetOpenDay::where('club_id',$request->input('club_id'))->where('date','LIKE', "%".$tmp."%")->get();
        if(empty($data))
            return response()->json(['error' => true,"messages"=>['Data invalid']]);
        return response()->json([
            'error' => false,
            'data' => $data
        ]);
    }
    public function postSetEventDay(Request $request){
        if(empty($request->input('club_id')) || empty($request->input('date')) || empty($request->input('is_event'))){
            return response()->json(['error' => true,"messages"=>['Data invalid']]);
        }
        else{
            $date = date_format(date_create($request->input('date')),"Y-m-d");
            $tmp = SetOpenDay::where('date',$date)->where('club_id',$request->input('club_id'))->first();
            if(!isset($tmp)) {
                $tmp = new SetOpenDay();
                $tmp['date'] = $date;
                $tmp['open_time'] = "";
                $tmp['close_time'] = "";
                $tmp['club_id'] = $request->input('club_id');
                $tmp->save();
            }
            if(!isset($tmp)){
                return response()->json(['error' => true,"messages"=>['Can\'t find date valid']]);
            }
            else{
                $is_event = $request->input('is_event');
                if($is_event == 'holiday')
                    $tmp['is_holiday'] = $tmp['is_holiday'] == 1 ? 0 : 1;
                if($is_event == 'close')
                    $tmp['is_close'] = $tmp['is_close'] == 1 ? 0 : 1;
                if($is_event == 'sethours'){
                    if(empty($request->input('open_time')) || empty($request->input('close_time'))){
                        return response()->json(['error' => true,"messages"=>['Data hours invalid']]);
                    }
                    $tmp['open_time'] = $request->input('open_time');
                    $tmp['close_time'] = $request->input('close_time');
                    $tmp['is_close'] = 0;
                }
                $tmp->update();
            }
            return response()->json([
                'error' => false,
                'success' => 'Set Opening Hours/Holiday Days successfully!',
            ]);
        }
    }

    public function postSetOpenDay(Request $request){
        $errors = [];
        if(empty($request->input('open_time')) || empty($request->input('close_time'))  || empty($request->input('end_date'))
            || empty($request->input('start_date')) || empty($request->input('club_id'))){
            $errors[] = "Data invalid.";
        }
        if(count($errors) > 0)
        {
            return response()->json(['error' => true,"messages"=>$errors]);
        }

        $dates = $this->createDateRange($request->input('start_date'), $request->input('end_date'));
        foreach($dates as $date){
            if(is_array($request->input('days')) && count($request->input('days')) > 0 && !in_array(date("N",strtotime($date)), $request->input('days')))
                continue;
            $tmp = SetOpenDay::where('club_id',$request->input('club_id'))->where('date',$date)->first();
            if(!isset($tmp)) {
                $item = new SetOpenDay();
                $item->date = $date;
                $item->open_time = $request->input('open_time');
                $item->close_time = $request->input('close_time');
                $item->club_id= $request->input('club_id');
                $item->save();
            }else{
                $tmp->open_time = $request->input('open_time');
                $tmp->close_time = $request->input('close_time');
                $tmp->update();
            }
        }
        return response()->json([
            'error' => false,
            'success' => 'Set Opening Hours/Holiday Days successfully!',
        ]);
    }
    
    function createDateRange($startDate, $endDate)
    {
        $range = [];
        $begin = new DateTime($startDate);
        $end = new DateTime($endDate);

        for($i = $begin; $begin <= $end; $i->modify('+1 day')){
            $range[] = $i->format("Y-m-d");
        }

        return $range;
    }
    public function getManagerBookings()
    {
        \Assets::addJavascript(['select2', 'uniform', 'monthly', 'moment', 'ionslider', 'timepicker', 'datetimepicker', 'daterangepicker', 'bootstrap-multiselect']);
        \Assets::addStylesheets(['select2', 'uniform', 'monthly', 'ionslider', 'timepicker', 'datetimepicker', 'daterangepicker', 'bootstrap-multiselect']);
        return view('admin.clubs.manager_bookings');
    }
    public function getStates(){
        $data = DB::table('states')->get();
        return response()->json([
            'error' => false,
            'data' => $data
        ]);
    }

    public function getCitys(Request $request){
        $data = DB::table('citys')->where('state_code',$request->input('state_id'))->orderBy('name')->get();
        return response()->json([
            'error' => false,
            'data' => $data
        ]);
    }

}
