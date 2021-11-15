<?php

namespace App\Http\Controllers\Mailstester;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Settings;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    //use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        //$this->middleware(['guest','notification']);
    }

    public function showRegistrationForm()
    {
        $guard = null;
        $userdata = [];
        
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata['user_login'] = Auth::user();
            return redirect( route('account') );
        }

        if (    Str::length(Settings::selectSettings("RECAPTCHA_SECRET_KEY")) > 0 &&
                Str::length(Settings::selectSettings("RECAPTCHA_SITE_KEY")) > 0 
            ) {
            $RECAPTCHA_SITE_KEY = Settings::selectSettings("RECAPTCHA_SITE_KEY");
            $RECAPTCHA_SECRET_KEY = Settings::selectSettings("RECAPTCHA_SECRET_KEY");
        } else {
            $RECAPTCHA_SITE_KEY = '';
            $RECAPTCHA_SECRET_KEY = '';
        }

        return view('mailstester.register')
                ->with('RECAPTCHA_SITE_KEY', $RECAPTCHA_SITE_KEY)
                ->with('RECAPTCHA_SECRET_KEY', $RECAPTCHA_SECRET_KEY)
                ->with('userdata', $userdata);
        
    }

    /**
     * Handle a registration request for the application.
     *
     * @param Request $request
     * @return Response
     */
    public function save_register(Request $request)
    {

        print('could not validate'); die;
        $this->validator($request->all())->validate();

        
        $user = $this->create($request->all());

        // $this->guard()->login($user);

        ## Send Suitable Email For New User ##
        $user_register_mode = 'inactive';
        if($user_register_mode == 'inactive'){
            sendMail([
                'template' => get_option('user_register_active_email'),
                'recipent' => [$user->email]
                ]);
            return redirect()->back()->with('msg',trans('main.thanks_reg'));
        }
        else {
            sendMail([
                'template'=>get_option('user_register_wellcome_email'),
                'recipent'=>[$user->email]
            ]);
            return redirect()->back()->with('msg',trans('main.active_account_alert'));
        }
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $flag =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
            'mode' => 'inactive',
            'remember_token' => Str::random(25)
            // 'created_at' => time(),
            //'category_id' => get_option('user_default_category', 0),
            //'username' => $data['username'],
        ]);

        return $flag;
    }
}