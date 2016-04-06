<?php

namespace App\Http\Controllers\Home;

use App\Models\City;
use App\Models\Club;
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
        $results = array();
        $date = date_format(date_create($request->input('date')),"y-m-d");
        $s_name = $request->input('s_name');
        $queries = CourtRate::with(['Court','Court.Club','Court.Club.State','Court.Club.City'])
            ->where('start_date', ">=" , $request->input('date'))
            ->where('end_date', ">=" , $request->input('date'))
            ->whereHas('Court', function($q) use($s_name){
                $q->whereHas('Club', function($q) use($s_name) {
                        $q->where(function($q) use($s_name){
                            $q->orWhereHas('State', function ($q) use ($s_name) {
                                $q->where('name', 'like', '%' . $s_name . '%');
                            })->orWhereHas('City', function ($q) use ($s_name) {
                                    $q->where('name', 'like', '%' . $s_name . '%');
                                });
                        })
                        ->orWhere('name','like','%'.$s_name.'%');
                    })
                    ->groupBy('court_id')
                    ->orWhere('name','like','%'.$s_name.'%');
            })
            ->get();

        echo "<pre>";
        echo $date.$s_name;
        foreach($queries as $row) {
            echo $row['Court']['name'] ."  ". $row['Court']['Club']['name']."<br>";
        }
        echo "</pre>";
        return view('home.search',compact('request'));
    }

    public function getSearch(Request $request)
    {

        return view('home.search',compact('request'));
    }
}
