<?php

namespace App\Http\Controllers\Home;

use App\Models\Booking;
use App\Models\City;
use App\Models\Contexts\Club;
use App\Models\Contexts\Court;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\ManageBookingController;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function autocomplete(Request $request){
        $term = $request->input('term');

        $results['clubs'] = array();
        $results['citys'] = array();
        $results['state'] = array();

        $queries = Club::where('name', 'LIKE', '%'.$term.'%')
            ->orWhere('zipcode', 'LIKE', '%'.$term.'%')
            ->orWhere('city', 'LIKE', '%'.$term.'%')
            ->orWhere('state', 'LIKE', '%'.$term.'%')
            ->orWhere('address', 'LIKE', '%'.$term.'%')
            ->take(5)->get();

        foreach ($queries as $query)
        {
            $results['clubs'][] = [ 'id' => $query->id, 'value' => $query->name ];
        }

        $queries = City::where('name', 'LIKE', '%'.$term.'%')
            ->orWhere('zip', 'LIKE', '%'.$term.'%')
            ->take(5)->get();

        foreach ($queries as $query)
        {
            $results['citys'][] = [ 'id' => $query->id, 'value' => $query->name, 'state'=> $query->state_code ];
        }

        $queries = State::where('name', 'LIKE', '%'.$term.'%')
            ->orWhere('state_code', 'LIKE', '%'.$term.'%')
            ->take(5)->get();

        foreach ($queries as $query)
        {
            $results['states'][] = [ 'id' => $query->id, 'value' => $query->name ];
        }
        return response()->json($results);
    }

    public function postSearch(Request $request)
    {

        $keyword =  $request->input('s_name');
        $clubs = Club::search($keyword)->paginate(5);  
        return view('home.search',compact('request','clubs'));
    }

    public function getSearch(Request $request)
    {
        $keyword_clubs = $request->input('s_name');
        $keyword_day = $request->input('date');
        $keyword_day = date("Y-m-d", strtotime($keyword_day));
        $keyword_hour_length= $request->input('mb-book-in-hour');
        $keyword_hour = $request->input('s_time');
        $keyword_hour = date("G", strtotime($keyword_hour)) + date("i", strtotime($keyword_hour))/60;
        $keyword_surface = $request->input('surface_id');
        $keyword_longtime = $request->input('mb-book-in-hour');

        $clubs = null;
        if($keyword_hour <5){

        }else {
            $clubs = Club::search($keyword_clubs)->join('set_open_days', 'clubs.id', '=', 'set_open_days.club_id')
                ->where(function ($query) use ($keyword_day) {
                    $query->where('set_open_days.date', '=', $keyword_day)
                        ->where('is_close', '=', '0');

                })
                ->select('clubs.*')->paginate(5);


            $results = Court::where('surface_id', '=', $keyword_surface)->get();

            $input = [
                'date' => $request->input('date'),
                'type' => 'open',
                //'contract_id' => $request->input('contract_id'),
                //'dayOfWeek' => $request->input('dayOfWeek'),
                //'extra_id' => $request->input('extra_id'),
                //'teacher_id' => $request->input('teacher_id'),
                'hour_start' => $keyword_hour,
                'hour_length' => $keyword_hour_length,
                'member' => 0
            ];
            foreach ($clubs as $k => $club) {
                $court = Court::with('surface')->where('club_id', $club['id'])->orderBy('updated_at', 'DESC')->first();
                $input['court_id'] = $court['id'];
                $input['club_id'] = $club['id'];
                $court['prices'] = $this->getPriceOfCourt($input);
                $clubs[$k]['court'] = $court;
            }
        }
        //return $clubs;
        return view('home.search',compact('request','clubs','keyword_hour'));
    }

    //get price follow hour of court
    function getPriceOfCourt($input){
        $bookingClass = new ManageBookingController();
        $list_price = [];
        $hour_start = 0;
        $hour_end = 0;
        if($input['hour_start'] - 5 >= 2){
            $limit_hour = $input['hour_start'] + 2 < 22 - $input['hour_length']? 2 : (int)(22 - $input['hour_start'] - 2);
            $hour_start = $input['hour_start'] -2;
            $hour_end = $input['hour_start'] + $limit_hour;
        }else if($input['hour_start'] - 5 >= 1){
            $limit_hour = $input['hour_start'] + 3 < 22 - $input['hour_length']? 3 : (int)(22 - $input['hour_start']- 3);
            $hour_start = $input['hour_start'] -1;
            $hour_end = $input['hour_start'] + $limit_hour;dd($hour_end);
        }
        else if($input['hour_start'] - 5 >= 0){
            $limit_hour = $input['hour_start'] + 4 < 22 - $input['hour_length']? 4 : (int)(22 - $input['hour_start']- 4);
            $hour_start = $input['hour_start'];
            $hour_end = $input['hour_start'] + $limit_hour;
        }

        for($i = $hour_start; $i<= $hour_end; $i++) {
            $input['hour_start'] = $i;
            $calPrice = $bookingClass->calPriceForBooking($input);
            $calPrice['hour_start'] = $i;
            $calPrice['hour_length'] = $input['hour_length'];
            $list_price[] = $calPrice;
        }
        return $list_price;
    }
}
