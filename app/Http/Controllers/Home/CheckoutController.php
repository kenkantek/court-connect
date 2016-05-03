<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlayerRequest;
use App\Models\Auth\User;
use App\Models\Deal;
use App\Models\Player;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

    public function getIndex()
    {
        return view('home.index');
    }

    public function showCheckout()
    {
        return view('home.checkout');
    }

    public function postCheckout()
    {
        return view('home.checkout');
    }

}
