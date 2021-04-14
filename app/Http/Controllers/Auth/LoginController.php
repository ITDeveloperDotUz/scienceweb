<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
//        $this->middleware('guest:user')->except('logout');
//        $this->middleware('guest:publisher')->except('logout');
    }

    // Login
    public function showLoginForm(){
        $pageConfigs = ['bodyCustomClass' => 'login-bg', 'isCustomizer' => false];

        return view('auth.login', [
            'pageConfigs' => $pageConfigs
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->get('remember') == 'on';

        if (Auth::guard($request->input('role'))->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect(route('profile.home'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
      /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

//        $request->session()->regenerateToken();
        return redirect(route('home'));
    }
}
