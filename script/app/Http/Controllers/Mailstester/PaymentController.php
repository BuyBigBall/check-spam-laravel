<?php

namespace App\Http\Controllers\Mailstester;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use App\Models\Settings;
use App\Models\Profile;
use App\Models\TestResult;
use App\Models\WhiteLabel;
use App\Models\Transaction;
use App\Models\Balance;
use App\Models\TrashMail;
use App\Models\Coupon;
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
use DB;

class PaymentController extends Controller
{
    protected $price_count = [50=>500, 80=>1000, 250=>5000, 700=>20000, 2500=>100000, 20000=>1000000];
    // show prices page 
    public function index()
    {
        $left_count = 0;
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata['user_login'] = Auth::user();
            $balance = Balance::where('user_id', $userdata['user_login']->id)
            ->select(DB::raw('SUM(supply-used) as leftcount'))
            ->get()->first();
            if($balance!=null)  $left_count = $balance->leftcount;
        }
        return view('mailstester.prices')
                ->with('left_count', $left_count)
                ->with('userdata' ,$userdata);
        
    }

    // goto Payment site page
    public function buy_mail_test(Request $request){
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $userdata = Auth::user();
        }else{
            return redirect(route('login'));
        }
        $request->validate([
            'firstname' => 'required|max:255|min:2',
            'lastname'  => 'required|max:255|min:2',
            'country'   => 'required|max:255|min:2',
            'address'   => 'required|max:255|min:2',
            'city'      => 'required|max:255|min:2',
            'state'     => 'required|max:255|min:2',
            'mail_addr' => 'email|required|max:255|min:2',
            'telephone' => 'required|max:12|min:8|regex:/[0-9]/', //|regex:/(01)[0-9]{9}/
            'state'     => 'required|max:255|min:2',
            'postcode'  => 'required|max:255|min:6',
        ]);

        $profile_id = $this->SaveAndGetProfile($userdata['id'], $request);
        $payment_method = $request->payment_method;
        $price = $request->pay_price;
        $qty = $request->pay_qty;
        $coupon = $request->pay_coupon;
        if(!empty($coupon) && !empty($request->coupon_code) )
        {
            coupon::where('coupon_code',$request->coupon_code)->update(['state' => 1, 'user_id' => $userdata['id']]);
        }
        $pay_amount = ($price * $qty - $coupon)* (100+ env('VAT_FEE') )/100.0 ;

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
                            "value"=> strval(round($pay_amount,2))
                        ]
                    ]
                ],
                "application_context" => [
                    "cancel_url" => route('prices'),
                    "return_url" => route( env('PAYPAL_RETURN_URL') )
                ] 
            ]);
            session()->put('Order_method_'.$userdata['id'], $payment_method);
            session()->put('Order_id_'.$userdata['id'],     $result['id']);
            session()->put('Order_qty_'.$userdata['id'],    $pay_amount);
            session()->put('Order_price_'.$userdata['id'],  $price);
            session()->put('Order_count_'.$userdata['id'],  $qty);
            session()->put('Order_userid_'.$userdata['id'],  $profile_id);
            if(!empty($coupon) && !empty($request->coupon_code) )
            {
                session()->put('Order_CouponCode_'.$userdata['id'],  $request->coupon_code);
                session()->put('Order_CouponAmount_'.$userdata['id'],  $coupon);
            }            
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
                        'unit_amount' => $pay_amount * 100,
                        'product_data' => [
                            'name' => 'mail test',
                        ],
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route( env('STRIPE_RETURN_URL')) . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('prices'),
            ]);

            session()->put('Order_method_'.$userdata['id'],$payment_method);
            session()->put('Order_qty_'.$userdata['id'],    $pay_amount);
            session()->put('Order_price_'.$userdata['id'],  $price);
            session()->put('Order_count_'.$userdata['id'],  $qty);
            session()->put('Order_userid_'.$userdata['id'],  $profile_id);
            if(!empty($coupon) && !empty($request->coupon_code) )
            {
                session()->put('Order_CouponCode_'.$userdata['id'],  $request->coupon_code);
                session()->put('Order_CouponAmount_'.$userdata['id'],  $coupon);
            }            
            
            if(isset($Checkout->id)){
                session()->put('Order_id_'.$userdata['id'],     $Checkout->id);
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

    # payment return url
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
            $profile_id = session()->get('Order_userid_'.$userdata['id']);
            $orderID = session()->get('Order_id_'.$userdata['id']);
            $qty = session()->get('Order_qty_'.$userdata['id']);
            $provider = new PayPalClient([]);
            $provider->getAccessToken();
            $response = $provider->capturePaymentOrder($orderID);
            if($response['status'] == 'COMPLETED'){
                $inserted_id = $this->save_Paypal_payment_history($qty , $response);
                $balance_id = $this->create_balance($inserted_id);
                return redirect(route('checkout', 'step4'));
            }else{
                session()->flash('error', translate('Payment failed.'));
                return redirect(route('prices'));
            } 
        }else if($payment_method == 'paybox_stripe'){ 
            // stripe status ---------------------------------
            $profile_id = session()->get('Order_userid_'.$userdata['id']);
            $orderID = session()->get('Order_id_'.$userdata['id']);
            $qty = session()->get('Order_qty_'.$userdata['id']);
            if(isset($orderID) && isset($request->session_id)){
                Stripe::setApiKey(env('STRIPE_SECRET'));
                $session = StripeSession::retrieve($request->session_id);
                if($session && $session->payment_status == 'paid'){
                    $inserted_id = $this->save_Stripe_payment_history($qty , $session);
                    $balance_id = $this->create_balance($inserted_id);
                    return redirect(route('checkout', 'step4'));
                }
            }
            session()->flash('error', translate('Payment failed.'));
            return redirect(route('latest-tests'));
        }         
        else
        {
            abort(419);
        }
    }

    public function micropay()
    {
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata['user_login'] = Auth::user();
        }
        return view('mailstester.checkout-micropay')
                ->with('userdata' ,$userdata);
    }
    // show micro-payment page 
    public function micro_payment_note()
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

    # view order hist
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
        $profile_ids = [];
        $profiles = Profile::where('user_id', $userdata['user_login']->id)->get();
        foreach($profiles as $row)
        {
            $profile_ids[] = $row->id;
        }

        $order_rows = Transaction::wherein('user_id', $profile_ids)
                    ->orderBy('created_at', 'DESC')->get();
        
        //print($order_rows[0]->balance->supply); die;
        //print_r($order_rows[0]); die;
        // $lists = Requests::where('user_id', $user->id)
        //     ->orWhere('requester_id', $user->id)
        //     ->with(['category', 'requester', 'suggestions' => function ($q) {
        //         $q->with(['content', 'user']);
        //     }])
        //     ->get();



        //print_r($order_rows); die;
        return view('mailstester.orders')
                ->with('order_rows', $order_rows)
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
        $order_detail = Transaction::where('pay_id', $orderid)->get()->first();
        return view('mailstester.order_detail')
                ->with('details', $order_detail)
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

        $checkout_payment_mode = 'paybox_stripe';
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
        $pay_amount = $pay_qty * $pay_price;
        $charge_date = date('d-n-Y H:i:s');
        $email = '';
        $price_type = '';
        
        if($step=='step4')
        {
            if(empty(session()->get('summery-email')))
            {
                abort(419); return;
            }
            $email = session()->get('summery-email');
            $charge_date = session()->get('summery-date');
            $price_type = session()->get('summery-type');
            $pay_qty = session()->get('summery-qty');
            $pay_amount = session()->get('summery-amount');
            $pay_name = session()->get('summery-mode');
            #  $pay_price <== from session on prev block
        }

       // print($pay_qty); die;
        return view('mailstester.checkout-' . substr($step, -1))
                    ->with('pay_price' ,$pay_price)
                    ->with('email' ,$email)
                    ->with('price_type', $price_type)
                    ->with('pay_qty' ,$pay_qty)
                    ->with('pay_name' ,$pay_name)
                    ->with('pay_amount' ,$pay_amount)
                    ->with('charge_date', $charge_date)
                    ->with('checkout_payment_mode' ,$checkout_payment_mode)
                    ->with('checkout_payment_coupon' ,$checkout_payment_coupon)
                    ->with('userdata' ,$userdata);
    }

    public function paypal_notify(Request $request)
    {
        return [];
    }

    private function create_balance($transaction_id)
    {
        $trans = Transaction::where('id', $transaction_id)->get()->first();
        $user_id = Auth::user()->id;
        $email_id = $trans->email_id;
        $price_type= $trans->price_type;
        $price= $trans->price;
        $qty= $trans->qty;
        $supply = empty($this->price_count[$price]) ? 0 : $this->price_count[$price];

        $balance = new Balance();
        $balance->user_id = $user_id;
        $balance->email_id = $email_id;
        $balance->price_type = $price_type;
        $balance->price = $price;
        $balance->qty = $qty;
        $balance->supply = $supply;
        $balance->save();
        $balance_id = $balance->id;

        Transaction::find($transaction_id)->update(['balance_id'=>$balance_id]);

        if( !empty(TrashMail::where('id',$email_id)->get()) &&
            !empty(TrashMail::where('id',$email_id)->get()->first())
            )
            $email = TrashMail::where('id',$email_id)->get()->first()->email;
        else if (Cookie::has('email')) 
            $email =  Cookie::get('email');
        else
            $email = TrashMailController::generateRandomEmail();
        session()->put('summery-email',$email);
        session()->put('summery-date', $trans->created_at);
        session()->put('summery-type', $price_type);
        session()->put('summery-qty',  $qty);
        session()->put('summery-amount',  $trans->amount);
        session()->put('summery-mode',  $trans->bank);
        return $balance_id;
    }

    private function save_Paypal_payment_history($pay_amount, $payment_response)
    {
        $user_id = Auth::user()->id;

        $email_id = 0;
        $user_email = TrashMail::where(['user_id'=>$user_id])->orderBy('updated_at','DESC')->get();
        if(!empty($user_email) && !empty($user_email->first())) 
            $email_id = $user_email->first()->id;

        $price = session()->get('Order_price_'.$user_id);
        $pay_qty = session()->get('Order_count_'.$user_id);
        $price_type = empty($this->price_count[$price]) ? -1 : $this->price_count[$price];
        $profile_id = session()->get('Order_userid_'.$user_id);

        $deal_id = $payment_response['id'];
        $pay_id = '';
        $pay_mode = '';
        foreach($payment_response['purchase_units'] as $purchase)
        {
            foreach($purchase['payments']['captures'] as $pay_row)
            {
                $pay_id = $pay_row['id'];
                $pay_mode = $pay_row['status'];
            }
        }
        $authority = $payment_response['payer']['payer_id'];
        $bank = 'paypal';
        $type = 'peding';
        $income = round($pay_amount * 100.0 / (100+env('VAT_FEE')),2);

        $tranc = new Transaction();
        $tranc->user_id = $profile_id;
        $tranc->email_id = $email_id;
        $tranc->price_type = $price_type;
        $tranc->price = $price;
        $tranc->qty = $pay_qty;
        $tranc->amount = $pay_amount;
        $tranc->deal_id = $deal_id;
        $tranc->pay_id = $pay_id;
        $tranc->mode = $pay_mode;
        $tranc->authority = $authority;
        $tranc->bank = $bank;
        $tranc->type = $type;
        $tranc->income = $income;
        
        $tranc->fee = env('VAT_FEE');
        if(!empty($coupon) && !empty($request->coupon_code) )
        {
            $couponcode = session()->get('Order_CouponCode_'.$user_id);
            $couponamount = session()->get('Order_CouponAmount_'.$user_id);
            $tranc->coupon_code = $couponcode;
            $tranc->coupon_amount = $couponamount;
    
        }            

        $tranc->save();

        return $tranc->id;
    }
    
    private function save_Stripe_payment_history($pay_amount, $payment_response)
    {
        $payment_response = $payment_response->toArray();

        $user_id = Auth::user()->id;

        $email_id = 0;
        $user_email = TrashMail::where(['user_id'=>$user_id])->orderBy('updated_at','DESC')->get();
        if(!empty($user_email) && !empty($user_email->first())) 
            $email_id = $user_email->first()->id;

        $price = session()->get('Order_price_'.$user_id);
        $pay_qty = session()->get('Order_count_'.$user_id);
        $price_type = empty($this->price_count[$price]) ? -1 : $this->price_count[$price];

        $deal_id = $payment_response['id'];
        $pay_id = $payment_response['customer'];
        $pay_mode = $payment_response['payment_method_types'][0];

        $authority = $payment_response['payment_intent'];
        $bank = 'stripe';
        $type = $payment_response['payment_status'];
        $income = round($pay_amount * 100.0 / (100+env('VAT_FEE')),2);

        $tranc = new Transaction();
        $tranc->user_id = $user_id;
        $tranc->email_id = $email_id;
        $tranc->price_type = $price_type;
        $tranc->price = $price;
        $tranc->qty = $pay_qty;
        $tranc->amount = $pay_amount;
        $tranc->deal_id = $deal_id;
        $tranc->pay_id = $pay_id;
        $tranc->mode = $pay_mode;
        $tranc->authority = $authority;
        $tranc->bank = $bank;
        $tranc->type = $type;
        $tranc->income = $income;

        $tranc->fee = env('VAT_FEE');
        if(!empty($coupon) && !empty($request->coupon_code) )
        {
            $couponcode = session()->get('Order_CouponCode_'.$user_id);
            $couponamount = session()->get('Order_CouponAmount_'.$user_id);
            $tranc->coupon_code = $couponcode;
            $tranc->coupon_amount = $couponamount;
        }            

        $tranc->save();

        return $tranc->id;
    }

    public function onepage(Request $request)
    {

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

        $error_message = [];
        //print_r($request->price); die;
        $checkout_payment_mode = 'paybox_stripe';
        $checkout_payment_coupon = '';
        $coupon = 0;
        $pay_price = $request->price;
        $pay_qty   = $request->qty;
        $pay_name  = $request->name;

        if(!empty($request->coupon_code))
        {
            $checkout_payment_coupon = $request->coupon_code;
            $coupon = Coupon::where('coupon_code', $checkout_payment_coupon)
                        ->where('state', 0)
                        ->where(DB::raw("DATEDIFF('expiry_date', now())>0"))
                        ->get()->first();
            
            $pay_price = session()->get('pay_price_'.$userdata['user_login']['id']);
            $pay_qty    = session()->get('pay_qty_'.$userdata['user_login']['id']);
            $pay_name  = session()->get('pay_name_'.$userdata['user_login']['id']);
            if($coupon!=null)
            {
                $coupon = round($coupon->coupon_amt * $pay_price / 100.0,1);
            }
            else
            {
                $checkout_payment_coupon = '';
                $coupon = 0;
                $error_message['coupon'] = 'The Coupon you entered could not be found.';
            }
        }
        session()->put('pay_price_'.$userdata['user_login']['id'], $pay_price);
        session()->put('pay_qty_'.$userdata['user_login']['id'],   $pay_qty);
        session()->put('pay_name_'.$userdata['user_login']['id'],  $pay_name);

        $pay_amount = ($pay_qty * $pay_price - $coupon) * (100 + env('VAT_FEE') )/100.0 ;
        $charge_date = date('d-n-Y H:i:s');
        $email = '';
        $price_type = '';

        return view('mailstester.payment-page' )
                    ->with('error_message', $error_message)
                    ->with('pay_price'  ,$pay_price)
                    ->with('pay_qty'    ,$pay_qty)
                    ->with('pay_name'   ,$pay_name)
                    ->with('pay_amount' ,$pay_amount)
                    ->with('charge_date',$charge_date)
                    ->with('checkout_payment_mode' ,$checkout_payment_mode)
                    ->with('checkout_payment_coupon' ,$checkout_payment_coupon)
                    ->with('coupon', $coupon)
                    ->with('userdata' ,$userdata);
    }

    private function SaveAndGetProfile($user_id, $request)
    {
        
        $user_profile = Profile::where(['user_id'=>$user_id,
                    'firstname'=>$request->firstname,
                    'lastname'=>$request->lastname
                    ])->get()->first();
        
        
        
        $data = [
            'user_id'   => $user_id,
            'firstname' => $request->firstname ,
            'lastname'  => $request->lastname ,
            'company'   => $request->company ,
            'country'   => $request->country   ,
            'address'   => $request->address   ,
            'city'      => $request->city      ,
            'state'     => $request->state     ,
            'mail_addr' => $request->mail_addr ,
            'telephone' => $request->telephone ,
            'state'     => $request->state     ,
            'postcode'  => $request->postcode  ,
            'default_address' => 1
        ];
        
        if($user_profile==null)
        {
            $profile = new Profile();
            $profile->user_id        = $user_id;
            $profile->firstname      = $request->firstname;
            $profile->lastname       = $request->lastname;
            $profile->company        = $request->company;
            $profile->country        = $request->country;
            $profile->address        = $request->address;
            $profile->city           = $request->city;
            $profile->state          = $request->state;
            $profile->mail_addr      = $request->mail_addr;
            $profile->telephone      = $request->telephone;
            $profile->state          = $request->state;
            $profile->postcode       = $request->postcode;
            $profile->default_address= 1;
            $profile->save();
            $profile_id = $user_profile->id;
        }
        else
        {
            $result = Profile::where('id', $user_profile->id)->update($data);
            $profile_id = $user_profile->id;
        }
        
        return $profile_id;
    }
}