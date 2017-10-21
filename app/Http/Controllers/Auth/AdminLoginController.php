<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

class AdminLoginController extends Controller
{
  public function __construct()
  {
      $this->middleware('guest:admin')->except('logout');
  }

  public function LoginForm($code1,$code2,$code3,$code4)
  {
      try {
        $DecryptCode1 = Crypt::decryptString($code1);
        $DecryptCode2 = Crypt::decryptString($code2);
        $DecryptCode3 = Crypt::decryptString($code3);
        $DecryptCode4 = Crypt::decryptString($code4);

        $passCode1 = (Carbon::parse(Carbon::now())->format('Y ... M ,,, d === H [01012011]'));
        $passCode2 = (Carbon::parse(Carbon::tomorrow())->format('M ... M ,,[01|01|2011],, d ==Y=='));
        $passCode3 = (Carbon::parse('first day of January 2011')->addYears(Carbon::parse(Carbon::now())->format('d')+Carbon::parse(Carbon::now())->format('H')));
        $passCode4 = (Carbon::parse(Carbon::now())->format('HYyHy ... FMmF ,,, dDdDdDd === H [01=01=2011]').' Kekuatan Rahasia !!!');
      } catch (DecryptException $e) {
        return back();
      }

      if (($DecryptCode1 == $passCode1) && ($DecryptCode2 == $passCode2) && ($DecryptCode3 == $passCode3) && ($DecryptCode4 == $passCode4) && (session('status') == 'L0g1n 4dm!n')) {
        return view('admin.Login.LoginAdmin');
      } else {
        return back();
      }
  }

  public function login(Request $request){
    $this->validate($request, [
      'username' => 'required',
      'password' => 'required',
    ]);

    $credentials = [
      'username' => $request['username'],
      'password' => $request['password'],
    ];
    if (Auth::guard('admin')->attempt($credentials)) {
      // dd(Auth::guard());
      return redirect('/admin');
    }
    return redirect()->back()->withInput($request->only('username', 'remember'));
  }

  protected function guard()
  {
      return Auth::guard('admin');
  }
}
