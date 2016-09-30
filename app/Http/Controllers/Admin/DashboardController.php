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
        //return view('admin.index');
        return redirect()->route("booking.index");
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

        foreach ($clubs as &$club){
            $commission_prices = json_decode($club->commission_prices);
            if(isset($commission_prices->flat_fee) && $commission_prices->flat_fee == 'true'){
                $club->flat_fee = true;
                $club->price_flat_fee = isset($commission_prices->price_flat_fee) ? $commission_prices->price_flat_fee : 0;
                $club->down_box_flat_fee = isset($commission_prices->down_box_flat_fee) ? $commission_prices->down_box_flat_fee : null;
                $club->otb_front_per = 0;
                $club->otb_front_mon = 0;
                $club->otb_back_per = 0;
                $club->otb_back_mon = 0;
                $club->ctb_front_per = 0;
                $club->ctb_front_mon = 0;
                $club->ctb_back_per = 0;
                $club->ctb_back_mon = 0;
            }else{
                $club->flat_fee = false;
                $club->price_flat_fee = 0;
                $club->down_box_flat_fee = null;
                $club->otb_front_per = isset($commission_prices->otb_front_per) ? $commission_prices->otb_front_per : 0;
                $club->otb_front_mon = isset($commission_prices->otb_front_mon) ? $commission_prices->otb_front_mon : 0;
                $club->otb_back_per = isset($commission_prices->otb_back_per) ? $commission_prices->otb_back_per : 0;
                $club->otb_back_mon = isset($commission_prices->otb_back_mon) ? $commission_prices->otb_back_mon : 0;
                $club->ctb_front_per = isset($commission_prices->ctb_front_per) ? $commission_prices->ctb_front_per : 0;
                $club->ctb_front_mon = isset($commission_prices->ctb_front_mon) ? $commission_prices->ctb_front_mon : 0;
                $club->ctb_back_per = isset($commission_prices->ctb_back_per) ? $commission_prices->ctb_back_per : 0;
                $club->ctb_back_mon = isset($commission_prices->ctb_back_mon) ? $commission_prices->ctb_back_mon : 0;
            }
        }
        
        return $clubs;
    }

    /*setting*/
    public function getSetting(){
        return redirect()->route('admin.setting.pages');
        //return view('admin.settings.index');
    }
}
