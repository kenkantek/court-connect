<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Admin\ManageBookingController;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Contexts\Club;
use App\Models\State;
use Illuminate\Http\Request;

class SearchController extends Controller {
	public function autocomplete(Request $request) {
		$term = $request->input('term');

		$results['clubs'] = array();
		$results['citys'] = array();
		$results['state'] = array();

		$queries = Club::where('name', 'LIKE', '%' . $term . '%')
			->orWhere('zipcode', 'LIKE', '%' . $term . '%')
			->orWhere('city', 'LIKE', '%' . $term . '%')
			->orWhere('state', 'LIKE', '%' . $term . '%')
			->orWhere('address', 'LIKE', '%' . $term . '%')
			->take(5)->get();

		foreach ($queries as $query) {
			$results['clubs'][] = ['id' => $query->id, 'value' => $query->name];
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

	public function postSearch(Request $request) {

		$keyword = $request->input('s_name');
		$clubs = Club::search($keyword)->paginate(5);
		return view('home.search', compact('request', 'clubs'));
	}

	public function getSearch(Request $request) {
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
		$keyword_longtime = $request->input('mb-book-in-hour');

		$clubs = null;
		if ($keyword_hour < 5) {

		} else {
			$clubs = Club::search($keyword_clubs)->with(['courts' => function ($q) use ($keyword_surface) {
				if ($keyword_surface != null) {
					$q->where('surface_id', '=', $keyword_surface);
				}
			}])->paginate(5);
			if ($clubs->count() == 0 || $clubs[0]->courts->count() == 0) {
				$clubs = null;
			} else {
				$input = [
					'date' => $request->input('date'),
					'type' => 'open',
					'hour_start' => $keyword_hour,
					'hour_length' => $keyword_hour_length,
					'member' => 0,
				];
				//dd(date("H", $keyword_hour));
				foreach ($clubs as $k => $club) {
					foreach ($club->courts as $p => $court) {
						$input['court_id'] = $court['id'];
						$input['club_id'] = $club['id'];
						$clubs[$k]['courts'][$p]['prices'] = $this->getPriceOfCourt($input);
					}

				}
			}

	}
		return view('home.search', compact('request', 'clubs', 'keyword_hour'));
	}

	//get price follow hour of court
	function getPriceOfCourt($input) {
		$bookingClass = new ManageBookingController();
		$list_price = [];
		$hour_start = 0;
		$hour_end = 0;
		if ($input['hour_start'] - 5 >= 2) {
			$limit_hour = $input['hour_start'] + 2 < 22 - $input['hour_length'] ? 2 : (int) (22 - $input['hour_start'] - 2);
			$hour_start = $input['hour_start'] - 2;
			$hour_end = $input['hour_start'] + $limit_hour;
		} else if ($input['hour_start'] - 5 >= 1) {
			$limit_hour = $input['hour_start'] + 3 < 22 - $input['hour_length'] ? 3 : (int) (22 - $input['hour_start'] - 3);
			$hour_start = $input['hour_start'] - 1;
			$hour_end = $input['hour_start'] + $limit_hour;
			dd($hour_end);
		} else if ($input['hour_start'] - 5 >= 0) {
			$limit_hour = $input['hour_start'] + 4 < 22 - $input['hour_length'] ? 4 : (int) (22 - $input['hour_start'] - 4);
			$hour_start = $input['hour_start'];
			$hour_end = $input['hour_start'] + $limit_hour;
		}

		for ($i = $hour_start; $i <= $hour_end; $i++) {
			$input['hour_start'] = $i;
			$calPrice = $bookingClass->calPriceForBooking($input);
			$calPrice['hour_start'] = $i;
			$calPrice['hour_length'] = $input['hour_length'];
			$list_price[] = $calPrice;
		}
		return $list_price;

	}
	public function getCosttoTimeAndDay($time, $date, $rate) {
		# code...
	}
}
