<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contexts\Court;
use App\Models\SetOpenDay;
use App\Repositories\Interfaces\Admin\ClubInterface;
use DateTime;

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
    public function postSetOpenDay(Request $request){
        $errors = [];
        $dayOfWeekTitle = ['mon','tue','wed','thur','fri','sat','sun'];
        if(empty($request->input('days')) || empty($request->input('hours')) || empty($request->input('end_date'))
            || empty($request->input('start_date')) || empty($request->input('club_id'))){
            $errors[] = "Data invalid.";
        }
        if(count($errors) > 0)
        {
            return response()->json(['error' => true,"messages"=>$errors]);
        }

        $dates = $this->createDateRange($request->input('start_date'), $request->input('end_date'));
        foreach($dates as $date){
            $tmp = SetOpenDay::whereDate($date);
            if(!isset($tmp)) {
                $item = new SetOpenDay();
                $item['date'] = $date;
                $item['hours'] = $request->input('hours');
                $item['club_id'] = $request->input('club_id');
                $item->save();
            }else{
                $tmp['hours'] = $request->input('hours');
                $tmp->update();
            }
        }
        return response()->json([
            'error' => false,
            'success' => 'Set Set Opening Hours/Holiday Days successfully!',
        ]);
    }
    public function getSetOpenDay(Request $request){
        $errors = [];
        $dayOfWeekTitle = ['mon','tue','wed','thur','fri','sat','sun'];
        if(empty($request->input('days')) || empty($request->input('hours')) || empty($request->input('end_date'))
            || empty($request->input('start_date')) || empty($request->input('club_id'))){
            $errors[] = "Data invalid.";
        }
        if(count($errors) > 0)
        {
            return response()->json(['error' => true,"messages"=>$errors]);
        }

        $dates = $this->createDateRange($request->input('start_date'), $request->input('end_date'));
        foreach($dates as $date){
            $tmp = SetOpenDay::whereDate($date);
            if(!isset($tmp)) {
                $item = new SetOpenDay();
                $item['date'] = $date;
                $item['hours'] = $request->input('hours');
                $item['club_id'] = $request->input('club_id');
                $item->save();
            }else{
                $tmp['hours'] = $request->input('hours');
                $tmp->update();
            }
        }
        return response()->json([
            'error' => false,
            'success' => 'Set Set Opening Hours/Holiday Days successfully!',
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
