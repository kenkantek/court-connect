<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserCreateEvent;
use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Player;
use Caffeinated\Flash\Facades\Flash;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Mockery\CountValidator\Exception;
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
        $this->middleware('guest', ['except' => ['logout', 'getVerify', 'getReSendEmail']]);
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

    public function getVerify(Request $request)
    {
        $verifyCode = $request->code;
        $user = User::whereVerifyCode($verifyCode)->first();
        if (!$user) {
            Flash::error('Error verify');
            return redirect()->route('home.alert');
        }
        $user->verify_code = null;
        $user->status = 1;
        $user->save();
        Flash::success('Verify successfull');
        return redirect()->route('home.alert');
    }

    public function getReSendEmail()
    {
        $user = Auth::user()->toArray();
        Mail::send('home.users.emails.user_create', ['data' => $user], function ($message) use ($user) {
            $message->from(env('MAIL_FROM'), env('MAIL_FROM_NAME'));
            $message->to($user['email'])->subject('Verify your email address');
            Flash::success('Thanks for signing up! Please check your email.');
        });

        return response()->json('Success Resend Confirmation Email !');
    }

    //Social

    public function redirectToProvider($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    public function handleProviderCallback($driver)
    {
        if (!empty($_REQUEST['error']) && ($_REQUEST['error'] == 'access_denied')) {
            return redirect()->route('front::auth.facebook');
        }
        $usersocial  = Socialite::driver($driver)->user();

        if ($checkUser = User::whereEmail($usersocial->email)->first()) {
            Auth::login($checkUser);
            return redirect()->route('home.index');
        }

        try {
            $user = new User;
            $user->facebook_id = $usersocial->id;
            $user->first_name = isset($usersocial->user['name']) ? $usersocial->user['name'] : isset($usersocial->name) ? $usersocial->name : "";
            $user->email = $usersocial->email;
            $user->avatar = $usersocial->avatar;
            $user->verify_code = str_random(30);
            $user->save();

            $player = new Player();
            $player->user_id = $user->id;
            $player->save();

            event(new UserCreateEvent($user));

            Auth::login($user);
        }catch(Exception $e){

        }
        return redirect()->route('home.index');
    }

}
