<?php

namespace App\Http\Controllers\Mailstester;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Settings;
use App\Models\Profile;
// use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Cache;
// use Vinkla\Hashids\Facades\Hashids;
// use Carbon\Carbon;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

use App\Models\Menu;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Models\Language;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;

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
        $price = $request->price;
        $qty = $request->qty;

        if($payment_method == 'paypal'){ 
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
        }else{ 
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

        if($payment_method == 'paypal'){ 
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
        }else{
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
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata['user_login'] = Auth::user();
        }
        return view('mailstester.started')
            ->with('email', $email)
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
        }
        return view('mailstester.latest-tests')
                ->with('email', $email)
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
        return view('mailstester.faq')
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
        return view('mailstester.dkim-check')
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

        if($type=='account')
            $viewpage = ('mailstester.profile-account');
        else if($type=='address')
            $viewpage = ('mailstester.profile-address');
        else
            abort(404); //redirect(404);

        return view($viewpage)->with('userdata' ,$userdata);        
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
public function save_account(){ return null;}
public function save_address(){ return null;}
public function save_configure(){ return null;}

    public function checkout($price){ return $price;}
    public function address(){return null;}
    public function order(){return null;}
    public function cart_type_cart(){return null;}
    public function affiliate(){return null;}
    public function check(){return null;}
    public function design_wait($site){return $site;}
    public function design_score($site){return $site;}
    public function design_not_received($site){return $site;}
}