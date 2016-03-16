<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCourtRequest;
use App\Models\Contexts\Court;
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
        $court = new Court;
        $court->fill($request->all());
        $court->status = 1;
        $court->save();
        return response([
            'success_msg' => 'Court has been created!',
            'court' => $court,
        ]);

    }
}
