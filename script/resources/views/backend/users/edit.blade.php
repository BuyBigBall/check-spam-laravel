@extends('layouts.admin')

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('users.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>{{translate('Edit User')}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard')}}">{{translate('Dashboard')}}</a></div>
            <div class="breadcrumb-item"><a href="{{ route('users.index')}}">{{translate('Users')}}</a></div>
            <div class="breadcrumb-item">{{translate('Edit User')}}</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">{{translate('Edit User')}}</h2>
        <p class="section-lead">
            {{translate('On this page you can edit user and fill in all fields.')}}
        </p>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{translate('Edit Your User')}}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.update' , $user->id) }}" method="POST">
                            @csrf
                            @method("PUT")
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{translate('User Name')}}
                                    :</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ $user->name }}" required placeholder="User Name">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{translate('User Email')}}
                                    :</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ $user->email }}" required placeholder="User Email">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{translate('User Password')}}
                                    :</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" value="" placeholder="User Password">
                                    @error('password')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{translate('Confirm Password')}}
                                    :</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="password" class="form-control @error('confirmpassword') is-invalid @enderror"
                                        name="confirmpassword" value="" placeholder="Confirm Password">
                                    @error('password')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{translate('Status')}}
                                    :</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control @error('status') is-invalid @enderror"
                                        name="status" required placeholder="Select Status">
                                        <option value='inactive' @if($user->mode=='inactive') selected @endif >inactive</option>
                                        <option value='active'   @if($user->mode=='active')   selected @endif >active</option>
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4" style='display:none;'>
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{translate('Slug')}} :</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                        name="slug" value="" placeholder="Slug">
                                    @error('slug')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button class="btn btn-primary">{{translate('Update')}}</button>
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