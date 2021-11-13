<?php

namespace App\Http\Controllers\Mailstester;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Settings;
// use App\Models\TrashMail;
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


public function save_account(){ return null;}
public function save_address(){ return null;}
public function save_task(){ return null;}

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