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
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Cookie;
use App\Models\TrashMail;

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
	public function active(Request $request)
	{
		$token = $request->input('token');
		$user = User::where('remember_token', $token)->first();
		if($user!=null)
		{
			User::find($user->id)->update([
						'remember_token' => '',
                        'email_verified_at'=>date('Y-n-d H:i:s'),
						'mode' => 'active',
					]);
            $this->guard()->login($user);
            $success_msg = 'Completed your account registration!';
            session()->put('msg', translate($success_msg));
            return redirect(route('login'))->with('msg', translate($success_msg));            
		}
		return null;
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

		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET, POST");
		header("Access-Control-Allow-Headers: *");
		header("Access-Control-Allow-Headers: Content-Type");
		
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
        try {
            $this->validator($request->all())->validate();

            //for each conditions validator
            //$this->validator_fields( $request->all() , ['name' => ['required', 'string', 'max:255'] ] );
			
			$user_email = $request->input('email');
			$user_token = Str::random(25);
			
            $user = $this->create($request->all());
			$user_email = $user->email;
			$user_token = $user->remember_token;
			
            // ###################### --->
            // we do not need to create a user email when registering.
            $createdAccount = $request->input('name') . '.' .  $request->input('suffix');
			// # $ret = $mailTester->createMailAddress($createdAccount); //whether success or not

            $account_email = $createdAccount . '@' . env('MAIL_HOST');
            Cookie::queue('email', $account_email, Settings::selectSettings("email_lifetime") * Settings::selectSettings("email_lifetime_type"));
            // Settings::updateSettings(
            //     'total_emails_created',
            //     Settings::selectSettings('total_emails_created') + 1
            // );

            $trashmail = new TrashMail();
            $trashmail->email = $account_email;
            $trashmail->user_id = $user->id;
            $trashmail->save();
            //<---#################################

            ## Send Suitable Email For New User ##
            $user_register_mode = env('user_register_mode');
            if($user_register_mode == 'deactive'){
                // $this->guard()->login($user);
                $success_msg = 'Thanks for registration!';
                session()->flash('success', translate($success_msg));
                //return redirect()->back()->with('msg',trans('main.thanks_reg'));
                session()->put('msg', translate($success_msg));
                return redirect(route('login'))->with('msg', translate($success_msg));
            } else {
				
                sendMail([
                    'recipent'=>[$user_email],	
                    'template'=>'welcome',
                    'subject' =>'Account Activate',
                    'content' => ['token'=>$user_token],
                ]);
                $success_msg = 'Thanks for registration, Please check your email and follow activation link to active your account.';
                session()->flash('success', translate($success_msg));
                session()->put('msg', translate($success_msg));
                //return redirect()->back()->with('msg',trans('main.active_account_alert'));
                return redirect(route('login'))->with('msg',translate($success_msg) );
            }

        } catch (ValidationException $e) {
            $messages = $e->getMessage();
            session()->flash('error', translate('Some validation error occur.' ) );
            return redirect(route('signup'));
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
        $data['trash_mailes.email'] = $data['name'].'.'.$data['suffix'] . '@' . env('MAIL_HOST');
        return Validator::make($data, [
			
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            //'trash_mailes.email' => ['string', 'email', 'max:255', 'unique:trash_mailes'],
			//'g-recaptcha-response' => ['required','captcha'],
        ]);
    }
    protected function validator_fields(array $data, array $rule)
    {
        return Validator::make($data, $rule);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if(env('user_register_mode')=='deactive')	
			$active_status = 'active';
		else
			$active_status = 'inactive';
		
		$user_info = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
            'mode' => $active_status,
            'remember_token' => Str::random(64)
        ];
        $flag =  User::create( $user_info );


        
        return $flag;
    }
	
	public function curl_test(Request $request)
	{
		    $campaignOptions = [
				'from_name' => 'tona',
				'from_email' => 'edgybrains@gmail.com',
				'reply_to' => 'edgybrains@gmail.com',
				'title' => 'Campaign Test',
				'subject' => 'Campaign Test',
				'list_ids' => 'Z763w7631uvsujw7BokSL9EskA,Bwg9oJDFE5k3lJS8B892cFvw',    //'1,2,3', // comma-separated, optional
				'brand_id' => 1,    //1,
				'query_string' => 'utm_source=sendy&utm_medium=email&utm_content=email%20newsletter&utm_campaign=email%20newsletter',
				'send_campaign' => true,
			];
			$campaignContent = [
				'plain_text' => 'My Campaign',
				'html_text' => 'View Html',
			];

			$values = array_merge($campaignOptions, $campaignContent);

			$api_url = '/api/campaigns/create.php';
			$installationUrl = 'https://mailing.edgybrain.com';

			$content = array_merge($values, [
				'list' => 'Z763w7631uvsujw7BokSL9EskA',
				'list_id' => 'Z763w7631uvsujw7BokSL9EskA',
				'api_key' => 'yyXz74g9JvBGdYkaLpz0',
				'boolean' => 'true',
			]);

			/**
			 * Build a query using the $content
			 */
			$post_data = http_build_query($content);
			$ch = curl_init($installationUrl . '/' . $api_url);

			curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

			$result = curl_exec($ch);
			curl_close($ch);
			print_r($result); die;
	}
}