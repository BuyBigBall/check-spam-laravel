<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\TrashMail;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\TrashMailController;

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


    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function username()
    {
        $email_regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
        //print( empty($this->username) ); die;
        if (empty($this->username)) {
            $this->username = 'username';
            if (preg_match($email_regex, request('username', null))) {
                $this->username = 'email';
            }
        }
        return $this->username;
    }

    public function login(Request $request)
    {
        
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];

        $this->validate($request, $rules);
        
        if ($this->attemptLogin($request)) {
            return $this->redirectTo($request);
        } else {
            //session()->put('msg', translate('Unauthorised'));
            return redirect(route('login'))->with('msg', translate('Unauthorised'));
        }
    }

    protected function attemptLogin(Request $request)
    {
        $credentials = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
            'mode'      => 'active',
        ];
        $remember = false;
        if (!empty($request->input('remember')) && $request->input('remember') == true) {
            $remember = true;
        }

        //print_r($credentials); die;
        return $this->guard()->attempt($credentials, $remember);
    }


    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    public function redirectTo(Request $request) {
        //after logincheck will be redirected.
        $role = Auth::user()->role; 
        switch ($role) {
        case 'admin':
            return redirect('/admin/dashboard');
            break;
        case 'user':
            $user_id = Auth::user()->id;
            $email = TrashMail::GetUserEmail($user_id);
            if(!empty($email))
                Cookie::queue('email', $email, Settings::selectSettings("email_lifetime") * Settings::selectSettings("email_lifetime_type"));
            else if(Cookie::has('email'))
                $email = Cookie::get('email');
            else
                {
                    $email = TrashMailController::generateRandomEmail();
                    Cookie::queue('email', $email, Settings::selectSettings("email_lifetime") * Settings::selectSettings("email_lifetime_type"));
                }
            return redirect( route('get-started') );
            break; 
    
        default:
            
            return redirect('/'); 
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
