<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCourtRequest;
use App\Models\Contexts\Court;
use App\Models\CourtRate;
use App\Repositories\Interfaces\Admin\CourtInterface;

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
        //dd($request->input());
        $court = new Court;
        $court->fill($request->all());
        $court->status = 1;
        $court->save();
        $inputRates = $request->input('dataRates');
        foreach ($inputRates as $key => $inputRate) {
            $rate = new CourtRate;
            $rate->rates = json_encode($inputRate['rates']);
            $rate->end_date = $inputRate['endDate'];
            $rate->start_date = $inputRate['startDate'];
            $rate->name = $inputRate['name'];
            $rate->is_member = $inputRate['isMember'];
            $rate->court()->associate($court);
            $rate->save();
        }

        return response([
            'success_msg' => 'Court has been created!',
            'court' => $court,
        ]);

    }
}
