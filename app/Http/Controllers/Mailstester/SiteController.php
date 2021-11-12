<?php

namespace App\Http\Controllers\Mailstester;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Cookie;
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


class SiteController extends Controller
{

    // show prices page 
    public function index()
    {
        
        $title = translate('Home Page Title', 'seo');
        $description = translate('Home Page Description', 'seo');
        $keyword = translate('Home Page keywords', 'seo');
        $canonical = url()->current();
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keyword);
        SEOMeta::setCanonical($canonical);
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setSiteName(Settings::selectSettings('name'));
        OpenGraph::addImage(asset(Settings::selectSettings('og_image')));
        OpenGraph::setUrl($canonical);
        OpenGraph::addProperty('type', 'article');

        $links = Menu::all();
        $locale = LaravelLocalization::getCurrentLocale();
        $lang_name = Language::where('code', $locale)->first()->name;
        return view('mailstester.prices')->with('lang_locale', $locale)->with('lang_name', $lang_name);
    }


    // show prices page 
    public function json_api()
    {
        
        $title = translate('Home Page Title', 'seo');
        $description = translate('Home Page Description', 'seo');
        $keyword = translate('Home Page keywords', 'seo');
        $canonical = url()->current();
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keyword);
        SEOMeta::setCanonical($canonical);
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setSiteName(Settings::selectSettings('name'));
        OpenGraph::addImage(asset(Settings::selectSettings('og_image')));
        OpenGraph::setUrl($canonical);
        OpenGraph::addProperty('type', 'article');

        $links = Menu::all();
        $locale = LaravelLocalization::getCurrentLocale();
        $lang_name = Language::where('code', $locale)->first()->name;
        return view('mailstester.json-api')->with('lang_locale', $locale)->with('lang_name', $lang_name);
    }

    
    // show get started page 
    public function started()
    {
        
        $title = translate('Home Page Title', 'seo');
        $description = translate('Home Page Description', 'seo');
        $keyword = translate('Home Page keywords', 'seo');
        $canonical = url()->current();
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keyword);
        SEOMeta::setCanonical($canonical);
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setSiteName(Settings::selectSettings('name'));
        OpenGraph::addImage(asset(Settings::selectSettings('og_image')));
        OpenGraph::setUrl($canonical);
        OpenGraph::addProperty('type', 'article');

        $links = Menu::all();
        $locale = LaravelLocalization::getCurrentLocale();
        $lang_name = Language::where('code', $locale)->first()->name;
        return view('mailstester.started')->with('lang_locale', $locale)->with('lang_name', $lang_name);
    }
    
    
    // show account page 
    public function account()
    {
        
        $title = translate('Home Page Title', 'seo');
        $description = translate('Home Page Description', 'seo');
        $keyword = translate('Home Page keywords', 'seo');
        $canonical = url()->current();
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keyword);
        SEOMeta::setCanonical($canonical);
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setSiteName(Settings::selectSettings('name'));
        OpenGraph::addImage(asset(Settings::selectSettings('og_image')));
        OpenGraph::setUrl($canonical);
        OpenGraph::addProperty('type', 'article');

        $links = Menu::all();
        $locale = LaravelLocalization::getCurrentLocale();
        $lang_name = Language::where('code', $locale)->first()->name;
        return view('mailstester.account')->with('lang_locale', $locale)->with('lang_name', $lang_name);
    }
    
    // show latest-tests page 
    public function latest_tests()
    {
        
        $title = translate('Home Page Title', 'seo');
        $description = translate('Home Page Description', 'seo');
        $keyword = translate('Home Page keywords', 'seo');
        $canonical = url()->current();
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keyword);
        SEOMeta::setCanonical($canonical);
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setSiteName(Settings::selectSettings('name'));
        OpenGraph::addImage(asset(Settings::selectSettings('og_image')));
        OpenGraph::setUrl($canonical);
        OpenGraph::addProperty('type', 'article');

        $links = Menu::all();
        $locale = LaravelLocalization::getCurrentLocale();
        $lang_name = Language::where('code', $locale)->first()->name;
        return view('mailstester.latest-tests')->with('lang_locale', $locale)->with('lang_name', $lang_name);
    }

    
    // show terms-of-service page 
    public function terms_of_service()
    {
        
        $title = translate('Home Page Title', 'seo');
        $description = translate('Home Page Description', 'seo');
        $keyword = translate('Home Page keywords', 'seo');
        $canonical = url()->current();
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keyword);
        SEOMeta::setCanonical($canonical);
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setSiteName(Settings::selectSettings('name'));
        OpenGraph::addImage(asset(Settings::selectSettings('og_image')));
        OpenGraph::setUrl($canonical);
        OpenGraph::addProperty('type', 'article');

        $links = Menu::all();
        $locale = LaravelLocalization::getCurrentLocale();
        $lang_name = Language::where('code', $locale)->first()->name;
        return view('mailstester.terms-of-service')->with('lang_locale', $locale)->with('lang_name', $lang_name);
    }
    
    
    // show Iframe css page 
    public function design()
    {
        
        $title = translate('Home Page Title', 'seo');
        $description = translate('Home Page Description', 'seo');
        $keyword = translate('Home Page keywords', 'seo');
        $canonical = url()->current();
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keyword);
        SEOMeta::setCanonical($canonical);
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setSiteName(Settings::selectSettings('name'));
        OpenGraph::addImage(asset(Settings::selectSettings('og_image')));
        OpenGraph::setUrl($canonical);
        OpenGraph::addProperty('type', 'article');

        $links = Menu::all();
        $locale = LaravelLocalization::getCurrentLocale();
        $lang_name = Language::where('code', $locale)->first()->name;
        return view('mailstester.design')->with('lang_locale', $locale)->with('lang_name', $lang_name);
    }
    
    
    // show micro-payment page 
    public function micro_payment()
    {
        
        $title = translate('Home Page Title', 'seo');
        $description = translate('Home Page Description', 'seo');
        $keyword = translate('Home Page keywords', 'seo');
        $canonical = url()->current();
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keyword);
        SEOMeta::setCanonical($canonical);
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setSiteName(Settings::selectSettings('name'));
        OpenGraph::addImage(asset(Settings::selectSettings('og_image')));
        OpenGraph::setUrl($canonical);
        OpenGraph::addProperty('type', 'article');

        $links = Menu::all();
        $locale = LaravelLocalization::getCurrentLocale();
        $lang_name = Language::where('code', $locale)->first()->name;
        return view('mailstester.micro-payment')->with('lang_locale', $locale)->with('lang_name', $lang_name);
    }
    // show FAQ page 
    public function faq()
    {
        
        $title = translate('Home Page Title', 'seo');
        $description = translate('Home Page Description', 'seo');
        $keyword = translate('Home Page keywords', 'seo');
        $canonical = url()->current();
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keyword);
        SEOMeta::setCanonical($canonical);
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setSiteName(Settings::selectSettings('name'));
        OpenGraph::addImage(asset(Settings::selectSettings('og_image')));
        OpenGraph::setUrl($canonical);
        OpenGraph::addProperty('type', 'article');

        $links = Menu::all();
        $locale = LaravelLocalization::getCurrentLocale();
        $lang_name = Language::where('code', $locale)->first()->name;
        return view('frontend.faq')->with('lang_locale', $locale)->with('lang_name', $lang_name);
    }

    // show SPF guide page 
    public function spf($type=null)
    {
        //print($type); die;
        $title = translate('Home Page Title', 'seo');
        $description = translate('Home Page Description', 'seo');
        $keyword = translate('Home Page keywords', 'seo');
        $canonical = url()->current();
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keyword);
        SEOMeta::setCanonical($canonical);
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setSiteName(Settings::selectSettings('name'));
        OpenGraph::addImage(asset(Settings::selectSettings('og_image')));
        OpenGraph::setUrl($canonical);
        OpenGraph::addProperty('type', 'article');

        $links = Menu::all();
        $locale = LaravelLocalization::getCurrentLocale();
        $lang_name = Language::where('code', $locale)->first()->name;
        if($type!=null)
            return view('frontend.spf-'.$type)->with('lang_locale', $locale)->with('lang_name', $lang_name);
        else
            return view('frontend.spf')->with('lang_locale', $locale)->with('lang_name', $lang_name);
    }

    // show SPF-DKIM-CHECK page 
    public function dkim_check($type=null)
    {
        //print($type); die;
        $title = translate('Home Page Title', 'seo');
        $description = translate('Home Page Description', 'seo');
        $keyword = translate('Home Page keywords', 'seo');
        $canonical = url()->current();
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keyword);
        SEOMeta::setCanonical($canonical);
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setSiteName(Settings::selectSettings('name'));
        OpenGraph::addImage(asset(Settings::selectSettings('og_image')));
        OpenGraph::setUrl($canonical);
        OpenGraph::addProperty('type', 'article');

        $links = Menu::all();
        $locale = LaravelLocalization::getCurrentLocale();
        $lang_name = Language::where('code', $locale)->first()->name;
        return view('frontend.dkim-check')->with('lang_locale', $locale)->with('lang_name', $lang_name);
    }
}