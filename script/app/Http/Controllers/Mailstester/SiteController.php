<?php

namespace App\Http\Controllers\Mailstester;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use App\Models\Settings;
use App\Models\Profile;
use App\Models\Configure;
use App\Models\TestResult;
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

    // show prices page 
    public function index()
    {
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata['user_login'] = Auth::user();
        }
        return view('mailstester.prices')->with('userdata' ,$userdata);
        
    }

    public function buy_mail_test(Request $request){
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $userdata = Auth::user();
        }else{
            return redirect(route('prices'));
        }

        $payment_method = $request->buyMode;
        $price = $request->pay_price;
        $qty = $request->pay_qty;
        $coupon = $request->pay_coupon;

        if($payment_method == 'paybox_paypal'){ 
            // paypal ---------------------------------------
            $provider = new PayPalClient([]);
            $provider->getAccessToken();

            $result = $provider->createOrder([
                "intent"=> "CAPTURE",
                "purchase_units"=> [
                    0 => [
                        "amount"=> [
                            "currency_code"=> "EUR",
                            "value"=> strval(round($price,2))
                        ]
                    ]
                ],
                "application_context" => [
                    "cancel_url" => route('prices'),
                    "return_url" => route('payment_status')
                ] 
            ]);
            session()->put('Order_method_'.$userdata['id'],$payment_method);
            session()->put('Order_id_'.$userdata['id'],$result['id']);
            session()->put('Order_qty_'.$userdata['id'],$qty);
            foreach($result['links'] as $l){
                if($l['rel'] == 'approve'){
                    return redirect($l['href']);
                }            
            }
            session()->flash('error', translate('Some error occur, sorry for inconvenient.'));
            return redirect(route('prices'));
        }else if($payment_method == 'paybox_stripe'){ 
            // stripe -----------------------------------------
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $Checkout = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'EUR',
                        'unit_amount' => $price*100,
                        'product_data' => [
                            'name' => 'mail test',
                        ],
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('payment_status') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('prices'),
            ]);

            session()->put('Order_method_'.$userdata['id'],$payment_method);
            session()->put('Order_qty_'.$userdata['id'],$qty);
            
            if(isset($Checkout->id)){
                session()->put('Order_id_'.$userdata['id'],$Checkout->id);
                $Html = '<script src="https://js.stripe.com/v3/"></script>';
                $Html.= '<script type="text/javascript">let stripe = Stripe("'.env('STRIPE_KEY').'");';
                $Html.= 'stripe.redirectToCheckout({ sessionId: "'.$Checkout->id.'" }); </script>';
                echo $Html;
            }else{
                return redirect(route('prices'));
            }
        }
        else{
            abort(419);
        }
    }

    public function payment_status(Request $request){
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $userdata = Auth::user();
        }else{
            return redirect(route('prices'));
        }
        $payment_method = session()->get('Order_method_'.$userdata['id']);

        if($payment_method == 'paybox_paypal'){ 
            // paypal status ---------------------------------
            $orderID = session()->get('Order_id_'.$userdata['id']);
            $qty = session()->get('Order_qty_'.$userdata['id']);
            $provider = new PayPalClient([]);
            $provider->getAccessToken();
            $response = $provider->capturePaymentOrder($orderID);
            if($response['status'] == 'COMPLETED'){
                return redirect(route('checkout', $qty));
            }else{
                session()->flash('error', translate('Payment failed.'));
                return redirect(route('prices'));
            } 
        }else if($payment_method == 'paybox_stripe'){ 
            // stripe status ---------------------------------
            $orderID = session()->get('Order_id_'.$userdata['id']);
            $qty = session()->get('Order_qty_'.$userdata['id']);
            if(isset($orderID) && isset($request->session_id)){
                Stripe::setApiKey(env('STRIPE_SECRET'));
                $session = StripeSession::retrieve($request->session_id);
                if($session && $session->payment_status == 'paid'){
                    return redirect(route('checkout', $qty));
                }
            }
            session()->flash('error', translate('Payment failed.'));
            return redirect(route('prices'));
        }         
        else
        {
            abort(419);
        }
    }


    // show prices page 
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
            'micropayment' => 0
        ];
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata['user_login'] = Auth::user();
            $conf_val = Configure::selectConfigures($userdata['user_login']['id']);
            if(!empty($conf_val) && !empty($conf_val->user_id))
            $conf = [
                'user_id' => $conf_val->user_id,
                'pkey' => $conf_val->private_key,
                'serverip' => $conf_val->server_ips,
                'clientip' => $conf_val->client_ips,
                'mttoken' => $conf_val->x_mt_tocken,
                'micropayment' => $conf_val->micro_payment
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
            $email      = $userdata['user_login']->email;
            $db_hist    = TestResult::where('user_id', $user_id)->get();
        }
        else
        {
            return redirect(route('go_spamtest'));
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
    public function design()
    {
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata['user_login'] = Auth::user();
        }
        else
        {
            return redirect(route('login'));
        }
        return view('mailstester.design')
                ->with('userdata' ,$userdata);
    }
    
    
    // show micro-payment page 
    public function micro_payment()
    {
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata['user_login'] = Auth::user();
        }
        return view('mailstester.micro-payment')
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
            //print_r($userdata); die;
            if( ($configure = Configure::selectConfigures($userdata['id'])) )
            {
                $configure->private_key     = $request->pkey;
                $configure->server_ips      = $request->serverip;
                $configure->client_ips      = $request->clientip;
                $configure->x_mt_tocken     = $request->mttoken;
                $configure->micro_payment   = $request->micropayment;
                $configure->update();
            }
            else
            {
                $configure = new Configure();
                $configure->user_id = $userdata['id'];
                $configure->private_key     = $request->pkey;
                $configure->server_ips      = $request->serverip;
                $configure->client_ips      = $request->clientip;
                $configure->x_mt_tocken     = $request->mttoken;
                $configure->micro_payment   = $request->micropayment;
                $configure->save();
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
            session()->flash('success', translate($success_msg));
            return redirect(route('profile','account'));

        } catch (ValidationException $e) {
            session()->flash('error', translate('Some validation error occur.'));
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
            session()->flash('success', translate($success_msg));
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
            session()->flash('success', translate($success_msg));
        }
        return redirect(route('profile','address'));
    }

    public function delete_address(Request $request){
        $profile_id = $request->get('profile_id');
        Profile::where('id',$profile_id)->delete();
        $result = ['status'=>'success'];
        return json_encode($result);
    }
    
    public function order(){
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
        return view('mailstester.orders')
                ->with('userdata' ,$userdata);
    }
    
    public function order_detail($orderid){
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
        return view('mailstester.order_detail')
                ->with('userdata' ,$userdata);
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

    public function checkout($price=null){ 
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
        return redirect( route('checkout', 'step1') );
    }

    public function checkout_step(Request $request, $step){ 
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata['user_login'] = Auth::user();
            $user_id = Auth::user()->id;
            $addressdata = Profile::where([ 'user_id'=>$user_id, 'default_address'=>1 ])->get();
            if(!$addressdata->isEmpty())
            {
                $userdata['user_profile'] = $addressdata->first();
            }
            else
            {
                redirect( route('profile', 'address') );
            }
        }
        else
        {
            redirect(route('login'));
        }

        $checkout_payment_mode = 0;
        $checkout_payment_coupon = '';
        $pay_price = 50;
        $pay_qty = 1;
        $pay_name = '500 tests';

      //  print($step . $request->input('pay_qty')); die;
        if($step=='step3')
        {
            //print($request->input('mailtester_payment')); die;
            if(     !empty($request->input('mailtester_payment'))  )
            {
                $coupon_code = $request->input('coupon');
                $mailtester_payment_mode = $request->input('mailtester_payment');
                Session::put('checkout_payment_mode',   $mailtester_payment_mode);
                Session::put('checkout_payment_coupon', $coupon_code );
                $checkout_payment_mode = Session::get('checkout_payment_mode');
                $checkout_payment_coupon = Session::get('checkout_payment_coupon');
            }
            if(     $request->input('pay_qty')!==null )
            {
                $pay_qty = $request->input('pay_qty');
                $pay_price = $request->input('pay_price');
                Session::put('pay_qty',   $pay_qty);
                Session::put('pay_price', $pay_price );
            }
        }

        if($step=='step1')
        {
            if(     !empty($request->input('price'))  )
            {
                $pay_price = $request->input('price');
                $pay_qty = $request->input('qty');
                $pay_name = $request->input('name');
                Session::put('pay_price',   $pay_price);
                Session::put('pay_qty',   $pay_qty);
                Session::put('pay_name',   $pay_name);
            }
        }


        #---------------------------------------------step1
        if(Session::has('pay_price'))
            $pay_price = Session::get('pay_price');
        if(Session::has('pay_qty'))
            $pay_qty = Session::get('pay_qty');
        if(Session::has('pay_name'))
            $pay_name = Session::get('pay_name');
        #---------------------------------------------step2
        if(Session::has('checkout_payment_mode'))
            $checkout_payment_mode = Session::get('checkout_payment_mode');
        if(Session::has('checkout_payment_mode'))
            $checkout_payment_coupon = Session::get('checkout_payment_coupon');
        #---------------------------------------------

       // print($pay_qty); die;
        return view('mailstester.checkout-' . substr($step, -1))
                    ->with('pay_price' ,$pay_price)
                    ->with('pay_qty' ,$pay_qty)
                    ->with('pay_name' ,$pay_name)
                    ->with('checkout_payment_mode' ,$checkout_payment_mode)
                    ->with('checkout_payment_coupon' ,$checkout_payment_coupon)
                    ->with('userdata' ,$userdata);
    }
    //public function address(){return null;}
    
    public function affiliate(){return null;}
    public function check(){return null;}
    public function design_wait($site){return $site;}
    public function design_score($site){return $site;}
    public function design_not_received($site){return $site;}
}