<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ClubController extends Controller
{


    /**
     * Display all users
     *
     * @return Response
     */
    public function getSetting()
    {
        \Assets::addJavascript(['select2', 'uniform','moment','datetimepicker','daterangepicker','bootstrap-multiselect']);
        \Assets::addStylesheets(['select2', 'uniform','datetimepicker', 'daterangepicker','bootstrap-multiselect']);
        return view('admin.clubs.setting');
    }
}
