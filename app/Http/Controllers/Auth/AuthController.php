<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Laravel\Socialite\Facades\Socialite;
use Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
     */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function handleProviderCallback()
    {
        if (!empty($_REQUEST['error']) && ($_REQUEST['error'] == 'access_denied')) {
            return redirect()->route('front::auth.facebook');
        }
        $userfb = Socialite::driver('facebook')->user();

        if (($checkUser = User::where('facebook_id', '=', $userfb->id)->first()) || (($checkUser = User::where('email', '=', $userfb->email)->first()))) {
            Auth::login($checkUser);
            return redirect()->route('home.index');
        }
        // $userfb           = $userfb->user;
        if ($userfb->email == null) {
            return redirect('register')->with(['userFb' => $userfb->user]);
        }

        $user              = new User;
        $user->facebook_id = $userfb->id;
        $user->first_name  = $userfb->user['first_name'];
        $user->last_name   = $userfb->user['last_name'];
        $user->email       = $userfb->user['email'];
        $user->avatar      = $userfb->avatar;
        //$user->active      = 1;
        $user->save();

        Auth::login($user);
        return redirect()->route('home.index');
    }

    public function redirectToProvider()
    {
        return Socialite::with('facebook')->redirect();
    }

    public function ajaxlogin(Request $request)
    {
        $reponses['error'] = 1;
        $reponses['redirect'] = route('home.index');
        if (Auth::attempt($request->only('email', 'password')))
        {
            $reponses['error'] = 0;
            if($request->user()->hasRole('admin'))
                $reponses['redirect'] = route('super.index');
            if($request->user()->hasRole('user'))
                $reponses['redirect'] = route('admin.index');
            if($request->user()->hasRole('player'))
                $reponses['redirect'] = route('home.index');
        }

        return response()->json($reponses);
    }

}
