<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    // protected $redirectTo = '/home';
    protected function authenticated($request, $user)
    {
        if($user->user_role == 0){
            return redirect('/admin');
        }else if($user->user_role == 1){
            return redirect('/recept');
        }else if($user->user_role == 2){
            return redirect('/doctor');
        }else if($user->user_role == 3){
            return redirect('/nurse');
        }else if($user->user_role == 4){
            return redirect('/lab');
        }else if($user->user_role == 5){
            return redirect('/pharmacy');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Custom logout function
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('/login');
    }
}
