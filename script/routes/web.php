<?php

use Illuminate\Support\Facades\Route;
use App\Models\Settings;

Route::group(['middleware' => 'IsInstalled'], function () {
    Route::get('/install', function () {
        return redirect()->route('install/install');
    })->name('install');
    Route::get('/install/install', "Install\InstallController@index")->name('install/install');
    Route::get('/install/step1', "Install\InstallController@step1")->name('install/step1');
    Route::post('/install/step1/set_database', "Install\InstallController@set_database")->name('install/step1/set_database');
    Route::get('/install/step2', "Install\InstallController@step2")->name('install/step2');
    Route::post('/install/step2/import_database', "Install\InstallController@import_database")->name('install/step2/import_database');
    Route::get('/install/step3', "Install\InstallController@step3")->name('install/step3');
    Route::post('/install/step3/set_siteinfo', "Install\InstallController@set_siteinfo")->name('install/step3/set_siteinfo');
    Route::get('/install/step4', "Install\InstallController@step4")->name('install/step4');
    Route::post('/install/step4/set_admininfo', "Install\InstallController@set_admininfo")->name('install/step4/set_admininfo');
});




Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin', 'check.installation']], function () {

    Route::get('/update', 'DashboardController@update')->name("update");

    Route::get('/', function () {
        return redirect()->route('dashboard');
    })->name('admin');

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('/settings', 'DashboardController@settings')->name('settings');

    // General Settings
    Route::get('/settings/general', 'settings\GeneralController@index')->name('settings.general');
    Route::post('/settings/general/update', 'settings\GeneralController@update')->name('settings.general.update');
    Route::post('/settings/general/update2', 'settings\GeneralController@update2')->name('settings.general.update2');
    Route::post('/settings/check/imap', 'settings\GeneralController@check_imap')->name('check.imap');

    // Seo Settings
    Route::get('/settings/seo', 'settings\SeoController@index')->name('settings.seo');
    Route::post('/settings/seo/update', 'settings\SeoController@update')->name('settings.seo.update');

    // Ads Settings
    Route::get('/settings/ads', 'settings\AdsController@index')->name('settings.ads');
    Route::post('/settings/ads/update', 'settings\AdsController@update')->name('settings.ads.update');

    // Blog Setting 
    Route::get('/settings/blog', 'settings\BlogSettingController@index')->name('settings.blog');
    Route::post('/settings/blog/update', 'settings\BlogSettingController@update')->name('settings.blog.update');

    // languages
    Route::resource('/settings/languages', 'LanguageController');
    Route::post('/settings/languages/update_translation', 'LanguageController@update_translation')->name('languages.update_translation');
    Route::get('/settings/languages/{language}/seo', 'LanguageController@show_seo')->name('languages.show.seo');

    // SMTP Setting 
    Route::get('/settings/smtp', 'settings\SmtpController@index')->name('settings.smtp');
    Route::post('/settings/smtp/update', 'settings\SmtpController@update')->name('settings.smtp.update');
    
    // Profile Settings
    Route::get('/profile', 'settings\ProfileController@index')->name('profile');
    Route::post('/profile/info/update', 'settings\ProfileController@changeInfo')->name('settings.info.update');
    Route::post('/profile/password/update', 'settings\ProfileController@changePassword')->name('settings.password.update');

    Route::get('/posts/checkslug', 'PostController@checkSlug')->name('posts.checkslug');
    Route::get('/categories/checkslug', 'CategoryController@checkSlug')->name('categories.checkslug');
    Route::get('/pages/checkslug', 'PageController@checkSlug')->name('pages.checkslug');
    
    Route::post('ckeditor/image_upload', 'PageController@upload')->name('ckeditor.upload');


    Route::resource('/posts', "PostController");
    Route::resource('/categories', 'CategoryController');
    Route::resource('/pages', 'PageController');
    Route::resource('/features', 'FeatureController');
    Route::resource('/menu', 'MenuController');

    Route::get('/clear-cache', 'DashboardController@clear')->name('clear.cache');
});


Route::group(['middleware' => [ 'check.installation' ]], function(){

    Auth::routes(['register' => false]);

    Route::get('/delete', 'TrashMailController@delete')->name("delete");

    Route::get('/delete/{id}', 'TrashMailController@deletemessage')->name("delete.message");

    Route::post('/contact', 'ContactController@store')->name('contact.store');

    Route::post('/check_bot' , 'TrashMailController@check_bot')->name('check_bot');

    Route::post('/create', 'TrashMailController@create')->name("create");

    Route::get('/download/{id}/{file?}', 'TrashMailController@download');

});

if (env('VERSION_UPDATE') == 1.2) {
Route::group(['prefix' => LaravelLocalization::setLocale(),
'middleware' => ['localizationRedirect', 'localeCookieRedirect' , 'check.installation' ]], function(){

    if (env('SYSTEM_INSTALLED') != 0) {
        if (Settings::selectSettings('enable_blog')) {
    
            Route::get('/blog', 'BlogController@index')->name("blog");
    
            Route::get('/post/{slug}', 'PostController@show')->name("post");
    
            Route::get('/category/{slug}', 'CategoryController@show')->name("category");
        }
    }
	
    // routes/web.php
    Route::get('/fire', function () {
        event(new \App\Events\PostCreatedEvent());
        return 'ok';
    });
	Route::get('/curl_test', 'Mailstester\RegisterController@curl_test')->name("curl_test");
	
    
    Route::get('/not-received', 'Mailstester\SiteController@not_received')->name("not-received");
    Route::get('/dbug-example', 'Mailstester\SiteController@dbug_example')->name("dbug-example");
    Route::get('/', 'TrashMailController@index')->name("home");
    Route::get('/activate', 'Mailstester\RegisterController@active')->name("activate");
    Route::get('/index', 'TrashMailController@index')->name("index");
    Route::get('/messages', 'TrashMailController@messages')->name("messages");
    Route::get('/email', 'TrashMailController@temporaryEmailAddress')->name("email");
    Route::get('/check_email', 'Mailstester\EmailTestController@temporaryEmailCheck')->name("check_email");

    Route::get('/change', 'TrashMailController@change')->name("change");
    Route::get('/view/{id}', 'TrashMailController@show')->name("view");
    Route::get('/message/{id}', 'TrashMailController@message')->name("message");
    Route::get('/page/{slug}', 'PageController@show')->name("page");

    Route::get('/contact',              'ContactController@index')->name('contact');
    Route::get('/faq',                  'Mailstester\SiteController@faq')->name("faq");
    Route::get('/spf',                  'Mailstester\SiteController@spf')->name("spf");
    Route::get('/spf-detail/{type}',    'Mailstester\SiteController@spf')->name("spf-detail");
    Route::get('/spf-dkim-check',       'Mailstester\SiteController@dkim_check')->name("spf-dkim-check");

    Route::get('/spamtest',        'Mailstester\EmailTestController@index')->name("go_spamtest");
    Route::post('/spamtest',        'Mailstester\EmailTestController@index')->name("spamtest");
    Route::get('/signup',         'Mailstester\RegisterController@showRegistrationForm')->name("signup");
    Route::post('/save-register',   'Mailstester\RegisterController@save_register')->name("save-register");

    Route::get('/forgot/{type}',    'Auth\ForgotPasswordController@forgot')->name("forgot");
    // Route::post('/profile',         'Mailstester\LoginController@profile_view')->name("profile_view");
    // Route::post('/profile-save',    'Mailstester\LoginController@profile_save')->name("profile_save");

    # payment interface
    Route::get('/prices',           'Mailstester\SiteController@index')->name("prices");
    #payment url request
    Route::post('/buy_mail_test', 'Mailstester\SiteController@buy_mail_test')->name('buy_mail_test');
    #payment return url
    Route::get('/payment_status', 'Mailstester\SiteController@payment_status')->name('payment_status');

    Route::get('/json-api',         'Mailstester\SiteController@json_api')->name("json-api");

    Route::get('/latest-tests',     'Mailstester\SiteController@latest_tests')->name("latest-tests");
    Route::get('/design',           'Mailstester\SiteController@design')->name("design");
    Route::post('/design',           'Mailstester\SiteController@design')->name("design");
    Route::get('/micro-payment',    'Mailstester\SiteController@micro_payment')->name("micro-payment");
    Route::get('/terms-of-service', 'Mailstester\SiteController@terms_of_service')->name("terms-of-service");
    Route::get('/testresult',           'Mailstester\SpamTestController@TestResult')->name("testresult");
    Route::post('/testresult',           'Mailstester\SpamTestController@TestResult')->name("testresult");
    Route::get('/mail_body_html',       'Mailstester\SpamTestController@mail_body_html')->name("mail_body_html");
    Route::get('/mail_body_html_noimg', 'Mailstester\SpamTestController@mail_body_html_noimg')->name("mail_body_html_noimg");

    
    # --> never necessory call these, but for test using
    // Route::get('/login', 'Mailstester\LoginController@index')->name("login");
    // Route::post('/login', 'Mailstester\LoginController@loginchk')->name("loginchk");
    # <------------------
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/account',          'Mailstester\SiteController@account')->name("account");
        Route::get('/get-started',      'Mailstester\SiteController@started')->name("get-started");
        Route::post('/save-configure',        'Mailstester\SiteController@save_configure')->name("save-configure");
        Route::get('/payment/{price}', 'Mailstester\SiteController@checkout')->name("payment");

        Route::get('/checkout/{step}', 'Mailstester\SiteController@checkout_step')->name("checkout");
        Route::post('/checkout/{step}', 'Mailstester\SiteController@checkout_step')->name("checkout");

        Route::get('/profile/{type}',   'Mailstester\SiteController@profile')->name("profile");
        //Route::get('/address',          'Mailstester\SiteController@address')->name("address");
        Route::get('/order',            'Mailstester\SiteController@order')->name("order");
        Route::get('/orderdetail/{orderid}', 'Mailstester\SiteController@order_detail')->name("orderdetail");
        
        Route::get('/cart-type-cart',   'Mailstester\SiteController@cart_type_cart')->name("cart-type-cart");
        Route::get('/affiliate',        'Mailstester\SiteController@affiliate')->name("affiliate");
        Route::get('/check',            'Mailstester\SiteController@check')->name("check");

        Route::get('/design/wait/{site}',   'Mailstester\SiteController@design_wait')->name("design/wait");
        Route::get('/design/score/{site}',   'Mailstester\SiteController@design_score')->name("design/score");
        Route::get('/design/not-received/{site}',   'Mailstester\SiteController@design_not_received')->name("design/not-received");
        
        Route::get('/dbug-example',     'Mailstester\SiteController@dbug_example')->name("dbug-example");
        Route::get('/aaweb-pDrqwp',     'Mailstester\SiteController@aaweb_pdrqwp')->name("aaweb-pDrqwp");
        Route::post('/save-account',     'Mailstester\SiteController@save_account')->name("save-account");
        Route::post('/save-address',     'Mailstester\SiteController@save_address')->name("save-address");
        Route::get('/getmemInfo/{userid}',     'Mailstester\SiteController@ajax_getmemInfo')->name("getmemInfo");
        Route::post('/set-default-address',     'Mailstester\SiteController@set_default_address')->name("set-default-address");
	    Route::post('/get-address-detail',     'Mailstester\SiteController@get_address_detail')->name("get-address-detail");
        Route::post('/delete-address',     'Mailstester\SiteController@delete_address')->name("delete-address");
        
    });
});
}
