<?php if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        {!! SEOMeta::generate() !!}
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="{{asset($setdata['favicon'])}}"/>
        {!! OpenGraph::generate() !!} {!! Twitter::generate() !!}
        <link
            rel="alternate"
            hreflang="x-default"
            href="{{ Str::replace('/'. $lang_locale, '', url()->current()) }}"/>
        @foreach (\App\Models\Language::all() as $lang)
        <link
            rel="alternate"
            hreflang="{{$lang->code}}"
            href="{{ Str::replace('/'. $lang_locale .'/', '/'. $lang->code .'/', url()->current()) }}"/>
        @endforeach {!! $setdata['custom_tags'] !!}
        <!-- font awesome icons -->
        <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet">
        <!-- bootstrap css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- owl carousel css -->
        <link href="{{ asset('assets/css/owl.carousel.min.css') }}" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

        @if(\App\Models\Language::where('code', $lang_locale)->first()->rtl == 1)
        <link rel="stylesheet" href="{{ asset('assets/css/rtl.css') }}">
        @endif

        <!-- Custom -->
        @if (!empty($setdata['google_analytics_code']))
        <!-- Google Analytics -->
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                },
                i[r].l = 1 * new Date();
                a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m
                    .parentNode
                    .insertBefore(a, m)
            })(
                window,
                document,
                'script',
                'https://www.google-analytics.com/analytics.js',
                'ga'
            );

            ga('create', '{{$setdata[' google_analytics_code ']}}', 'auto');
            ga('send', 'pageview');
        </script>
        <!-- End Google Analytics -->
        @endif 
        
        @if (!empty($setdata['google_tag_manager']))
        <!-- Google Tag Manager -->
        <script>
            (function (w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({'gtm.start': new Date().getTime(), event: 'gtm.js'});
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != 'dataLayer'
                        ? '&l=' + l
                        : '';
                j.async = true;
                j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f
                    .parentNode
                    .insertBefore(j, f);
            })(
                window,
                document,
                'script',
                'dataLayer',
                '{{$setdata[' google_tag_manager ']}}'
            );
        </script>
        <!-- End Google Tag Manager -->
        @endif

        <!--SET DYNAMIC VARIABLE IN STYLE-->
        <style>
            :root {
                --main-color: {{$setdata['main_color']}};
                --color1: {{$setdata['secondary_color']}};
            }
        </style>

        <!-- Custom Code -->
        {!! $setdata['head_ad'] !!}

        <link href="/assets/css/frontend_default.css" rel="stylesheet" type="text/css">
        <link href="/assets/css/spamtest.css" rel="stylesheet" type="text/css">
        <link href="/assets/css/template.css" rel="stylesheet" type="text/css">
        <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

    </head>

    <body id="waiting-page">

        @if (!empty($setdata['google_tag_manager']))
        <!-- Google Tag Manager (noscript) -->
        <noscript>
            <iframe
                src="https://www.googletagmanager.com/ns.html?id={{$setdata['google_tag_manager']}}"
                height="0"
                width="0"
                style="display:none;visibility:hidden"></iframe>
        </noscript>
        <!-- End Google Tag Manager (noscript) -->
        @endif

        <!-- Preloader Start -->
        <div class="preloader">
            <span></span>
        </div>
        <!-- Preloader End -->

        <div id="header_container" style="width:100%">
            <div id="header_container2">
                <div class="row-fluid contentsize">
                    <div class="span7">

                        <div class="custom">
                            <div class="row-fluid">
                                <div class="span12">
                                    <a href="/"><img
                                        style="float: left; max-width: 300px;"
                                        src="/uploads/logo.png"
                                        alt="mailtester"></a><br>
                                    <h1>Manager</h1>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="span5">
                        <div class="header_login">

                            @if (!empty($userdata['user_login']))
                            <form action="{{ route('logout') }}" method="post" 
                                    id="login-form" class="form-vertical">
                                @csrf
                                <div class="login-greeting">
                                    {{ $userdata['user_login']['name'] }}
                                </div>
                                <div class="logout-button">
                                    <input type="submit" class="btn btn-primary" value="{{__('Log out')}}">
                                    <!-- <input type="hidden" name="option" value="com_users"> <input type="hidden"
                                    name="task" value="user.logout"> <input type="hidden" name="return"
                                    value="aW5kZXgucGhwP0l0ZW1pZD0xNjk="> <input type="hidden"
                                    name="45adedc08584ba24ea6f3e97d550bc4a" value="1"> -->
                                </div>
                            </form>
                            @endif

                            @if (empty($userdata['user_login']))
                            
                            <form
                                action="{{ route('login') }}"
                                method="post"
                                id="login-form"
                                class="form-inline">
                                @csrf
                                <div class="userdata">
                                    <div id="form-login-username" class="control-group">
                                        <div class="controls">
                                            <div class="input-prepend">
                                                <span class="add-on">
                                                    <span class="icon-user hasTooltip" title="" data-original-title="Username"></span>
                                                    <label for="email" class="element-invisible">Username</label>
                                                </span>
                                                <input
                                                    id="email"
                                                    type="text"
                                                    name="email"
                                                    class="input-small login-text"
                                                    tabindex="0"
                                                    size="18"
                                                    placeholder="Username">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="form-login-password" class="control-group">
                                        <div class="controls">
                                            <div class="input-prepend">
                                                <span class="add-on">
                                                    <span class="icon-lock hasTooltip" title="" data-original-title="Password"></span>
                                                    <label for="modlgn-passwd" class="element-invisible">Password
                                                    </label>
                                                </span>
                                                <input
                                                    id="modlgn-passwd"
                                                    type="password"
                                                    name="password"
                                                    class="input-small login-text"
                                                    tabindex="0"
                                                    size="18"
                                                    placeholder="Password">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="form-login-remember" class="control-group checkbox">
                                        <label for="modlgn-remember" class="control-label">Remember Me</label>
                                        <input
                                            id="modlgn-remember"
                                            type="checkbox"
                                            name="remember"
                                            class="inputbox"
                                            value="yes">
                                    </div>
                                    <div id="form-login-submit" class="control-group">
                                        <div class="controls">
                                            <button
                                                type="submit"
                                                tabindex="0"
                                                name="Submit"
                                                class="btn btn-primary login-button">Log in</button>
                                        </div>
                                    </div>
                                    <ul class="unstyled">
                                        <li>
                                            <a href="/register">
                                                Create an account
                                                <span class="icon-arrow-right"></span></a>
                                        </li>
                                        <li>
                                            <a href="/forget/name">
                                                Forgot your username?</a>
                                        </li>
                                        <li>
                                            <a href="/forget/pwd">
                                                Forgot your password?</a>
                                        </li>
                                    </ul>
                                    <!-- <input type="hidden" name="option" value="com_users">
                                    <input type="hidden" name="task" value="user.login">
                                    <input type="hidden" name="return" value="aW5kZXgucGhwP0l0ZW1pZD0xMTE=">
                                    <input type="hidden" name="2387cd0cd1462cbda6de0436ed1ff1c1" value="1"> -->
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('mailstester.menunav')
        
        <section>
            <div class='container'>
                @yield('content')
            </div>
        </section>


        <div id="footer" class="py-3">

            <div>
                <a href="/" target="_self">
                    <img src="/uploads/logo.png" alt="mail-tester" class="logo">
                </a>
            </div>

            @include('layouts.footermenu')
        </div>
        <!-- The end of footer -->

        <?php 
            $current_route = \Request::route()->getName(); 
            $autocomp = false;
            if($current_route == 'profile'){
                $params = request()->route()->parameters;
                if(!empty($params) && !empty($params['type']) && $params['type'] == 'address'){
                    $autocomp = true;
                }
            }
        ?>

        <!-- jquery js -->
        <!-- <script src="{{ asset('assets/js/vendor/jquery.min.js') }}"></script> -->
        @if($autocomp)
            <!-- for search location -->
            <script src="/assets/js/geocomplete/jquery.min.js"></script>
            <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAP_API_KEY')}}&sensor=false&libraries=places"></script>
            <script src="{{ asset('assets/js/geocomplete/jquery.geocomplete.min.js') }}"></script>
            <script>
            $(function () { 
                $("#address_street").geocomplete({
                  details: ".geo-details",
                  detailsAttribute: "data-geo"
                });

            });
            </script>
        @else 
            <script src="/assets/js/vendor/jquery.min.js"></script>
        @endif
        <!-- popper js -->
        <script src="{{ asset('assets/js/vendor/popper.min.js') }}"></script>
        <!-- bootstrap js -->
        <script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
        <!-- OWl Carousel -->
        <script src="{{ asset('assets/js/vendor/owl.carousel.min.js') }}"></script>
        <!-- Clipboard -->
        <script src="{{ asset('assets/js/vendor/clipboard.min.js') }}"></script>
        <!-- Progress Bar -->
        <script src="{{ asset('assets/js/vendor/progress.js') }}"></script>

        <script src="{{ asset('assets/js/vendor/jquery.nicescroll.min.js') }}"></script>

        <!--SET DYNAMIC VARIABLE IN SCRIPT-->
        <script>
            "use strict";
            var fetch_time = "{{$setdata['fetch_time']}}",
                url = "{{route('messages')}}",
                email_url = "{{route('email')}}",
                wait_url =  "{{route('check_email')}}",
                result_url =  "{{route('testresult')}}",
                color = "{{$setdata['secondary_color']}}",
                click_to_copy = "{{__('Click To Copy!')}}",
                copied = "{{__('Copied!')}}";
        </script>
        <!-- main js -->
        <script src="/assets/js/vendor/jquery.dataTables.min.js"></script>
        <script src="/assets/js/main.js?v1.1"></script>
        @yield('mailtesterjs')
        @yield('addressjs')
        @yield('register-script')        
		
		<!-- <script src="{{ asset('assets/js/cookieconsent.min.js') }}"></script> -->
    </body>
</html>