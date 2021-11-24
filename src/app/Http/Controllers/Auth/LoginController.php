<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


     /**
     * OAuth認証先にリダイレクト
     *
     * @param str $provider
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        // dd(Socialite::driver($provider)->redirect());
        return Socialite::driver($provider)->redirect();
    }


    /**
    * OAuth認証の結果受け取り
    *
    * @param str $provider
    * @return \Illuminate\Http\Response
    */
    public function handleProviderCallback($provider)
    {
        $provided_user = Socialite::driver($provider)->user();

        $user = User::where('provider', $provider)
            ->where('provided_user_id', $provided_user->id)
            ->first();

        if ($user === null) {
            // redirect confirm
            $user = User::create([
               'name'               => $provided_user->name,
               'provider'           => $provider,
               'provided_user_id'   => $provided_user->id,
            ]);
        }

        Auth::login($user);

        return redirect($this->redirectTo);
    }
}
