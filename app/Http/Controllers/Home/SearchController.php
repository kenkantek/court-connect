<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Admin\ManageBookingController;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Contexts\Club;
use App\Models\Contract;
use App\Models\State;
use Illuminate\Http\Request;

class SearchController extends Controller {

    public function autocomplete(Request $request) {
        $term = $request->input('term');

        $results['clubs'] = array();
        $results['citys'] = array();
        $results['states'] = array();

        $queries = Club::where('name', 'LIKE', '%' . $term . '%')
            ->orWhere('zipcode', 'LIKE', '%' . $term . '%')
            ->orWhere('city', 'LIKE', '%' . $term . '%')
            ->orWhere('state', 'LIKE', '%' . $term . '%')
            ->orWhere('address', 'LIKE', '%' . $term . '%')
            ->take(5)->get(['id','name','image','address']);

        foreach ($queries as $query) {
            $results['clubs'][] = ['id' => $query->id, 'value' => $query->name,'image' =>$query->image,'address'=>$query->address];
        }

        $queries = City::where('name', 'LIKE', '%' . $term . '%')
            ->orWhere('zip', 'LIKE', '%' . $term . '%')
            ->take(5)->get();

        foreach ($queries as $query) {
            $results['citys'][] = ['id' => $query->id, 'value' => $query->name, 'state' => $query->state_code];
        }

        $queries = State::where('name', 'LIKE', '%' . $term . '%')
            ->orWhere('state_code', 'LIKE', '%' . $term . '%')
            ->take(5)->get();

        foreach ($queries as $query) {
            $results['states'][] = ['id' => $query->id, 'value' => $query->name];
        }
        return response()->json($results);
    }

    public function search(Request $request) {
        ini_set('max_execution_time', 10000);
        $keyword_clubs = $request->input('s_name');
        $keyword_day = $request->input('date');
        $keyword_day = date("Y-m-d", strtotime($keyword_day));
        $keyword_hour_length = $request->input('mb-book-in-hour');
        $keyword_hour = $request->input('s_time');
        $keyword_hour = date("G", strtotime($keyword_hour)) + date("i", strtotime($keyword_hour)) / 60;

        if (array_key_exists('surface_id', $request->input())) {
            $keyword_surface = $request->input('surface_id');
        } else {
            $keyword_surface = null;
        }

        $clubs = null;
        if ($keyword_hour < 5) {

        }else {
            $clubs = Club::search($keyword_clubs)->with(['courts' => function ($q) use ($keyword_surface) {
                if ($keyword_surface != null) {
                    $q->where('surface_id', '=', $keyword_surface);
                }
            }])->paginate(5);
            if ($clubs->count() == 0 || $clubs[0]->courts->count() == 0) {

            } else {
                $input = [
                    'date' => $request->input('date'),
                    'type' => 'open',
                    'hour_start' => $keyword_hour,
                    'hour_length' => $keyword_hour_length,
                    'member' => 0,
                ];

                //contract
                if(isset($request->dayOfWeek) && is_array($request->dayOfWeek) && count($request->dayOfWeek) > 0){
                    foreach ($clubs as $k => $club) {
                        $contracts = Contract::where(['club_id' => $club['id'], 'is_member' => 0])
                            ->limit(5)->orderBy('updated_at', 'desc')->get(['id','start_date','end_date','is_member','total_week']);
                        if($contracts && count($contracts)  > 0) {
                            foreach ($contracts as $m => $contract) {
                                foreach ($club->courts as $p => $court) {
                                    $input['court_id'] = $court['id'];
                                    $input['club_id'] = $club['id'];
                                    $input['type'] = 'contract';
                                    $input['contract_id'] = $contract['id'];
                                    $clubs[$k]['courts'][$p]['type'] = 'contract';
                                    $clubs[$k]['courts'][$p]['start_date'] = $contract['start_date'];
                                    $clubs[$k]['courts'][$p]['end_date'] = $contract['end_date'];
                                    $lprice = [];
                                    foreach($request->dayOfWeek as $dayOfWeek) {
                                        $input['dayOfWeek'] = intval($dayOfWeek);
                                        $lprice[] = $this->getListPriceOfCourt($input);
                                    }
                                    $clubs[$k]['courts'][$p]['prices'] = $lprice;
                                }
                            }
                            $clubs[$k]['range_date'] = createRangeDate($contract['start_date'], $contract['end_date'], $input['dayOfWeek']);
                        }else{
                            unset($clubs[$k]);
                        }
                    }
                }else { // open
                    foreach ($clubs as $k => $club) {
                        $clubs[$k]['type'] = 'open';
                        foreach ($club->courts as $p => $court) {
                            $input['court_id'] = $court['id'];
                            $input['club_id'] = $club['id'];
                            $clubs[$k]['courts'][$p]['prices'] = $this->getListPriceOfCourt($input);
                        }
                    }
                }
            }

        }
        //return $clubs;
        $deals = getDeals();
        return view('home.search.index', compact('request', 'deals', 'clubs', 'keyword_hour'));
    }

    //get price follow hour of court
    function getListPriceOfCourt($input){
        $list_price = [];
        $hour_start = 0;
        $hour_end = 0;

        if($input['type'] == 'contract'){
            if($input['hour_start'] - 5 >= 1){
                $limit_hour = $input['hour_start'] + $input['hour_length'] <23 ? 1: 0;
                $hour_start = $input['hour_start'];
                $hour_end = $input['hour_start'] + $limit_hour;
            }else{
                $limit_hour = $input['hour_start'] + $input['hour_length'] <23 ? 1: 0;
                $hour_start = $input['hour_start'];
                $hour_end = $input['hour_start'] + $limit_hour;
            }
        }else{
            if($input['hour_start'] - 5 >= 2){
                $limit_hour = $input['hour_start'] + 2 < 22 - $input['hour_length']? 2 : (int)(22 - $input['hour_start'] - 2);
                $hour_start = $input['hour_start'] -2;
                $hour_end = $input['hour_start'] + $limit_hour;
            }else if($input['hour_start'] - 5 >= 1){
                $limit_hour = $input['hour_start'] + 3 < 22 - $input['hour_length']? 3 : (int)(22 - $input['hour_start']- 3);
                $hour_start = $input['hour_start'] -1;
                $hour_end = $input['hour_start'] + $limit_hour;
            }
            else if($input['hour_start'] - 5 >= 0){
                $limit_hour = $input['hour_start'] + 4 < 22 - $input['hour_length']? 4 : (int)(22 - $input['hour_start']- 4);
                $hour_start = $input['hour_start'];
                $hour_end = $input['hour_start'] + $limit_hour;
            }
        }

        for($i = $hour_start; $i<= $hour_end; $i++) {
            $input['hour_start'] = $i;
            $calPrice = getPriceForBooking($input);
            $calPrice['hour_start'] = $i;
            $calPrice['hour_length'] = $input['hour_length'];
            $list_price[] = $calPrice;
        }
        return $list_price;
    }

    public function checkPrice(){
        $input = [
            'date' => "05/09/2016",
            'type' => 'open',
            'hour_start' => 7,
            'hour_length' => 1,
            'member' => 0,
            'court_id' => '179'
        ];
        $price = $this->getPriceOfCourt($input);
        dd($price);
    }
}