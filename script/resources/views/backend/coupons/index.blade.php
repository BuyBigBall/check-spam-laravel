@extends('layouts.admin')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>{{__('Coupons')}}</h1>
    <div class="section-header-button">
      <button type="button" class="btn btn-primary" id="add_coupon">
        {{__('Add New')}}
      </button>
    </div>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{route("dashboard")}}">{{__('Dashboard')}}</a></div>
      <div class="breadcrumb-item">{{__('Coupons')}}</div>
    </div>
  </div>
  <div class="section-body">
    <h2 class="section-title">{{__('Coupons')}}</h2>
    <p class="section-lead">
      {{__('You can manage all coupons, such as editing, deleting and more.')}}
    </p>
    <div class="row mt-4">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>{{__('All Coupons')}}</h4>
          </div>
          <div class="card-body">
            <div class="clearfix mb-3"></div>
            <div class="table-responsive">
              <table class="table table-striped" id="table-1">
                <thead>
                  <tr>
                    <th>#</th>
                    <th class="text-center">{{__('Coupon Code')}}</th>
                    <th class="text-center">{{__('Amount')}}</th>
                    <th class="text-center">{{__('Expiry Date')}}</th>
                    <th class="text-center">{{__('Status')}}</th>
                    <th>{{__('User Name')}}</th>
                    <th class="text-center">{{__('Created At')}}</th>
                    <th class="text-center">{{__('Action')}}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($coupons as $coupon)
                  <tr>
                    <td>{{$coupon->id}}</td>
                    <td class="text-center">{{$coupon->coupon_code}}</td>
                    <td class="text-center">{{$coupon->coupon_amt}} {{ !empty($coupon->coupon_type) ? '€' : '%' }}</td>
                    <td class="text-center">{{ToDate($coupon->expiry_date)}}</td>
                    <td class="text-center">{{$coupon->state==0?'Unused':'Used'}}</td>
                    <td>
                      @if(!empty($coupon->user))
                        <a href="{{route('users.edit', $coupon->user->id)}}">
                        {{$coupon->user->name}}
                        </a>
                      @endif
                    </td>
                    <td class="text-center">{{ToDate($coupon->created_at)}}</td>
                    <td class="text-center">
                      <a href="{{route('coupons.edit' ,$coupon->id )}}"
                        class="btn btn-primary bg_primary btn-sm"><i class="fa fa-edit"></i></a>
                      <button class="btn btn-danger bg_danger btn-sm confirm" id="{{$coupon->id}}">
                        <i class="fa fa-trash"></i>
                      </button>
                      <form id="delete{{$coupon->id}}" action="{{route('coupons.destroy' ,$coupon->id ) }}"
                        method="POST" class="d-none">
                        @csrf
                        @method("DELETE")
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal -->
<div class="modal fade" id="CouponModal" tabindex="-1" role="dialog" aria-labelledby="CouponModal"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="CouponModalLabel">{{__('Create New Coupon')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{route('coupons.store')}}">
        <div class="modal-body">
          @csrf
          <div class="mb-3">
            <label class="form-label">{{ __('Coupon Code') }}</label>
            <input type="text" class="form-control @error('coupon_code') is-invalid @enderror" id="coupon_code" name="coupon_code"
              value="{{ old('coupon_code') }}" readonly="true" required placeholder="">
            @error('coupon_code')
            <div class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </div>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label">{{ __('Coupon method') }}</label>
            <select class="form-control"
                onchange="exchangelabel(this.value);"
                  name="coupon_type" required placeholder="{{__('select coupon method')}}">
                <option value='0' selected>{{__("percentage")}}</option>
                <option value='1'         >{{ __("fixed") }}   </option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label"><span id="method_label">{{ __('Coupon Amount') }}</span> 
              (<span id="method_unit">%</span>)</label>
            <input type="text" class="form-control @error('coupon_amt') is-invalid @enderror" id="coupon_amt" name="coupon_amt"
              value="{{ old('coupon_amt') }}" required placeholder="">
            @error('coupon_amt')
            <div class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </div>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label">{{ __('Expiry Date') }}</label>
            <input type="date" class="form-control @error('expiry_date') is-invalid @enderror" id="expiry_date" name="expiry_date"
              value="{{ old('expiry_date') }}" required placeholder="">
            @error('expiry_date')
            <div class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </div>
            @enderror
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
          <button type="submit" class="btn btn-primary">{{__('Add Coupon')}}</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection


@if ($errors->any())
@push('scripts')
  <script src="{{ asset('assets/js/vendor/open-modal.js') }}"></script>
@endpush
@endif


@push('styles')
<link href="{{ asset('assets/css/selectric.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/select.bootstrap4.min.css') }}" rel="stylesheet">
@endpush


@push('libraies')
<script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/select.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/jquery.selectric.min.js') }}"></script>
@endpush

@push('scripts')
<script src="{{ asset('assets/js/vendor/modules-datatables.js') }}"></script>

<!--SET DYNAMIC VARIABLE IN SCRIPT -->
<script>
function randomString(length) {
  var text = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  for(var i = 0; i < length; i++) {
    text += possible.charAt(Math.floor(Math.random() * possible.length));
  }
  return text;
}
function exchangelabel(value)
{
    $('#method_label').text( value-0>0 ? "{{ __('Coupon Amount :')}}" : "{{ __('Coupon rate :') }}");
    $('#method_unit').text(  value-0>0 ? "€" : "%");
}


$(document).ready(function(){
  $('#add_coupon').click(function(){
    var coupon = randomString(10);
    $('#coupon_code').val(coupon);
    $("#CouponModal").modal();
  });
});
</script>
@endpush