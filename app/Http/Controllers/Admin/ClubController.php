<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contexts\Court;
use App\Models\SetOpenDay;
use App\Repositories\Interfaces\Admin\ClubInterface;
use DateTime;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function __construct(ClubInterface $clubRepository)
    {
        $this->clubRepository = $clubRepository;
    }

    public function getSetting()
    {
        \Assets::addJavascript(['select2', 'uniform', 'monthly', 'moment', 'timepicker', 'datetimepicker', 'daterangepicker', 'bootstrap-multiselect', 'jquery-ui']);
        \Assets::addStylesheets(['select2', 'uniform', 'monthly', 'timepicker', 'datetimepicker', 'daterangepicker', 'bootstrap-multiselect', 'jquery-ui']);
        $title = 'Club Setting';
        return view('admin.clubs.setting', compact('title'));
    }
    public function getSetting1(){
        \Assets::addJavascript(['select2', 'uniform', 'monthly', 'moment', 'timepicker', 'datetimepicker', 'daterangepicker', 'bootstrap-multiselect', 'jquery-ui']);
        \Assets::addStylesheets(['select2', 'uniform', 'monthly', 'timepicker', 'datetimepicker', 'daterangepicker', 'bootstrap-multiselect', 'jquery-ui']);
        $title = 'CLub Setting';
        return view('admin.clubs.setting1', compact('title'));
    }
    public function getCourts($club_id)
    {
        $courts = Court::where('club_id', $club_id)->with('surface', 'rates')->paginate(50);
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
    public function getSetEventDay(Request $request){
        if(empty($request->input('date')) || empty($request->input('is_event'))){
            return response()->json(['error' => true,"messages"=>['Data invalid']]);
        }
        else{
            $date = date_format(date_create($request->input('date')),"Y-m-d");
            $tmp = SetOpenDay::where('date',$date)->first();
            if(!isset($tmp)) {
                return response()->json(['error' => true,"messages"=>['Can\'t find date valid']]);
            }else{
                $is_event = $request->input('is_event');
                if($is_event == 'holiday')
                    $tmp['is_holiday'] = $tmp['is_holiday'] == 1 ? 0 : 1;
                if($is_event == 'close')
                    $tmp['is_close'] = $tmp['is_close'] == 1 ? 0 : 1;
                if($is_event == 'sethours'){
                    if(empty($request->input('hours_open')) || empty($request->input('hours_close'))){
                        return response()->json(['error' => true,"messages"=>['Data hours invalid']]);
                    }
                    $tmp['hours'] = $request->input('hours_open')." - ".$request->input('hours_close');
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
        if(empty($request->input('hours')) || empty($request->input('end_date'))
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
                $item['date'] = $date;
                $item['hours'] = $request->input('hours');
                $item['club_id'] = $request->input('club_id');
                $item->save();
            }else{
                //var_dump($tmp);
                $tmp['hours'] = $request->input('hours');
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

}
