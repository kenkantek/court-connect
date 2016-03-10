<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contexts\Court;
use App\Repositories\Interfaces\Admin\ClubInterface;

class ClubController extends Controller
{
    public function __construct(ClubInterface $clubRepository)
    {
        $this->clubRepository = $clubRepository;
    }

    public function getSetting($id)
    {
        \Assets::addJavascript(['select2', 'uniform', 'monthly', 'moment', 'timepicker', 'datetimepicker', 'daterangepicker', 'bootstrap-multiselect']);
        \Assets::addStylesheets(['select2', 'uniform', 'monthly', 'timepicker', 'datetimepicker', 'daterangepicker', 'bootstrap-multiselect']);
        \Assets::addAppModule(['app']);
        $club = $this->clubRepository->findById($id);
        return view('admin.clubs.setting', compact('club'));
    }
    public function getCourts($id)
    {
        $clubs = Court::where('club_id', $id)->with('surface')->get();
        return $clubs;
    }
    public function getManagerBookings()
    {
        \Assets::addJavascript(['select2', 'uniform', 'monthly', 'moment', 'ionslider', 'timepicker', 'datetimepicker', 'daterangepicker', 'bootstrap-multiselect']);
        \Assets::addStylesheets(['select2', 'uniform', 'monthly', 'ionslider', 'timepicker', 'datetimepicker', 'daterangepicker', 'bootstrap-multiselect']);
        return view('admin.clubs.manager_bookings');
    }

}
