@extends('layouts.admin')

@section('content')
<style>
    .required
    {
        color:red;
    }
</style>
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('users.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>{{__('User Profile')}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard')}}">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item"><a href="{{ route('users.index')}}">{{__('Users')}}</a></div>
            <div class="breadcrumb-item">{{__('User Profile')}}</div>
        </div>
    </div>

    <div class="section-body">
       <form
            name="profile"
            method="post"
            action="{{ route('saveprofile') }}"
            enctype="multipart/form-data">
            @csrf
            <input type='hidden' name='user_id' value='{{$user_id}}' id='hUserId' />
<div class="form-group row mb-12" id="customer_details">
    <div class="col-sm-12 col-md-2"></div>
    <div class="col-sm-12 col-md-8">
        <div class="woocommerce-billing-fields">
            <div class="woocommerce-billing-fields__field-wrapper">
                <div class="form-group row mb-4">
                    <label
                        for='firstname'
                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                        {{ __('First name') }}
                        <span class='required'>*</span>
                        :</label>
                    <div class="col-sm-12 col-md-7">
                        <input
                            type="text"
                            id='firstname'
                            class="form-control "
                            name="firstname"
                            value="{{ $user_profile==null ? '' : $user_profile->firstname}}"
                            required=""
                            placeholder="First Name"/></div>
                </div>
                <div class="form-group row mb-4">
                    <label
                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                        for='lastname'>{{ __('Last name') }}
                        <span class='required'>*</span>
                        :</label>
                    <div class="col-sm-12 col-md-7">
                        <input
                            type="text"
                            id='lastname'
                            class="form-control "
                            name="lastname"
                            value="{{ $user_profile==null ? '' : $user_profile->lastname}}"
                            required=""
                            placeholder="Last Name"/></div>
                </div>
                <div class="form-group row mb-4">
                    <label
                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                        for='company'>{{ __('Company name') }}
                        :</label>
                    <div class="col-sm-12 col-md-7">
                        <input
                            type="text"
                            id='company'
                            class="form-control "
                            name="company"
                            value="{{ $user_profile==null ? '' : $user_profile->company}}"
                            placeholder="Company Name"/></div>
                </div>

                <div class="form-group row mb-4">
                    <label
                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                        for='country'>{{ __('Country / Region') }}
                        <span class='required'>*</span>
                        :</label>
                    <div class="col-sm-12 col-md-7">
                        <input
                            type="text"
                            id='country'
                            class="form-control "
                            name="country"
                            value="{{ $user_profile==null ? '' : $user_profile->country}}"
                            placeholder="Country"/></div>
                </div>

                <div class="form-group row mb-4">
                    <label
                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                        for='street'>{{ __('Street address') }}
                        <span class='required'>*</span>
                        :</label>
                    <div class="col-sm-12 col-md-7">
                        <input
                            type="text"
                            id='street'
                            class="form-control "
                            name="address"
                            value="{{ $user_profile==null ? '' : $user_profile->address}}"
                            placeholder="Street"/></div>
                </div>

                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for='city'>{{ __('City') }}
                        <span class='required'>*</span>
                        :</label>
                    <div class="col-sm-12 col-md-7">
                        <input
                            type="text"
                            id='city'
                            class="form-control "
                            name="city"
                            value="{{ $user_profile==null ? '' : $user_profile->city}}"
                            placeholder="City"/></div>
                </div>
                <div class="form-group row mb-4">
                    <label
                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                        for='state'>{{ __('State') }}
                        <span class='required'>*</span>
                        :</label>
                    <div class="col-sm-12 col-md-7">
                        <input
                            type="text"
                            id='state'
                            class="form-control "
                            name="state"
                            value="{{ $user_profile==null ? '' : $user_profile->state}}"
                            placeholder="State"/></div>
                </div>
                <div class="form-group row mb-4">
                    <label
                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                        for='email'>{{ __('Email Address') }}
                        <span class='required'>*</span>
                        :</label>
                    <div class="col-sm-12 col-md-7">
                        <input
                            type="email"
                            id='email'
                            class="form-control "
                            name="mail_addr"
                            value="{{ $user_profile==null ? '' : $user_profile->mail_addr}}"
                            placeholder="Email Address"/></div>
                </div>
                <div class="form-group row mb-4">
                    <label
                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                        for='phone'>{{ __('Phone Number') }}
                        <span class='required'>*</span>
                        :</label>
                    <div class="col-sm-12 col-md-7">
                        <input
                            type="text"
                            id='phone'
                            class="form-control "
                            name="telephone"
                            value="{{ $user_profile==null ? '' : $user_profile->telephone}}"
                            placeholder="Phone Number"/></div>
                </div>
                <div class="form-group row mb-4">
                    <label
                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                        for='postcode'>{{ __('Post Code') }}
                        <span class='required'>*</span>
                        :</label>
                    <div class="col-sm-12 col-md-7">
                        <input
                            type="text"
                            id='postcode'
                            class="form-control "
                            name="postcode"
                            value="{{ $user_profile==null ? '' : $user_profile->postcode}}"
                            placeholder="Post Code"/></div>
                </div>
                <div class="woocommerce-additional-fields" style='display:none;'>
                    <h3>Additional information</h3>

                    <div class="woocommerce-additional-fields__field-wrapper">
                        <p class="form-row notes" id="order_comments_field" data-priority="">
                            <label for="order_comments" class="">Order notes&nbsp;<span class="optional">(optional)</span>
                            </label>
                            <span class="woocommerce-input-wrapper">
                                <textarea
                                    name="order_comments"
                                    class="input-text "
                                    id="order_comments"
                                    placeholder="Notes about your order, e.g. special notes for delivery."
                                    rows="2"
                                    cols="5"
                                    style="margin: 0px -2px 0px 0px; height: 114px; width: 595px;"></textarea>
                            </span>
                        </p>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label
                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                        for='postcode'></label>
                    <div class="col-sm-12 col-md-4">
                        <button type="submit" id='btnSave' class="form-control byn btn-primary">
                            Register</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>      
            </form>



</div>
</section>
@endsection