@extends('layouts.user')

@section('title', translate('Homepage Title') . " | ")

@section('content')

@include('frontend.home')

<!-- Messages Section Start -->
<section class="messages section-padding" style='display:none;'>
  <div class="container">
    <div class="row">
      <div class="col-md-2 col-sm-12 unvisible">
        {!!$setdata['left_ad']!!}
      </div>
      <div class="col-md-8 col-sm-12 mb-3">
        <div class="card mb-3 mt-3">
          <div class="card-header">
            <div class="row">
              <div class="col-12 d_show">{{translate('INBOX')}}</div>
              <div class="col-4 d_hide">{{translate('Sender')}}</div>
              <div class="col-6 d_hide">{{translate('Subject')}}</div>
              <div class="col-2 text-right d_hide">{{translate('View')}}</div>
            </div>
          </div>
          <div class="card-body" >
            <div class="mailbox-empty">
              <i class="fas fa-sync-alt fa-spin"></i>
              <h3>{{translate('Your inbox is empty')}}</h3>
              <p>{{translate('Waiting for incoming emails')}}</p>
            </div>
            <div id="mailbox"></div>
          </div>
        </div>
        <span class="hidden">
        {!!$setdata['bottom_ad']!!}
        <span>
      </div>
      <div class="col-md-2  col-sm-12 unvisible">
        {!!$setdata['right_ad']!!}
      </div>
    </div>
  </div>
</section>
<!-- Messages Section End -->

@include('frontend.features')
@endsection