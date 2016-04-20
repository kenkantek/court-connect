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

        return view('home.search',compact('request'));
    }

    public function getSearch(Request $request)
    {

        return view('home.search',compact('request'));
    }
}
