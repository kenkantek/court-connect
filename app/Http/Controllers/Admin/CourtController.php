<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCourtRequest;
use App\Http\Requests\UpdateCourtRequest;
use App\Models\Contexts\Court;
use App\Models\CourtRate;
use App\Repositories\Interfaces\Admin\CourtInterface;
use Illuminate\Http\Request;

class CourtController extends Controller
{
    public function __construct(CourtInterface $courtRepository)
    {
        $this->courtRepository = $courtRepository;
    }
    public function getList($clubId)
    {
        # code...
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
    protected function updateTableRates($court, $dataRates)
    {
        foreach ($dataRates as $key => $inputRate) {
            $rate = new CourtRate;
            $rate->rates = json_encode($inputRate['rates']);
            $rate->end_date = $inputRate['end_date'];
            $rate->start_date = $inputRate['start_date'];
            $rate->name = $inputRate['name'];
            $rate->is_member = $inputRate['is_member'];
            $rate->court()->associate($court);
            $rate->save();
        }
    }
    public function postUpdateCourts(Request $request)
    {
        $courts = $request->input('courts');
        $dataRates = $request->input('dataRates');

        foreach ($courts as $k => $court) {
            CourtRate::where('court_id', $court['id'])->delete();
            foreach ($dataRates as $key => $dataRate) {
                $rate = new CourtRate;
                $rate->rates = json_encode($dataRate['rates']);
                $rate->end_date = $dataRate['end_date'];
                $rate->start_date = $dataRate['start_date'];
                $rate->name = $dataRate['name'];
                $rate->is_member = $dataRate['is_member'];
                $rate->court_id = $court['id'];
                $rate->save();
            }
        }
        return response([
            'success_msg' => 'Courts has been updated!',
        ]);
    }
}
