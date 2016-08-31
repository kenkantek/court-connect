<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Deal;
use Illuminate\Support\Facades\DB;
use Exception;

class HomeController extends Controller
{

    public function getIndex()
    {
        $deals = getDeals();
        //return $deals;
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
            ->where(function($query){
                $query_clone = clone $query;
                $data = $query_clone->where('deals.date', '>=', date("Y-m-d"))->get();
                $arr_book = [];
                foreach ($data as $item){
                    $input = [
                        'date' => $item->date,
                        'type' => 'open',
                        'hour_start' => $item->hour,
                        'hour_length' => $item->hour_length,
                        'member' => 0,
                        'court_id' => $item->court_id
                    ];
                    $price = getPriceForBooking($input);
                    if($price['error'] == false)
                        $arr_book[] = $item->id;
                }
                //print_r($arr_book);
                $query->whereIn('deals.id', $arr_book);
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

    public function getAlert(){
        return view('home.pages.alert');
    }

}
