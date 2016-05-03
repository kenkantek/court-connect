<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlayerRequest;
use App\Models\Auth\User;
use App\Models\Deal;
use App\Models\Payments\Payment;
use App\Models\Player;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cartalyst\Stripe\Exception\CardErrorException;
class HomeController extends Controller
{

    public function getIndex()
    {
        return view('home.index');
    }

    public function paypal()
    {
        return view('home.paypal.app');
    }

    public function orderPost(Request $request)
    {
        $input = $request->all();

        try {
            $token = Stripe::tokens()->create([
                'card' => [
                    'number' => $input['card_number'],
                    'exp_month' => $input['exp_month'],
                    'cvc' => $input['cvc'],
                    'exp_year' => $input['exp_year'],
                ],
            ]);
        }catch (Exception $e){
            return $e->getMessage();
        }

        $customer = Stripe::customers()->create([
            'email'       => $input['email'],
            'source'      => $token['id'],
        ]);

        $charge = Stripe::charges()->create([
            'customer' => $customer['id'],
            'currency' => 'USD',
            'amount'   => 50.49,
        ]);

        Payment::create([
            'user_id' => 0,
            'card_number' => $input['card_number'],
            'amount' => 50.49,
            'exp_month' => $input['exp_month'],
            'exp_year' => $input['exp_year'],
            'cvc'       => $input['cvc'],
            'stripe_transaction_id' => $charge['id'],
        ]);
        return " done";

    }
}
