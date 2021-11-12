<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\Models\Settings;
use App\Models\Post;
use App\Models\Category;
use App\Models\Language;
use App\Models\Page;
use App\Models\Feature;
use App\Models\Menu;
use Illuminate\Support\Facades\Cookie;
use Config;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        
        if (env('HTTPS_FORCE')) {
            $this->app['request']->server->set('HTTPS', true);
        }

        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        if (env('SYSTEM_INSTALLED') != 0) {
        Config::set('laravellocalization.supportedLocales', getSupportedLocales());
        }

        
        /*
        // ONLY FOR TEST 
        if(\App::environment()=='local' && isset($_SERVER['HTTP_X_ORIGINAL_HOST'])){
            $this->app['url']->forceRootUrl($_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_X_ORIGINAL_HOST']);
        }
        
        */

        try {

            if (env('SYSTEM_INSTALLED') != 0) {

                view()->composer('*', function ($view) {
                    $setting = Settings::pluck('value', 'key')->all();
                    $view->with('setdata', $setting);
                });

                view()->composer('layouts.user', function ($view) {
                    $guard = null;
                    $userdata = [];
                    if (Auth::guard($guard)->check()) {
                        $role = Auth::user()->role; 
                        $userdata['user_login'] = Auth::user();
                    }


                    $links = Menu::all();
                    $locale = LaravelLocalization::getCurrentLocale();
                    $lang_name = Language::where('code', $locale)->first()->name;
                    $pages = Page::where("status", "=", 1)->get();
                    $view->with('pages', $pages)
                        ->with('lang_locale', $locale)
                        ->with('lang_name', $lang_name)
                        ->with('links', $links)
                        ->with('userdata', $userdata);

                });

                view()->composer('mailstester.layout', function ($view) {
                    
                    $guard = null;
                    $userdata = [];

                    $uri = $this->app['request']->path();
                    $curpage = explode('/', $uri);
                    $curpage = $curpage[count($curpage)-1];
                    $userdata['uri'] = $curpage;
                    
                    if (Auth::guard($guard)->check()) {
                        $role = Auth::user()->role; 
                        $userdata['user_login'] = Auth::user();
                    }
                    $links = Menu::all();
                    $locale = LaravelLocalization::getCurrentLocale();
                    $lang_name = Language::where('code', $locale)->first()->name;
                    $pages = Page::where("status", "=", 1)->get();

                    $view->with('pages', $pages)
                        ->with('lang_locale', $locale)
                        ->with('lang_name', $lang_name)
                        ->with('links', $links)
                        ->with('userdata', $userdata);

                });

                view()->composer('frontend.features', function ($view) {
                    $limit = Settings::selectSettings('popular_posts');
                    $posts = Post::where("status", "=", 1)->orderBy('views', 'DESC')->limit($limit)->get();
                    $features = Feature::where('lang', LaravelLocalization::getCurrentLocale())->get();
                    $view->with('popular_posts', $posts)->with("features", $features);
                });



                view()->composer('frontend.sidebar', function ($view) {
                    $posts = Post::where("status", "=", 1)->orderBy('views', 'DESC')->limit(4)->get();
                    $categories = Category::all();
                    $view->with('popular_posts', $posts)->with("categories", $categories);
                });


                {
                    // $title = translate('Home Page Title', 'seo');
                    // $description = translate('Home Page Description', 'seo');
                    // $keyword = translate('Home Page keywords', 'seo');
                    // $canonical = url()->current();
                    // SEOMeta::setTitle($title);
                    // SEOMeta::setDescription($description);
                    // SEOMeta::setKeywords($keyword);
                    // SEOMeta::setCanonical($canonical);
                    // OpenGraph::setTitle($title);
                    // OpenGraph::setDescription($description);
                    // OpenGraph::setSiteName(Settings::selectSettings('name'));
                    // OpenGraph::addImage(asset(Settings::selectSettings('og_image')));
                    // OpenGraph::setUrl($canonical);
                    // OpenGraph::addProperty('type', 'article');
            
                    // $locale = LaravelLocalization::getCurrentLocale();
                    // $lang_name = Language::where('code', $locale)->first()->name;
                    //view('mailstester.login')->with('lang_locale', $locale)->with('lang_name', $lang_name);
            
                }
            }
        } catch (\Exception $e) {
            return [];
        }
    }
}
