<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Auth;

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



    // CHECK IF USER IS NOT BLOCK
    public function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $credentials = Arr::add($credentials, 'block', '0');
        return $credentials;
    }

    // UPDATE USER LOGIN
    public function authenticated()
    {
        if(Auth::check()) {
            Auth::user()->update(['login_at' => now()]);
        }
    }

    // REDIRECT IF USER IS ADMIN
    public function redirectTo(){
        
        $admin = Auth::user()->admin; 
        
        switch ($admin) {
            case '1':
                    return '/admin';
                break;
            case '0':
                    return '/home';
                break; 
            default:
                    return '/login'; 
                break;
        }
    }
}
