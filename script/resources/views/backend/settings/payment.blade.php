@extends('layouts.admin')

@section('content')
<section class="section">
  <div class="section-header">
    <div class="section-header-back">
      <a href="{{route('settings')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>{{___('Payment Control Settings')}}</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">{{___('Dashboard')}}</a></div>
      <div class="breadcrumb-item active"><a href="{{route('settings')}}">{{___('Settings')}}</a></div>
      <div class="breadcrumb-item">{{___('Payment Control')}}</div>
    </div>
  </div>

  <div class="section-body">
    <h2 class="section-title">{{___('All Payment Control Settings')}}</h2>
    <p class="section-lead">
      {{___('You can manage all payment API settings here')}}
    </p>

    <div id="output-status"></div>
    <div class="row">
      @include('layouts.setting')

      <div class="col-md-8">
        <form action="{{ route('settings.payment.update')}}" method="POST" autocomplete="off"
          enctype="multipart/form-data">
          <div class="card" id="settings-card">
            @csrf
            <div class="card-header">
              <h4>{{___('Payment Settings')}}</h4>
            </div>
            <div class="card-body">
              <div class="form-group row align-items-center" style='display:none;'>
                <label for="site-title" class="form-control-label col-sm-3 text-md-right">{{___('Micro Payment')}}</label>
                <div class="col-sm-6 col-md-9">
                  <label class="custom-switch ">
                    <input type="checkbox" class="custom-switch-input" 
                           name="use_micropay" value="true"
                      @if( (env('USE_MICROPAY')==true)) checked @endif>
                    <span class="custom-switch-indicator"></span>
                  </label>
                </div>
              </div>
              <div class="form-group row align-items-center">
                <label for="site-title" class="form-control-label col-sm-3 text-md-right">{{___('Free Test Count')}} :</label>
                <div class="col-sm-6 col-md-9">
                  <input type="number"  class="form-control @error('freetest_count') is-invalid @enderror"
                        name="freetest_count" value="{{env('MAX_FREETEST_COUNT')}}"
                        required>
                <div class="form-text text-muted">{{__('If This value is -1, then Users can test free unlimited.')}}</div>
                </div>
              </div>
              <div class="form-group row align-items-center">
                <label for="vat-fee" class="form-control-label col-sm-3 text-md-right">{{___('VAT FEE')}} :</label>
                <div class="col-sm-5 col-md-8">
                  <input type="number"  class="form-control @error('vat_fee') is-invalid @enderror"
                        name="vat_fee" value="{{env('VAT_FEE')}}"
                        required id='vat-fee'>
                </div>
                <label for="vat-fee" class="form-control-label col-sm-1 text-md-left">%</label>
              </div>
              <hr />
              
              <div class="form-group row align-items-center">
                <label for="site-title" class="form-control-label col-sm-3 text-md-right">{{___('Paypal Payment')}}</label>
                <div class="col-sm-6 col-md-9">
                  <label class="custom-switch ">
                    <input type="checkbox" id='use_paypal' class="custom-switch-input" 
                        name="use_paypal" value="true"
                      @if( (env('USE_PAYPAL')==true)) checked @endif>
                    <span class="custom-switch-indicator"></span>
                  </label>
                </div>
              </div>

              <div class="form-group row align-items-center paypal" style="display:@if( (env('USE_PAYPAL')==false)) none @endif">
                <label for="site-title" class="form-control-label col-sm-3 text-md-right">{{___('Paypal Mode')}}</label>
                <div class="col-sm-6 col-md-9">
                      <select class="form-control selectric" 
                          id='paypal_mode' name="paypal_mode">
                        <option value="sandbox" {{ env('PAYPAL_MODE') == 'sandbox' ? 'selected' : '' }}>{{___('SandBox')}}</option>
                        <option value="live"    {{ env('PAYPAL_MODE') == 'live' ?    'selected' : '' }}>{{___('Live PayPal')}}</option>
                      </select>
                    </div>
              </div>
              
              <div class="form-group row align-items-center paypal sandbox" style="display:@if( (env('USE_PAYPAL')==false) || env('PAYPAL_MODE') != 'sandbox' ) none @endif">
                <label for="site-title"
                  class="form-control-label col-sm-3 text-md-right">{{___('PAYPAL SANDBOX APPID')}}</label>
                <div class="col-sm-6 col-md-9">
                  <input type="text" 
                      name="sandbox_appid" value="{{env('PAYPAL_SANDBOX_APPID')}}"
                      class="form-control @error('PAYPAL_SANDBOX_APPID') is-invalid @enderror" 
                    >
                </div>
              </div>
              <div class="form-group row align-items-center paypal sandbox" style="display:@if( (env('USE_PAYPAL')==false) || env('PAYPAL_MODE') != 'sandbox') none @endif">
                <label for="site-title"
                  class="form-control-label col-sm-3 text-md-right">{{___('PAYPAL SANDBOX CLIENT_ID')}}</label>
                <div class="col-sm-6 col-md-9">
                  <input type="text" 
                      name="sandbox_clientid" value="{{env('PAYPAL_SANDBOX_CLIENT_ID')}}"
                      class="form-control @error('PAYPAL_SANDBOX_CLIENT_ID') is-invalid @enderror" 
                      >
                </div>
              </div>
              <div class="form-group row align-items-center paypal sandbox" style="display:@if( (env('USE_PAYPAL')==false) || env('PAYPAL_MODE') != 'sandbox') none @endif">
                <label for="site-title"
                  class="form-control-label col-sm-3 text-md-right">{{___('PAYPAL SANDBOX CLIENT SECRET')}}</label>
                <div class="col-sm-6 col-md-9">
                  <input type="text" 
                        name="sandbox_clientsecret" value="{{env('PAYPAL_SANDBOX_CLIENT_SECRET')}}"
                        class="form-control @error('PAYPAL_SANDBOX_CLIENT_SECRET') is-invalid @enderror" 
                    >
                </div>
              </div>


              
              <div class="form-group row align-items-center paypal live" style="display:@if( (env('USE_PAYPAL')==false) || env('PAYPAL_MODE') != 'live') none @endif">
                <label for="site-title"
                  class="form-control-label col-sm-3 text-md-right">{{___('PAYPAL LIVE APPID')}}</label>
                <div class="col-sm-6 col-md-9">
                  <input type="text" 
                        name="paypallive_appid" value="{{env('PAYPAL_LIVE_APPID')}}"
                        class="form-control @error('PAYPAL_LIVE_APPID') is-invalid @enderror" 
                      >
                </div>
              </div>
              <div class="form-group row align-items-center paypal live" style="display:@if( (env('USE_PAYPAL')==false) || env('PAYPAL_MODE') != 'live') none @endif">
                <label for="site-title"
                  class="form-control-label col-sm-3 text-md-right">{{___('PAYPAL LIVE CLIENT_ID')}}</label>
                <div class="col-sm-6 col-md-9">
                  <input type="text" 
                        name="paypallive_clientid" value="{{env('PAYPAL_LIVE_CLIENT_ID')}}"
                        class="form-control @error('PAYPAL_LIVE_CLIENT_ID') is-invalid @enderror" 
                    >
                </div>
              </div>
              <div class="form-group row align-items-center paypal live" style="display:@if( (env('USE_PAYPAL')==false) || env('PAYPAL_MODE') != 'live') none @endif">
                <label for="site-title"
                  class="form-control-label col-sm-3 text-md-right">{{___('PAYPAL LIVE CLIENT SECRET')}}</label>
                <div class="col-sm-6 col-md-9">
                  <input type="text" 
                        name="paypallive_clientsecret" value="{{env('PAYPAL_LIVE_CLIENT_SECRET')}}"
                        class="form-control @error('PAYPAL_LIVE_CLIENT_SECRET') is-invalid @enderror" 
                    >
                </div>
              </div>
              
              <div class="form-group row align-items-center">
                <label for="site-title" class="form-control-label col-sm-3 text-md-right">{{___('Stripe Payment')}}</label>
                <div class="col-sm-6 col-md-9">
                  <label class="custom-switch ">
                    <input type="checkbox" id='use_stripe' class="custom-switch-input" 
                        name="use_stripe" value="true" {{ env('USE_STRIPE') }}
                        @if( (env('USE_STRIPE')==true)) checked @endif >
                    <span class="custom-switch-indicator"></span>
                  </label>
                </div>
              </div>
              <div class="form-group row align-items-center stripe" style="display:@if( (env('USE_STRIPE')==false)) none @endif">
                <label for="site-title"
                  class="form-control-label col-sm-3 text-md-right">{{___('STRIPE KEY')}}</label>
                <div class="col-sm-6 col-md-9">
                  <input type="text" 
                        name="stripe_key" value="{{env('STRIPE_KEY')}}"
                        class="form-control @error('STRIPE_KEY') is-invalid @enderror" 
                    >
                </div>
              </div>
              <div class="form-group row align-items-center stripe" style="display:@if( (env('USE_STRIPE')==false)) none @endif">
                <label for="site-title"
                  class="form-control-label col-sm-3 text-md-right">{{___('STRIPE SECRET')}}</label>
                <div class="col-sm-6 col-md-9">
                  <input type="text" 
                        name="stripe_secret" value="{{env('STRIPE_SECRET')}}"
                        class="form-control @error('RECAPTCHA_SITE_KEY') is-invalid @enderror" 
                    >
                </div>
              </div>
            </div>
            <div class="card-footer bg-whitesmoke text-md-right">
              <!-- <button  class="btn btn-dark check_imap" type="button">{{___('Check IMAP Server')}}</button> -->
              <button class="btn btn-primary" type="submit">{{___('Save Changes')}}</button>
            </div>
          </div>
        </form>
        <div class="log">
          <pre id='log_info'></pre>
        </div>
      </div>
    </div>
    <!-- <hr>
    <div class="row">
      <div class="col-md-4"></div>
     
    </div> -->
  </div>
</section>
@endsection


@push('styles')
<link href="{{ asset('assets/css/bootstrap-tagsinput.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/selectric.css') }}" rel="stylesheet">
<!--SET DYNAMIC VARIABLE IN STYLE-->
@endpush

@push('libraies')
<script src="{{ asset('assets/js/vendor/jquery.uploadPreview.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/jquery.selectric.min.js') }}"></script>
@endpush

@push('scripts')
<!--SET DYNAMIC VARIABLE IN SCRIPT -->
<script>
  "use strict";
  var check_link = "{{ route('check.imap') }}";
  $('#paypal_mode').change( function() {
    $(".sandbox").css('display', $(this).val()=='sandbox' ? '' : 'none');
    $(".live.paypal").css('display', $(this).val()!='sandbox' ? '' : 'none');
  });
  
  $('#use_paypal').change( function() {
    $(".paypal").css('display',       $(this).prop('checked') ? '' : 'none');
    $(".sandbox").css('display',      $(this).prop('checked') && $("#paypal_mode").val()=='sandbox' ? '' : 'none');
    $(".live.paypal").css('display',  $(this).prop('checked') && $("#paypal_mode").val()!='sandbox' ? '' : 'none');
  });
  
  $('#use_stripe').change( function() {
    $(".stripe").css('display', $(this).prop('checked') ? '' : 'none');
  });
</script>
@endpush