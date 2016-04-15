<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Date;
use DateTime;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        /*
        // create date from range date
        $range_date = [];
        $begin = new DateTime("2016-01-01");
        $end = new DateTime("2050-01-01");

        for($i = $begin; $begin <= $end; $i->modify('+1 day')){
            $range_date[] = $i->format("Y-m-d");
        }
        foreach($range_date as $date){
            $tmp = Date::where('date',$date)->first();
            if(!isset($tmp)) {
                $item = new Date();
                $item['date'] = $date;
                $item->save();
            }
        }
        */
        return view('admin.index');
    }
    public function getAddContext(Request $request)
    {
        session()->put('context_id', $request->input('club_id'));
        return $request->input('club_id');
    }
    public function getClubs()
    {
        $user = auth()->user();
        $clubs = $user->clubs()->get();
        return $clubs;
    }
}
