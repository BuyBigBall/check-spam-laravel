@extends('layouts.user')

@section('content')

@include('frontend.home')
<!-- Change Section Start -->
<section class="view section-padding view_rtl" id="changeaccount">
  <div class="container">
    <div class="row">
      <div class="col-md-2 col-sm-12 unvisible">
        {!!$setdata['left_ad']!!}
      </div>
      <div class="col-md-8 col-sm-12 mb-3">
        <div class="card mb-2">
          <div class="card-header">
            <div class="row">
              <div class="col-6">{{__('Change E-mail Address')}}</div>
            </div>
          </div>
          <div class="card-body">
            <div class="change_email">
              <p>
                {!! __('Change Description') !!}
              </p>
              <form action="{{route("create")}}" method="post" class="col-md-8 col-sm-12 align-items-center">
                @csrf
                <div class="form-group">
                  <input type="text" required name="name" class="form-control  @error('name') is-invalid @enderror"
                    placeholder="{{__('Enter Your Mail!')}}" value="{{old('name')}}">
                  @error('name')
                  <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                  </div>
                  @enderror
                </div>
                <div class="form-group">
                  <select class="form-control  @error('domain') is-invalid @enderror" required name="domain">
                    @foreach (explode(',', $setdata['domains']) as $domain)
                    <option value="{{$domain}}">{{$domain}}</option>
                    @endforeach
                  </select>
                  @error('domain')
                  <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                  </div>
                  @enderror
                </div>
                @if(Cookie::has('count') && Cookie::get('count') >= 5)
                  <button type="button" data-toggle="modal" data-target="#check_bot" class="btn btn-2">{{__('Change Email')}}</button>
                @else
                  <button type="submit" class="btn btn-2">{{__('Change Email')}}</button>
                @endif
                
                @if (session()->has('error'))
                <div class="invalid-feedback d_block">
                  <strong>{{session()->get('error')}}</strong>
                </div>
                @endif
              </form>
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
<!-- Change Section End -->

@include('frontend.features')

@endsection