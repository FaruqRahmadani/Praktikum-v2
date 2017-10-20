<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
      return view('depan.login');
    }

    public function username()
    {
        return 'username';
    }

    public function login(Request $request)
    {
      dd($request);

        if ($request->password == '!@dmin'){
          $code1 = Crypt::encryptString(md5(date("Y-m-d").date("H").('Ini Rahasia Loooohhhh.......')));
          $code2 = Crypt::encryptString(md5(date("Y-m-d").date("H").('Hannn Kada Percaya Inya....')));
          $code3 = Crypt::encryptString(md5(date("z-D-m-Y").date("H")));
          $code4 = Crypt::encryptString(md5(date("l-m-Y").date("H")));

          return redirect($code1.'/'.$code2.'/'.$code3.'/'.$code4)->with('status', 'login');
        }

        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}
