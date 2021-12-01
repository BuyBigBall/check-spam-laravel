@extends('layouts.user')

@section('content')

@include('frontend.home')
<!-- Page Section Start -->
<section class="view section-padding" id='pageview'>
  <div class="container">
    <div class="row">
      <div class="col-md-2 col-sm-12 unvisible">
        {!!$setdata['left_ad']!!}
      </div>
      <div class="col-md-8 col-sm-12 mb-3">
        <div class="card mb-2">
          <div class="card-header">
            <div class="row">
              <div class="col-6 text-left">{{$page->title}}</div>
            </div>
          </div>
          <div class="card-body">
            <div class="change_email">
              {!!$page->content!!}
            </div>
          </div>
        </div>
        <span class="hidden">
        {!!$setdata['bottom_ad']!!}
        </span>
      </div>
      <div class="col-md-2  col-sm-12 unvisible">
        {!!$setdata['right_ad']!!}
      </div>
    </div>
  </div>
</section>
<!-- Page Section End -->

@include('frontend.features')
@endsection