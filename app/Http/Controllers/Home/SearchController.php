<?php

namespace App\Http\Controllers\Home;

use App\Models\Club;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function autocomplete(Request $request){
        $term = $request->input('term');

        $results = array();

        $queries = Club::where('name', 'LIKE', '%'.$term.'%')
            ->orWhere('zipcode', 'LIKE', '%'.$term.'%')
            ->orWhere('city', 'LIKE', '%'.$term.'%')
            ->orWhere('state', 'LIKE', '%'.$term.'%')
            ->orWhere('address', 'LIKE', '%'.$term.'%')
            ->take(5)->get();

        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => $query->name ];
        }
        return response()->json($results);
    }
}
