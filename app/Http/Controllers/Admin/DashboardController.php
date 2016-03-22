<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        return view('admin.index');
    }
    public function getAddContext(Request $request)
    {
        session()->put('context_id', $request->input('club_id'));
        return $request->input('club_id');
    }
    public function getClubs()
    {
        $user = auth()->user();
        $clubs = $user->clubs()->get();
        return $clubs;
    }
}
