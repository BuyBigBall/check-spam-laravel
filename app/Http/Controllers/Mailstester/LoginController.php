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


class LoginController extends Controller
{

    // show login page 
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
        return view('mailstester.login')->with('lang_locale', $locale)->with('lang_name', $lang_name);
    }

    // check login validation and show login page 
    public function loginchk()
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


        //print_r($_REQUEST); die;
        $links = Menu::all();
        $locale = LaravelLocalization::getCurrentLocale();
        $lang_name = Language::where('code', $locale)->first()->name;
        return view('mailstester.login')->with('lang_locale', $locale)->with('lang_name', $lang_name);
    }

    // check profile validation and save profile
    public function profile_view()
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


        //print_r($_REQUEST); die;
        $links = Menu::all();
        $locale = LaravelLocalization::getCurrentLocale();
        $lang_name = Language::where('code', $locale)->first()->name;
        return view('mailstester.login')->with('lang_locale', $locale)->with('lang_name', $lang_name);
    }

    // check profile validation and save profile
    public function profile_save()
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


        //print_r($_REQUEST); die;
        $links = Menu::all();
        $locale = LaravelLocalization::getCurrentLocale();
        $lang_name = Language::where('code', $locale)->first()->name;
        return view('mailstester.login')->with('lang_locale', $locale)->with('lang_name', $lang_name);
    }

    // view register page
    public function register()
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


        //print_r($_REQUEST); die;
        $links = Menu::all();
        $locale = LaravelLocalization::getCurrentLocale();
        $lang_name = Language::where('code', $locale)->first()->name;
        return view('mailstester.register')->with('lang_locale', $locale)->with('lang_name', $lang_name);
    }    

    // view register page
    public function forgot($type)
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


        //print_r($_REQUEST); die;
        $links = Menu::all();
        $locale = LaravelLocalization::getCurrentLocale();
        $lang_name = Language::where('code', $locale)->first()->name;

        if($type=='pwd')
            return view('mailstester.forgotpwd')->with('lang_locale', $locale)->with('lang_name', $lang_name);
        else
            return view('mailstester.forgotname')->with('lang_locale', $locale)->with('lang_name', $lang_name);
    }        
}