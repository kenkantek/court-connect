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
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function getIndex()
    {
        //return date("Y-m-d");
//        $deals = DB::select(
//            DB::raw("SELECT deals.*,courts.name as court_name,clubs.name as club_name, clubs.address, clubs.image,clubs.state,clubs.city,clubs.zipcode FROM deals join courts on deals.court_id = courts.id join clubs on clubs.id = courts.club_id where deals.created_at IN (SELECT MAX(created_at) FROM deals GROUP BY date, court_id, hour, hour_length) limit 10")
//        );
        $deals = getDeals();
        return view('home.pages.index',compact('deals'));
    }

    //get deals
    public function getDeals(){
        $deals = Deal::where('deals.date', '>=', date("Y-m-d"))
            ->whereIn('deals.created_at',function($query){
                $query->select(DB::raw("MAX(created_at)"))
                    ->from('deals')
                    ->groupBy("date", "court_id", "hour", "hour_length");
            })
            ->join('courts','courts.id','=','deals.court_id')
            ->join('clubs','clubs.id','=','courts.club_id')
            ->orderBy('date','asc')
            ->select(['deals.*','courts.name as court_name','clubs.name as club_name', 'clubs.address', 'clubs.image'])
            ->paginate(6);
        return view('home.pages.deals',compact('deals'));
    }
    public function getError(){

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
        }catch (CardErrorException $e){
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
