<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Admin\ManageBookingController;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Contexts\Club;
use App\Models\Contract;
use App\Models\SetOpenDay;
use App\Models\State;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Exception;

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
            ->orWhere('zipcode', 'LIKE', '%' . $term . '%')
            ->take(5)->get(['id','name','image','city','state']);

        foreach ($queries as $query) {
            $results['clubs'][] = ['id' => $query->id, 'value' => $query->name,'image' =>$query->image,'address'=>$query->city.", ".$query->state];
        }

//        $queries = City::where('name', 'LIKE', '%' . $term . '%')
//            ->join('zipcodes','zipcodes.city_id','=','citys.id')
//            ->orWhere('zipcodes.zipcode', 'LIKE', '%' . $term . '%')
//            ->take(5)->get();

        $queries = City::where('name', 'LIKE', '%' . $term . '%')
            ->orWhere('zipcode', 'LIKE', '%' . $term . '%')
            ->groupBy('state_code')
            ->take(10)->get();

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
        ini_set('max_execution_time', 300);
        $keyword_clubs = $request->input('s_name');
        $keyword_day = date("Y-m-d", strtotime($request->input('date')));
        $keyword_hour_length = $request->input('mb-book-in-hour') >=1 ? $request->input('mb-book-in-hour') : 1;
        $keyword_hour = $request->input('s_time');
        $keyword_hour = date("G", strtotime($keyword_hour)) + date("i", strtotime($keyword_hour)) / 60;

        if (array_key_exists('surface_id', $request->input())) {
            $keyword_surface = $request->input('surface_id');
        } else {
            $keyword_surface = null;
        }

        $clubs = null;
        $msg_errors = null;
        if ($request->input('date') && $keyword_hour < 0 || $keyword_hour > 24) {
            $msg_errors[] = "Sorry. Playing time can not start before 5am and ends in 22h!";
        }else if (!empty($keyword_clubs)){
            $keyword_clubs = strtolower($keyword_clubs);

            //get geo from address search
            $club_db = Club::whereRaw("lower(clubs.name) like '%". $keyword_clubs. "%'")
                ->orWhereRaw("lower(clubs.state) like '%". $keyword_clubs. "%'")
                ->orWhereRaw("lower(clubs.address) like '%". $keyword_clubs. "%'")
                ->orWhereRaw("lower(clubs.zipcode) like '%". $keyword_clubs. "%'")
                ->orWhereRaw("lower(clubs.city) like '%". $keyword_clubs. "%'");

            $clubs = Club::join('courts','courts.club_id','=','clubs.id')
                ->where(function ($q) use ($keyword_surface) {
                    if ($keyword_surface != null) {
                        $q->where('courts.surface_id', '=', $keyword_surface);
                    }})
                ->with(['courts' => function ($q) use ($keyword_surface) {
                    if ($keyword_surface != null) {
                        $q->where('surface_id', '=', $keyword_surface);
                    }
                }]);
            
            if($club_db->count() > 0){
                $geo = get_lat_long($club_db->first()->address);
//                $clubs = $clubs->whereRaw("lower(clubs.name) like '%". $keyword_clubs. "%'")
//                    ->orWhereRaw("lower(clubs.state) like '%". $keyword_clubs. "%'")
//                    ->orWhereRaw("lower(clubs.address) like '%". $keyword_clubs. "%'")
//                    ->orWhereRaw("lower(clubs.zipcode) like '%". $keyword_clubs. "%'")
//                    ->orWhereRaw("lower(clubs.city) like '%". $keyword_clubs. "%'");
            }else{
                $geo = get_lat_long($keyword_clubs);
            }

            $request->merge(array('lat' => $geo['lat']));
            $request->merge(array('lon' => $geo['lng']));

            
            //contract
            if(isset($request->dayOfWeek) && is_array($request->dayOfWeek) && count($request->dayOfWeek) > 0){
                $clubs->join('contracts_club','contracts_club.club_id','=','clubs.id');
            }
            else { //open time

            }

            if(isset($request->lat) && isset($request->lon)) {
                $clubs = $clubs->selectRaw("3959 * acos( cos( radians(clubs.latitude) ) * cos( radians(" . $request->lat . ") ) 
                      * cos( radians(" . $request->lon . ") - radians(clubs.longitude)) + sin(radians(clubs.latitude))
                      * sin( radians(" . $request->lat . ") )) AS distance_in_miles, clubs.*")
                    ->orderBy('distance_in_miles');
                if($request->get('mb-book-distance') == null) {
                    $request->merge(array('mb-book-distance' => 20));
                }
                if($request->get('mb-book-distance') >= 0)
                    $clubs = $clubs->having('distance_in_miles', '<=',  $request->get('mb-book-distance'));
            }
            else{
                $clubs = $clubs->groupBy('clubs.id')
                    ->selectRaw("clubs.*");
            }

            $clubs = $clubs->groupBy('clubs.id')
                ->get();

            // Items per page
            $perPage = 5;
            $totalItems = count($clubs);
            $totalPages = ceil($totalItems / $perPage);

            $page = $request->get('page', 1);

            if ($page > $totalPages or $page < 1) {
                $page = 1;
            }

            $offset = ($page * $perPage) - $perPage;

            $clubs = $clubs->slice($offset, $perPage);

            $clubs = new \Illuminate\Pagination\LengthAwarePaginator($clubs, $totalItems, $perPage);
            $clubs->setPath('/search');
            if ($clubs->count() == 0 ) {

            }
            else {
                $input = [
                    'date' => $request->input('date'),
                    'type' => 'open',
                    'hour_start' => $keyword_hour,
                    'hour_length' => $keyword_hour_length,
                    'member' => 0,
                ];

                $request->court = isset($request->court) && $request->court == '' ? 1 : $request->court;
                $num_court = $request->court;

                //contract
                if(isset($request->dayOfWeek) && is_array($request->dayOfWeek) && count($request->dayOfWeek) > 0){
                    foreach ($clubs as $k => $club) {
                        $contracts = Contract::where(['club_id' => $club['id']])
                            ->limit(5)->orderBy('updated_at', 'desc')->get(['id', 'club_id', 'start_date','end_date','is_member','total_week']);
                        $clubs[$k]['data_date_open'] = SetOpenDay::where(['date'=>$keyword_day, 'club_id' => $club->id])->first();
                        if($contracts && count($contracts)  > 0) {

                            $arr_tmp_contract = [];
                            foreach ($contracts as $m => $contract) {
                                $tmp_count = count($club->courts);
                                $tmp_contract = null;

                                $tmp_contract['court'] = $club->courts[0];
                                $tmp_contract['contract_id'] = $contract->id;
                                $tmp_contract['daysOfWeek'] = getTotalWeekFromPeriod(strtotime($contract->start_date), strtotime($contract->end_date) , $contract->club_id);

                                $tmp_contract['start_date'] = $contract['start_date'];
                                $tmp_contract['end_date'] = $contract['end_date'];
                                //$tmp_contract['range_date'] = createRangeDate($contract['start_date'], $contract['end_date'], $input['dayOfWeek']);

                                //cal price of num_court court
                                $total_price = 0;
                                $price_main  = null;
                                $arr_count = [];
                                $arr_count[] = $club->courts[0]['id'];
                                $input['type'] = 'contract';

                                foreach ($club->courts as $p => $court) {
                                    $input['court_id'] = $court->id;
                                    $input['club_id'] = $court->club_id;
                                    $input['contract_id'] = $contract['id'];

                                    $lprice = [];
                                    foreach ($request->dayOfWeek as $dayOfWeek) {
                                        $input['dayOfWeek'] = intval($dayOfWeek);
                                        $lprice[] = $this->getListPriceOfCourt($input);
                                    }

                                    if($p==0){
                                        $price_main[]  = $lprice;
                                    }
                                    else if($p != 0){
                                        $flag_error = 0;
                                        foreach ($price_main as $p1=> $price) {
                                            $flag_error = 0;
                                            foreach ($price as $pd => $price_day) {
                                                foreach ($price_day as $pdh => $price_day_hour) {
                                                    if($price_main[$p1][$pd][$pdh]['error'] == 'true'){
                                                        $flag_error = 1;
                                                        break;
                                                    }
                                                    $price_main[$p1][$pd][$pdh]['total_price'] += $price_day_hour['total_price'];
                                                }
                                            }
                                            if($flag_error)
                                                continue;
                                        }
                                        $arr_count[] = $court->id;
                                    }
                                    if($p + 1 >= $num_court)
                                        break;
                                }

                                $tmp_contract['price_main'] = $price_main;
                                $tmp_contract['arr_count'] = $arr_count;


                                if(isset($tmp_contract['price_main'][0][0][0]['error']) && $tmp_contract['price_main'][0][0][0]['error'] == true) {
                                    if(isset($tmp_contract['price_main'][0][0][0]['messages']))
                                        try {
                                            $club->alert_error = implode(',', $tmp_contract['price_main'][0][0][0]['messages']);
                                        }catch(Exception $e){
                                            $club->alert_error = $tmp_contract['price_main'][0][0][0]['messages'];
                                        }
                                    else $club->alert_error = "The time/date you selected is unavailable. Please try again.";
                                }else
                                    $arr_tmp_contract[] = $tmp_contract;
                                unset($club->courts);
                            }

                            usort($arr_tmp_contract, function($a,$b){
                                return $a['price_main'][0][0][0]['total_price'] > $b['price_main'][0][0][0]['total_price'];
                            });
                            $clubs[$k]['contracts'] = $arr_tmp_contract;
                        }
                        else{
                            unset($clubs[$k]);
                        }
                    }
                }
                else { // open
                    foreach ($clubs as $c => $club) {
                        $club->type = 'open';
                        $club->data_date_open = SetOpenDay::where(['date'=>$keyword_day, 'club_id' => $club->id])->first();

                        if($club->courts->count() < $num_court) {
                            unset($club->courts);
                            continue;
                        }
                        foreach ($club->courts as $p => $court) {
                            $input['court_id'] = $court['id'];
                            $input['club_id'] = $club['id'];
                            $get_price = getPriceForBooking($input);

                            if($get_price['error'] == 'true'){
                                if(isset($get_price['messages']))
                                    $club->alert_error = implode(", ", $get_price['messages']);

                            }
                            $club->courts[$p]['price'] = $get_price;
                            $club->courts[$p]['prices'] = $this->getListPriceOfCourt($input);

                        }

                        for($i=0; $i< count($club->courts) - 1; $i++) {
                            for($j = count($club->courts) - 1; $j > $i; $j--) {
                                if ($club->courts[$j]['price']['error'] == false && $club->courts[$j - 1]['price']['error'] == false &&
                                    isset($club->courts[$j]['price']['total_price']) && isset($club->courts[$j - 1]['price']['total_price']) &&
                                    $club->courts[$j]['price']['total_price'] < $club->courts[$j - 1]['price']['total_price']
                                ) {

                                    $temp = clone($club->courts[$j - 1]);
                                    $club->courts[$j - 1] = clone($club->courts[$j]);
                                    $club->courts[$j] = $temp;
                                }
                            }
                        }

                        $club->court = $club->courts[0];

                        //cal price of num_court court
                        $total_price = 0;
                        $price_main  = $club->courts[0]->prices;
                        $arr_count = [];
                        $arr_count[] = $club->courts[0]->id;
                        foreach ($club->courts as $p => $court) {
                            if($p != 0){
                                foreach ($court->prices as $k=> $price) {
                                    if($price['error'] == false && isset($price_main[$k]['total_price'])) {
                                        $price_main[$k]['total_price'] += $price['total_price'];
                                        $price_main[$k]['price_teacher'] += $price['price_teacher'];
                                    }
                                }
                                $arr_count[] = $court->id;
                            }
                            if($p + 1 >= $num_court)
                                break;
                        }
                        $club->price_main = $price_main;
                        $club->arr_count = $arr_count;
                        unset($club->court->price);
                        unset($club->court->prices);
                        unset($club->courts);
                    }
                }
            }
        }

        //return $clubs;
        $deals = getDeals();
        return view('home.search.index', compact('request', 'deals', 'clubs', 'keyword_hour','msg_errors'));
    }

    //get price follow hour of court
    function getListPriceOfCourt($input){
        $list_price = [];
        $hour_start = 0;
        $hour_end = 0;

        if($input['type'] == 'contract'){
            if($input['hour_start'] >= 0){
                $limit_hour = $input['hour_start'] + $input['hour_length'] <24 ? 4: (int)(24 - $input['hour_start']- 4);
                $hour_start = $input['hour_start'];
                $hour_end = $input['hour_start'] + $limit_hour;
            }else{
                $limit_hour = $input['hour_start'] + $input['hour_length'] <24 ? 4: (int)(24 - $input['hour_start']- 4);
                $hour_start = $input['hour_start'];
                $hour_end = $input['hour_start'] + $limit_hour;
            }
        }else
        {
            $limit_hour = $input['hour_start'] + $input['hour_length'] <= 24 ? 4 : (int)(24 - $input['hour_start']- 4);
            $hour_start = $input['hour_start'];
            $hour_end = $input['hour_start'] + $limit_hour;
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

    public function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000){
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }

    public function checkPrice(){
        $input = [
            'date' => "09/15/2016",
            'type' => 'open',
            'hour_start' => 12,
            'hour_length' => 1,
            'member' => 0,
            'court_id' => '235'
        ];

//        $input = [
//            'date' => "07/07/2016",
//            'dayOfWeek' => 1,
//            'type' => 'contract',
//            'contract_id' => 13,
//            'court_id' => 218,
//            'club_id' => 1,
//            'hour_start' => 7,
//            'hour_length' => 1,
//            'member' => 0,
//        ];
        $price = getPriceForBooking($input);
        dd($price);
    }
}