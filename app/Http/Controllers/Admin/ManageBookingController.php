<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contexts\Club;
use App\Models\Contexts\Court;
use App\Models\CourtRateDetail;
use App\Models\DateClub;
use App\Models\SetOpenDay;
use App\Repositories\Interfaces\Admin\ClubInterface;
use DateTime;
use DB;
use Illuminate\Http\Request;

class ManageBookingController extends Controller
{

    public function getManageBooking()
    {
        \Assets::addJavascript(['select2', 'uniform', 'monthly', 'moment', 'ionslider', 'timepicker', 'datetimepicker', 'daterangepicker', 'bootstrap-multiselect']);
        \Assets::addStylesheets(['select2', 'uniform', 'monthly', 'ionslider', 'timepicker', 'datetimepicker', 'daterangepicker', 'bootstrap-multiselect']);
        return view('admin.booking.index');
    }

    public function getDataOfDateOfClub(Request $request){
        $date = (new DateTime($request->input('date')))->format("Y-m-d");
//        $date_club = DateClub::with('court_rate_details')
//            ->where('club_id',$request->input('club_id'))
//            ->where('date', $date)->first();
//        if(empty($date_club))
//            return response()->json(['error' => true,"messages"=>['Data invalid']]);
//        $list_court = Court::where('club_id',$request['club_id'])->get();

//        $date_club = DB::table('date_club')
//            ->where('date_club.club_id',$request->input('club_id'))
//            ->where('date_club.date', $date)
//            ->join('court_rate_details', 'date_club.id', '=', 'court_rate_details.date_club_id')
//            ->join('courts', 'courts.club_id', '=', 'date_club.club_id')
//            ->get();
//        $date_club = DB::table('courts')->with('court_rate_details')
//            ->where('courts.club_id',$request->input('club_id'))
//            ->join('date_club', 'date_club.club_id', '=', 'courts.club_id')
//            //->LeftJoin('court_rate_details', 'court_rate_details.court_id','=','courts.id')
//            ->where('date_club.date', $date)
//            ->get(['courts.*']);

//        $courts = Court::with('date_club','court_rate_details')
//            ->where('club_id',$request->input('club_id'))
//            ->whereHas('court_rate_details', function($q) user $date{
//                $q->where('date', $date)->get();
//            });

        print_r($courts);
//        if(empty($date_club))
//            return response()->json(['error' => true,"messages"=>['Data invalid']]);
//        echo count($date_club);
//        return response()->json([
//            'success' => true,
//            'data' => ['result'=>$date_club]
//        ]);
    }
}
