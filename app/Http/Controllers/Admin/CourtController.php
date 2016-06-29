<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCourtRequest;
use App\Http\Requests\UpdateCourtRequest;
use App\Models\Contexts\Court;
use App\Models\CourtRate;
use App\Models\CourtRateDetail;
use App\Models\DateClub;
use App\Repositories\Interfaces\Admin\CourtInterface;
use DateTime;
use Illuminate\Http\Request;

class CourtController extends Controller
{
    public function __construct(CourtInterface $courtRepository)
    {
        $this->courtRepository = $courtRepository;
    }
    public function getList($club_id)
    {
        $courts = Court::where('club_id', $club_id)->orderBy('name')->get();
        return response([
            'data' => $courts,
        ]);
    }
    public function postCreateCourt(CreateCourtRequest $request)
    {
        $court = new Court;
        $court->fill($request->all());
        $court->status = 1;
        $court->save();
        $inputRates = $request->input('dataRates');

        $this->updateTableRates($court, $inputRates);
        return response([
            'success_msg' => 'Court has been created!',
            'court' => $court,
        ]);

    }
    public function postUpdateCourt(UpdateCourtRequest $request)
    {

        $court = Court::find($request->input('id'));
        $court->fill($request->all());
        $court->save();
        $rate = CourtRate::where('court_id', $request->input('id'))->delete();
        $inputRates = $request->input('dataRates');

        $this->updateTableRates($court, $inputRates);

        return response([
            'success_msg' => 'Court has been updated!',
            'court' => $court,
        ]);
    }
    public function postUpdateCourts(Request $request)
    {
        $courts = $request->input('courts');
        $inputRates = $request->input('dataRates');
        $cal_fl_price_of_member = $request->input('cal_fl_price_of_member');
        foreach ($courts as $k => $court) {
            CourtRate::where('court_id', $court['id'])->delete();
            $this->updateTableRates($court, $inputRates, $cal_fl_price_of_member);
        }
        return response([
            'success_msg' => 'Courts has been updated!',
        ]);
    }

    //update rate
    protected function updateTableRates($court, $dataRates, $cal_fl_price_of_member = false)
    {
        ini_set('max_execution_time', 3000);

        //set rate
        foreach ($dataRates as $key => $inputRate) {
            $rate = new CourtRate;
            if($cal_fl_price_of_member >= 0) {
                if ($cal_fl_price_of_member) {
                    $rate->rates_member = json_encode($inputRate['datarate']['rates_member']);
                    $rate->rates_nonmember = json_encode($inputRate['datarate']['rates_member']);
                } else {
                    $rate->rates_member = json_encode($inputRate['datarate']['rates_nonmember']);
                    $rate->rates_nonmember = json_encode($inputRate['datarate']['rates_nonmember']);
                }
            }else{
                $rate->rates_member = json_encode($inputRate['datarate']['rates_member']);
                $rate->rates_nonmember = json_encode($inputRate['datarate']['rates_nonmember']);
            }
            $rate->end_date = $inputRate['datarate']['end_date'];
            $rate->start_date = $inputRate['datarate']['start_date'];
            $rate->name = $inputRate['datarate']['name'];
            $rate->court_id = $court['id'];
            $rate->save();
            //$this->setDateRateOfCourt($rate['id'],$court, $inputRate);
        }

    }
    // create date from range date
    function setDateRateOfCourt($court_rate_id,$court, $dataRate)
    {
        $range_date = [];
        $begin = new DateTime($dataRate['start_date']);
        $end = new DateTime($dataRate['end_date']);
        $club_id = $court['club_id'];
        $court_id = $court['id'];

        for($i = $begin; $begin <= $end; $i->modify('+1 day')){
            $range_date[] = $i->format("Y-m-d");
        }
        foreach($range_date as $date_s){

            //check CLUB COURT
//            $club_rate = ClubCourt::with('DateClub','DateClub.Date')->where('court_id',$club_id)
//                ->whereHas('Date',function($q) use($date){
//                    $q->where('date',$date);
//                })->get();
//            print_r($club_rate);

            //create DATE CLUB
            $tmp_date_club = DateClub::where('club_id', $club_id)
                ->where('date', $date_s)->first();
            $date_club_id =null;
            if(!isset($tmp_date_club)){
                $date_club = new DateClub();
                $date_club['date'] = $date_s;
                $date_club['club_id'] = $club_id;
                $date_club['is_close'] = 0;
                $date_club['is_holiday'] = 0;
                $date_club['open_time'] = "";
                $date_club['close_time'] = "";
                $date_club->save();
                $date_club_id = $date_club['id'];
            }else{
                $date_club_id = $tmp_date_club['id'];
            }

            //create or update  A CLUB COURT
            $tmp_club_court = CourtRateDetail::where('court_id', $court_id)
                ->where('date_club_id', $date_club_id)->first();

            if(!isset($tmp_club_court)){ // create
                $club_court = new CourtRateDetail();
                $club_court['date_club_id'] = $date_club_id;
                $club_court['court_id'] = $court_id;
                $club_court['court_rate_id'] = $court_rate_id;
                $club_court['is_member'] = $dataRate['is_member'];
                $list_hour = [];
                $list_hour['hours'] = ['5am','6am','7am','8am','9am','10am','11am','12am',
                    '1pm','2pm','3pm','4pm','5pm','6pm','7pm','8pm','9pm','10pm'];
                if($dataRate['is_member']) {
                    $list_hour['prices'] = json_encode($dataRate['rates']);
                    $list_hour['prices_nonmember'] = json_encode([]);
                }
                else {
                    $list_hour['prices_nonmember'] = json_encode($dataRate['rates']);
                    $list_hour['prices'] = json_encode([]);
                }
                $list_hour['is_book'] = [];
                for($i = 0; $i < 18; $i++) {
                    $list_hour['is_book'][$i] = ['A1' => 0, 'A2' => 0, 'A3' => 0, 'A4' => 0, 'A5' => 0, 'A6' => 0, 'A7' => 0];
                }
                $list_hour['is_contracttime']= $list_hour['is_book'];
                $club_court['list_hour']= json_encode($list_hour);
                $club_court->save();

            }else{ //update
                $list_hour = json_decode($tmp_club_court['list_hour']);
                if($dataRate['is_member'])
                    $list_hour->prices = json_encode($dataRate['rates']);
                else $list_hour->prices_nonmember = json_encode($dataRate['rates']);
                $tmp_club_court['list_hour'] = json_encode($list_hour);
                $tmp_club_court->update();
            }
        }
    }

    public function deleteCourt(Request $request)
    {
        $court = Court::find($request->input('id'))->delete();
        return response([
            'success_msg' => 'Court ' . $court['name'] . ' has been deleted',
        ]);
    }
}
