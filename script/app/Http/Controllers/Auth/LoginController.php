<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\TrashMail;
use App\Models\Settings;
use Illuminate\Support\Facades\Cookie;

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

    public function redirectTo() {
        //after logincheck will be redirected.
        $role = Auth::user()->role; 
        switch ($role) {
        case 'admin':
            return '/admin/dashboard';
            break;
        case 'user':
            $user_id = Auth::user()->id;
            $email = TrashMail::GetUserEmail($user_id);
            if(!empty($email))
                Cookie::queue('email', $email, Settings::selectSettings("email_lifetime") * Settings::selectSettings("email_lifetime_type"));
            else if(Cookie::has('email'))
                $email = Cookie::get('email');
            else
                abort(419);
            return '/get-started';
            break; 
    
        default:
            
            return '/'; 
        break;
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
}
