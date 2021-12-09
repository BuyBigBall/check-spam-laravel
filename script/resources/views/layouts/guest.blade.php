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
  <!-- <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet"> -->

  <!-- owl carousel css -->
  <link href="{{ asset('assets/css/owl.carousel.min.css') }}" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

<!--  <link rel="stylesheet" href="{{ asset('assets/css/cookieconsent.min.css') }}"> -->

  @if(\App\Models\Language::where('code', $lang_locale)->first()->rtl == 1)
  <link rel="stylesheet" href="{{ asset('assets/css/rtl.css') }}">
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

  <link rel="stylesheet" href="{{ asset('assets/css/template.css?v1.0') }}">

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

  @yield('content')
  @yield('mailtesterjs')  
</body>

</html>