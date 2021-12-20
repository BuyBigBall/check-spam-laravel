@extends('layouts.admin')

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('coupons.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>{{__('Edit Coupon')}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard')}}">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item"><a href="{{ route('coupons.index')}}">{{__('Coupons')}}</a></div>
            <div class="breadcrumb-item">{{__('Edit Coupon')}}</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">{{__('Edit Coupon')}}</h2>
        <p class="section-lead">
            {{__('On this page you can edit coupon and fill in all fields.')}}
        </p>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{__('Edit Your Coupon')}}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('coupons.update' , $coupon->id) }}" method="POST">
                            @csrf
                            @method("PUT")
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Coupon Code')}}
                                    :</label>
                                <div class="col-sm-12 col-md-5">
                                    <input type="text" class="form-control @error('coupon_code') is-invalid @enderror"
                                        name="coupon_code" id="coupon_code" value="{{ $coupon->coupon_code }}" readonly="true" required placeholder="">
                                    @error('coupon_code')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-2" style="text-align: end;">
                                    <button class="btn btn-primary" id="generate_coupon">{{__('Generate Coupon')}}</button>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Coupon method :')}}
                                    </label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control"
                                        onchange="exchangelabel(this.value);"
                                        name="coupon_type" required placeholder="{{__('select coupon method')}}">
                                        <option value='0' @if($coupon->coupon_type=='0') selected @endif >{{__("percentage")}}</option>
                                        <option value='1' @if($coupon->coupon_type=='1') selected @endif >{{ __("fixed") }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" id='method_label'>
                                {{ !empty($coupon->coupon_type) ? __('Coupon Amount :') : __('Coupon rate :')}}</label>
                                <div class="col-sm-10 col-md-6">
                                    <input type="text" class="form-control @error('coupon_amt') is-invalid @enderror"
                                        name="coupon_amt" value="{{ $coupon->coupon_amt }}" required placeholder="">
                                    @error('coupon_amt')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-2 col-md-1 d-flex align-items-center">
                                    <span id='method_unit'>
                                    {{ !empty($coupon->coupon_type) ? '€' : '%'}}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Expiry Date')}}
                                    :</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="date" class="form-control @error('expiry_date') is-invalid @enderror"
                                        name="expiry_date" value="{{ $coupon->expiry_date }}" required placeholder="">
                                    @error('expiry_date')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Status')}}
                                    :</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control @error('state') is-invalid @enderror"
                                        name="state" required placeholder="Select Status">
                                        <option value='0' @if($coupon->state=='0') selected @endif >Unused</option>
                                        <option value='1'   @if($coupon->state=='1')   selected @endif >Used</option>
                                    </select>
                                    @error('state')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button class="btn btn-primary @if( !empty($coupon->state)) disabled @endif mx-2"  @if( !empty($coupon->state)) disabled @endif>{{__('Update')}}</button>
                                    <button class="btn btn-secondary mx-2" onclick="return cancelUpdate(event)">{{__('Cancel')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
function exchangelabel(value)
{
    $('#method_label').text( value-0>0 ? "{{ __('Coupon Amount :')}}" : "{{ __('Coupon rate :') }}");
    $('#method_unit').text(  value-0>0 ? "€" : "%");
}
function randomString(length) {
  var text = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  for(var i = 0; i < length; i++) {
    text += possible.charAt(Math.floor(Math.random() * possible.length));
  }
  return text;
}

function cancelUpdate(evt)
{
    evt.preventDefault();
    history.back(-1);
    return false;
}
$(document).ready(function(){
    $('#generate_coupon').click(function(e){
        e.preventDefault();
        var coupon = randomString(10);
        $('#coupon_code').val(coupon);
    });
});
</script>
@endpush