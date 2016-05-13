<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex(Request $request)
    {
//        \Assets::addJavascript(['bootstrap-table']);
//        \Assets::addStylesheets(['bootstrap-table']);
        return view('admin.reports.index');
    }
    public function getData(Request $request)
    {
        $take = $request->take ?: 10;
        $data = Booking::join('courts','courts.id','=','bookings.court_id')
            //->where('courts.club_id',$request->clubid)
            ->where('bookings.status_booking',"!=",'cancel')
            ->select(["bookings.*",'courts.club_id'])
            ->orderBy('created_at','desc')
            ->paginate($take);
        return $data;
    }
}
