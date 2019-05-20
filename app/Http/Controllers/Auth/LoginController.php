<?php

namespace App\Http\Controllers\Auth;

use App\AisLogin;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;

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

    use AuthenticatesUsers {
        login as protected traitlogin;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

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
     * Handle a login request to the application.
     * If user is not present yet and it is an AIS login,
     * overwrite function login() from -> vendor/laravel/framework/src/Illuminate/Foundation/Auth
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        // Make register by AIS data if user is not present in DB yet

        $user = $request->input('email');
        $pass = $request->input('password');

        if ($user != 'admin@admin.com')
        {
            $AisLogin = new AisLogin();

            $ais = $AisLogin->login($user, $pass);

            if ($ais['success'])
            {
                if (User::where('email', '=', $user)->exists())
                {
                    User::where('email', '=', $user)->update(['password' => $ais['data']['password']]);
                }
                else
                {
                    User::create($ais['data']);
                }
            }
            else
            {
                throw ValidationException::withMessages([
                    'email' => ['AIS error: '.$ais['msg']],
                ]);
            }
        }

        return $this->traitlogin($request);
    }
}
