<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Deal;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function getIndex()
    {
        $deals = getDeals();
        return view('home.pages.index',compact('deals'));
    }

    //get deals
    public function getDeals(){
        $deals = Deal::where('deals.date', '>=', date("Y-m-d"))
            ->whereIn('deals.created_at',function($query){
                $query->select(DB::raw("MAX(created_at)"))
                    ->from('deals')
                    ->groupBy("date", "court_id", "hour", "hour_length");
            })
            ->join('courts','courts.id','=','deals.court_id')
            ->join('clubs','clubs.id','=','courts.club_id')
            ->orderBy('date','asc')
            ->select(['deals.*','courts.name as court_name','clubs.name as club_name', 'clubs.city', 'clubs.state', 'clubs.image'])
            ->paginate(6);
        return view('home.pages.deals',compact('deals'));
    }

    public function getError(){

    }

}
