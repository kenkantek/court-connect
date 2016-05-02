<?php

namespace App\Http\Controllers\Home;

use App\Models\City;
use App\Models\Contexts\Club;
use App\Models\Contexts\Court;
use App\Models\CourtRate;
use App\Models\State;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
            $results['clubs'][] = ['id' => $query->id, 'value' => $query->name];
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

        $keyword_time = $request->input('s_time');
        $keyword_surface = $request->input('surface_id');
        $keyword_longtime = $request->input('mb-book-in-hour');


        $clubs = CLub::search($keyword_clubs)->join('set_open_days','clubs.id', '=', 'set_open_days.club_id')
                ->where(function ($query) use ($keyword_day) {
                    $query->where('set_open_days.date', '=', $keyword_day)
                          ->where('is_close','=','0');

                })

                ->get(['clubs.*']);


        $results =  Court::where('surface_id','=',$keyword_surface)->get();
        return $clubs;
        return view('home.search',compact('request'));
    }
}
