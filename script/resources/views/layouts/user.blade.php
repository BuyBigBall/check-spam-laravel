<?php if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start(); ?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', $lang_locale) }}">
<head>
  {!! SEOMeta::generate() !!}
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/png" href="{{asset($setdata['favicon'])}}" />
  {!! OpenGraph::generate() !!}
  {!! Twitter::generate() !!}
  <link rel="alternate" hreflang="x-default" href="{{ Str::replace('/'. $lang_locale, '', url()->current()) }}" />
  @foreach (\App\Models\Language::all() as $lang)
  @if(empty(request()->segment(2)))
  <link rel="alternate" hreflang="{{$lang->code}}" href="{{ Str::replace('/'. $lang_locale, '/'. $lang->code, url()->current()) }}" /> 
  @else
  <link rel="alternate" hreflang="{{$lang->code}}" href="{{ Str::replace('/'. $lang_locale .'/', '/'. $lang->code .'/', url()->current()) }}" /> 
  @endif
  @endforeach
  {!! $setdata['custom_tags'] !!}
  <!-- font awesome icons -->
  <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet">
  <!-- bootstrap css -->
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- owl carousel css -->
  <link href="{{ asset('assets/css/owl.carousel.min.css') }}" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

<!--  <link rel="stylesheet" href="{{ asset('assets/css/cookieconsent.min.css') }}"> -->

  @if(\App\Models\Language::where('code', $lang_locale)->first()->rtl == 1)
  <link rel="stylesheet" href="{{ asset('assets/css/rtl.css') }}">
  @endif
  
  @yield('test_result_css')
  @yield('checkout_payment_css')
  <!-- Custom  -->

@if (!empty($setdata['google_analytics_code']))
  <!-- Google Analytics -->
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  
  ga('create', '{{$setdata['google_analytics_code']}}', 'auto');
  ga('send', 'pageview');
  </script>
  <!-- End Google Analytics -->
@endif
@if (!empty($setdata['google_tag_manager']))
  <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','{{$setdata['google_tag_manager']}}');</script>
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

<?php /*
<script>
      window.addEventListener("load", function(){
        window.cookieconsent.initialise({
          "palette": {
            "popup": {
              "background": "#000"
            },
            "button": {
              "background": "#f1d600"
            }
          },
          "content": {
            "message": "We use cookies to personalise ads and to analyse our traffic.<br/>We also share information about your use of our site with our social media, advertising and analytics partners who may combine it with other information that you've provided to them or that they've collected from your use of their services.<br/><br/>We do not share tests performed on this platform with anyone."
          }
        })});
    </script>
    */ ?>

  <!-- jquery js -->
  <script src="{{ asset('assets/js/vendor/jquery.min.js') }}"></script>
  @yield('checkout_payment_js')
  
</head>

<body>

  @if (!empty($setdata['google_tag_manager']))
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{$setdata['google_tag_manager']}}"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  @endif

  <!-- Preloader Start -->
  <div class="preloader">
    <span></span>
  </div>
  <!-- Preloader End -->
  
  <!-- Navbar Start -->
  <nav class="navbar navbar-expand-lg">
    <div class="container lang_container">
      <!--  Show this only on mobile to medium screens  -->
      <a class="navbar-brand d-lg-none" href="{{route('home')}}"><img alt="{{$setdata['name']}}" class="logo_mobile"
          src="{{asset($setdata['site_logo'])}}"></a>
      <ul class="lang_ul d-lg-none">
      <button class="navbar-toggler lang_btn" type="button" data-toggle="collapse" data-target="#navbarToggle"
        aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
      </button>
      <li class="nav-item dropdown lang">
        <a class="lang_link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
         href="#"><img alt="{{ $lang_name }}" src="{{ asset('assets/flags/'.$lang_locale.'.png') }}"> <span>{{ $lang_name }}</span></a>
         <div class="lang_dropdown dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
          @foreach (\App\Models\Language::all() as $language)
              <a class="dropdown-item" rel="alternate" hreflang="{{ $language->code }}" href="{{ LaravelLocalization::getLocalizedURL($language->code, null, [], true) }}">
                <img alt="{{ $language->code }}" src="{{ asset('assets/flags/'.$language->code.'.png') }}" class="mr-2">
                <span class="language">{{ $language->name }}</span>
              </a>
          @endforeach
        </div>
      </li>
      </ul>
      <!--  Use flexbox utility classes to change how the child elements are justified  -->
      <div class="collapse navbar-collapse justify-content-between" id="navbarToggle">
        <!--   Show this only lg screens and up   -->
        <a class="navbar-brand d-none d-lg-block" href="{{route('home')}}"><img alt="{{$setdata['name']}}" class="logo"
            src="{{asset($setdata['site_logo'])}}"></a>
        
        <ul class="navbar-nav">
          @foreach ($links as $link)
            @if($link->postion == 0)
              <li class="nav-item">
                <a class="nav-link" @if($link->target) target="_blank"  rel="noreferrer" @endif  
                    href="{{$link->url}}">{!! $link->icon !!} {{ __($link->title) }}</a>
              </li>
            @endif
          @endforeach
          <li class="nav-item dropdown lang d_lang_none">
            <a class="lang_link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
             href="#"><img alt="{{$lang_locale}}" src="{{ asset('assets/flags/'.$lang_locale.'.png') }}"> <span>{{ $lang_name }}</span></a>
             <div class="lang_dropdown dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
              @foreach (\App\Models\Language::all() as $language)
              <a class="dropdown-item" rel="alternate" hreflang="{{ $language->code }}" href="{{ LaravelLocalization::getLocalizedURL($language->code, null, [], true) }}">
                <img alt="{{$language->code}}" src="{{ asset('assets/flags/'.$language->code.'.png') }}" class="mr-2">
                <span class="language">{{ $language->name }}</span>
              </a>
              @endforeach
            </div>
          </li>

        </ul>
      </div>
    </div>
  </nav>

  <!-- Navbar End -->

  @yield('content')


  <!-- Footer Start -->
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="nav">
            @foreach ($pages as $page)
            <a href="{{route('page', $page->slug )}}">{{$page->title}}</a>
            @endforeach
            @if ($setdata['enable_blog'])
            <a href="{{route('blog')}}">{{ __('Blog')}}</a>
            @endif
            <a href="{{route('contact', '#contactus')}}">{{ __('Contact Us')}}</a>

            @foreach ($links as $link)
              @if($link->postion)
                <a @if($link->target) target="_blank" rel="noreferrer" @endif  href="{{$link->url}}">{!! $link->icon !!} {{$link->title}}</a>
              @endif
            @endforeach

          </div>

          @include('layouts.footermenu')
          
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <p class="copyright-text">
            {!! __('Copyright')!!}
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer End -->

  @if(Cookie::has('count') && Cookie::get('count') >= 5)
  <!-- Modal -->
  <div class="modal fade" id="check_bot" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{__('Human Verification')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('check_bot') }}">
            @csrf
            <div class="form-group check_bot text-center">
                {!! NoCaptcha::renderJs() !!}
                {!! NoCaptcha::display() !!}
                @if ($errors->has('g-recaptcha-response'))
                    <span class="help-block">
                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-1 bg_main btn-block" tabindex="4">
                  {{__('Verify')}}
                </button>
            </div>
        </form>
        </div>
        
      </div>
    </div>
  </div>
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
    url = "{{route('messages')}}" ,
    email_url = "{{route('email')}}",
    wait_url =  "{{route('check_email')}}",
    result_url =  "{{route('testresult')}}",
    color = "{{$setdata['secondary_color']}}",
    click_to_copy = "{{__('Click To Copy!')}}",
    copied = "{{__('Copied!')}}" ;
  </script>

  <script src="/assets/js/vendor/jquery.dataTables.min.js"></script>
  <!-- main js -->
  <script src="/assets/js/main.js?v1.2.9"></script>

  @yield('testresultjs')

  <script src="/assets/js/cookieconsent.min.js"></script>
  
</body>

</html>