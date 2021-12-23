<?php

namespace App\Http\Controllers\Mailstester;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use App\Models\Settings;
use App\Models\Profile;
use App\Models\UserOption;
use App\Models\TestResult;
use App\Models\WhiteLabel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Vinkla\Hashids\Facades\Hashids;
use Carbon\Carbon;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

use App\Models\Menu;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Models\Language;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SiteController extends Controller
{
    // show json_api page 
    public function json_api()
    {
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata['user_login'] = Auth::user();
        }
        return view('mailstester.json-api')->with('userdata' ,$userdata);

    }
    
    // show get started page 
    public function started()
    {
        $email = null;
        if (Cookie::has('email')) 
            $email =  Cookie::get('email');

        $guard = null;
        $userdata = [];
        $conf = [
            'user_id' => 0,
            'pkey' => '',
            'serverip' => '',
            'clientip' => '',
            'mttoken' => '',
            'micropayment' => 0, 
            'pay_types' => [],
        ];
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata['user_login'] = Auth::user();
            $conf_val = UserOption::getOption($userdata['user_login']['id']);
            if(!empty($conf_val) && !empty($conf_val->user_id))
            $conf = [
                'user_id' => $conf_val->user_id,
                'pkey' => $conf_val->email_key,
                'serverip' => $conf_val->from_ips,
                'clientip' => $conf_val->tests_ips,
                'mttoken' => $conf_val->xmt_tocken,
                'micropayment' => $conf_val->use_micropay,
                'pay_type_ids' => !empty($conf_val->use_micropay) ?  explode(',', $conf_val->pay_types) : [],
            ];
            else
            $conf = [
                'user_id'      => $userdata['user_login']['id'],
                'pkey'         => '',
                'serverip'     => '',
                'clientip'     => '',
                'mttoken'      => '',
                'micropayment' => '',
                'pay_type_ids' => [1,2,4],
            ];
        }
        else
        {
            return redirect(route('login'));
        }
        //print_r($conf);die;
        return view('mailstester.started')
                ->with('email', $email)
                ->with('conf', $conf)
                ->with('userdata' ,$userdata);

    }
    
    // show account page 
    public function account()
    {
        
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata['user_login'] = Auth::user();
        }
        return view('mailstester.account')->with('userdata' ,$userdata);
        //->with('lang_locale', $locale)->with('lang_name', $lang_name);
    }
    
    // show latest-tests page 
    public function latest_tests()
    {
        $email = null;
        if (Cookie::has('email')) 
            $email =  Cookie::get('email');
        
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata['user_login'] = Auth::user();
            $user_id    = $userdata['user_login']->id;
            //$email      = $userdata['user_login']->email;
            $db_hist    = TestResult::where('user_id', $user_id)->orderBy('received_at', 'DESC')->get();
        }
        else
        {
            return redirect(route('spamtest'));
        }
        return view('mailstester.latest-tests')
                ->with('email', $email)
                ->with('db_hist', $db_hist)
                ->with('userdata' ,$userdata);
    }

    
    // show terms-of-service page 
    public function terms_of_service()
    {
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata['user_login'] = Auth::user();
        }
        return view('mailstester.terms-of-service')
                ->with('userdata' ,$userdata);
    }
    
    
    // show Iframe css page 
    public function design(Request $request)
    {
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata['user_login'] = Auth::user();
            $user_id = Auth::user()->id;
        }
        else
        {
            return redirect(route('login'));
        }

        $whitelabel = WhiteLabel::where('user_id', $user_id)->get();

        
        if( isset($_REQUEST['userCss']) || $request->input('userCss')!==null )
        {
            if ($request->input('userCss')==null) $css = '';
            else $css=$request->input('userCss');

            $data = ['user_id'=>$user_id, 'email'=>Auth::user()->email, 'css'=>$css ];
            if($whitelabel->first()!==null)
            {
                $id = $whitelabel->first()->id;
                WhiteLabel::find($id)->update($data);
            }
            else
            {
                WhiteLabel::create($data);
            }
        }

        $whitelabel = WhiteLabel::where('user_id', $user_id)->get();
        if($whitelabel->first()==null) $css = null;
        else $css = $whitelabel->first()->css;

        return view('mailstester.design')
                ->with('css', $css)
                ->with('userdata' ,$userdata);
    }
    
    
    // show FAQ page 
    public function faq()
    {
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata['user_login'] = Auth::user();
        }
        return view('frontend.faq')
                ->with('userdata' ,$userdata);
    }

    // show SPF guide page 
    public function spf($type=null)
    {
        
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata['user_login'] = Auth::user();
        }
        //print($type.'------------'); die;
        if($type!=null)
            return view('frontend.spf-'.$type)->with('userdata' ,$userdata);
        else
            return view('frontend.spf')->with('userdata' ,$userdata);
    }

    // show SPF-DKIM-CHECK page 
    public function dkim_check($type=null)
    {
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata['user_login'] = Auth::user();
        }
        return view('frontend.dkim-check')
                ->with('userdata' ,$userdata);

    }
    public function profile($type=null)
    { 
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata['user_login'] = Auth::user();
        }
        $addressdata = [];

        if($type=='account'){
            $viewpage = ('mailstester.profile-account');
        } else if($type=='address'){
            $addressdata = Profile::where('user_id',$userdata['user_login']->id)->get();
            $viewpage = ('mailstester.profile-address');
        } else {
            abort(404); //redirect(404);
        }

        return view($viewpage)
            ->with('userdata' ,$userdata)
            ->with('addressdata' ,$addressdata);        
    }

    public function ajax_getmemInfo($userid){
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata = Auth::user();
        }

        $user_profile = [];
        if(($user_profile = Profile::selectUserProfile($userid)))
            $userdata = $userdata  + $user_profile;
        print(json_encode($userdata));die;
    }

    public function save_configure(Request $request){ 
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata = Auth::user();

            $pay_type_ids = '';
            foreach($request->pay_type as $id)
            {
                if($pay_type_ids!='')   $pay_type_ids .= ',';
                $pay_type_ids .= $id;
            }
            
            if( ($options = UserOption::getOption($userdata['id'])) )
            {
                $options->email_id      = $userdata->trashmail[0]->id;
                $options->email_key     = $request->pkey;
                $options->from_ips      = $request->serverip;
                $options->test_ips      = $request->clientip;
                $options->xmt_token     = $request->mttoken;
                $options->use_micropay  = $request->micropayment;
                if($request->micropayment)
                    $options->pay_types     = $pay_type_ids;
                else
                    $options->pay_types     = '';
                $options->update();
            }
            else
            {
                //dd($pay_type_ids);
                $options = new UserOption();
                $options->user_id       = $userdata['id'];
                $options->pay_types     = $request->micropayment;
                if(!empty($userdata->trashmail) && count($userdata->trashmail)>0)
                    $options->email_id      = $userdata->trashmail[0]->id;
                else
                    $options->email_id      = 0;
                $options->email_key     = $request->pkey;
                $options->from_ips      = $request->serverip;
                $options->test_ips      = $request->clientip;
                $options->xmt_token     = $request->mttoken;
                $options->use_micropay  = $request->micropayment;
                if($request->micropayment)
                    $options->pay_types     = $pay_type_ids;
                else
                    $options->pay_types     = '';
                $options->save();
            }
            
        }

        return redirect(route('get-started'));
    }
    public function save_account(Request $request){ 
        
        $userdata = Auth::user();
        try {
            $this->account_validator($request->all())->validate();
            $old_email = $userdata->email;
            $new_email = $request->get('email');
            if($old_email != $new_email){
                User::find($userdata->id)->update([
                    'email' => $new_email
                ]);
            }                

            $password = $request->get('password');
            $password_confirmation = $request->get('password_confirmation');

            if (!empty($password) and !empty($password_confirmation) and $password == $password_confirmation) {
                $new_password = Hash::make($password);
                User::find($userdata->id)->update([
                    'password' => $new_password
                ]);
            }
            $success_msg = 'Your account updated successfully.';
            session()->flash('success', __($success_msg));
            return redirect(route('profile','account'));

        } catch (ValidationException $e) {
            session()->flash('error', __('Some validation error occur.'));
            return redirect(route('profile','account'));
        } 
    }

    protected function account_validator(array $data)
    {
        $userdata = Auth::user();
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($userdata)],
        ]);
    }

    public function set_default_address(Request $request) {
        $userdata = Auth::user();
        Profile::where('user_id', $userdata->id)->where('default_address','1')->update(['default_address' => '0']);
        $address_id = $request->get('default_address');
        Profile::where('id', $address_id)->update(['default_address' => '1']);
        return redirect(route('profile','address'));
    }

    public function get_address_detail(Request $request) {
        $profile_id = $request->input('profile_id');
        $user_id = $request->input('user_id');
        if( !empty($user_id ))
            $addressdata = Profile::where('id',$user_id)->first();
        else
            $addressdata = Profile::where('id',$profile_id)->first();
        $result = ['detail'=>$addressdata];
        return json_encode($result);
    }

    public function save_address(Request $request){
        $userdata = Auth::user();
        
        $id = $request->get('profile_id');
        // print_r($request->all());exit;
        if(!empty($id)){ //edit profile
            Profile::find($id)->update($request->all());
            $success_msg = 'Your address updated successfully.';
            session()->flash('success', __($success_msg));
        } else {
            $firstname = $request->get('firstname');
            $lastname = $request->get('lastname');
            $company = $request->get('company');
            $vatnum = $request->get('vatnum');
            $address = $request->get('address');
            $postcode = $request->get('postcode');
            $city = $request->get('city');
            $telephone = $request->get('telephone');
            $country = $request->get('country');
            $state = $request->get('state');
            $flag =  Profile::create([
                'user_id' => $userdata->id,
                // 'mail_addr' => '',
                'firstname' => $firstname,
                'lastname' => $lastname,
                'company' => $company,
                'vatnum' => $vatnum,
                'address' => $address,
                'postcode' => $postcode,
                'city' => $city,
                'telephone' => $telephone,
                'country' => $country,
                'state' => $state
            ]);
            $success_msg = 'Your address created successfully.';
            session()->flash('success', __($success_msg));
        }
        return redirect(route('profile','address'));
    }

    public function delete_address(Request $request){
        $profile_id = $request->get('profile_id');
        Profile::where('id',$profile_id)->delete();
        $result = ['status'=>'success'];
        return json_encode($result);
    }
    

    public function cart_type_cart(){
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata['user_login'] = Auth::user();
        }
        else
        {
            redirect(route('login'));
        }
        return view('mailstester.carts')
                ->with('userdata' ,$userdata);
    }

    public function not_received($user=null){
        return view('mailstester.not-received' );
        
    }
    public function dbug_example($user=null){
        return view('mailstester.dbug-example' );
        
    }
    
    public function affiliate(){return null;}
    public function check(){return null;}
    public function design_wait($site){return $site;}
    public function design_score($site){return $site;}
}