<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Surface;

class SurfaceController extends Controller
{

    public function getList()
    {
        return Surface::all();
    }
}
