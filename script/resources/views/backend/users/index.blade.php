@extends('layouts.admin')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>{{__('Users')}}</h1>
    <div class="section-header-button">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#UserModal">
        {{__('Add New')}}
      </button>
    </div>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{route("dashboard")}}">{{__('Dashboard')}}</a></div>
      <div class="breadcrumb-item">{{__('Users')}}</div>
    </div>
  </div>
  <div class="section-body">
    <h2 class="section-title">{{__('Users')}}</h2>
    <p class="section-lead">
      {{__('You can manage all users, such as editing, deleting and more.')}}
    </p>
    <div class="row mt-4">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>{{__('All Users')}}</h4>
          </div>
          <div class="card-body">
            <div class="clearfix mb-3"></div>
            <div class="table-responsive">
              <table class="table table-striped" id="table-1">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Full Name')}}</th>
                    <th class="text-center">{{__('Total Tests')}}</th>
                    <th class="text-center">{{__('Total Charge')}}</th>
                    <th class="text-center">{{__('Total Supply')}}</th>
                    <th class="text-center">{{__('Remain Count')}}</th>
                    <th class="text-center">{{__('Created At')}}</th>
                    <th class="text-center">{{__('Action')}}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                  <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td><a href="{{route('users.profileedit' , $user->id )}}">{{!empty($user->fullname) ? $user->fullname : "___"}}</a></td>
                    <td class="text-center"><span class="badge badge-primary">{{$user->test_counts}}</span></td>
                    <td class="text-center"><span class="badge badge-secondary">{{$user->charge}}</span></td>
                    <td class="text-center"><span class="badge badge-secondary">{{$user->supply}}</span></td>
                    <td class="text-center"><span class="badge badge-primary">{{$user->remain}}</span></td>
                    <td class="text-center">{{ToDate($user->created_at)}}</td>
                    <td class="text-center">
                      <a href="{{route('users.edit' ,$user->id )}}"
                        class="btn btn-primary bg_primary btn-sm"><i class="fa fa-edit"></i></a>
                      <button class="btn btn-danger bg_danger btn-sm confirm" id="{{$user->id}}">
                        <i class="fa fa-trash"></i>
                      </button>
                      <form id="delete{{$user->id}}" action="{{route('users.destroy' ,$user->id ) }}"
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
<div class="modal fade" id="UserModal" tabindex="-1" role="dialog" aria-labelledby="UserModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="UserModalLabel">{{__('Create New User')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{route('users.store')}}">
        <div class="modal-body">
          @csrf
          <div class="mb-3">
            <label class="form-label">{{ __('Name') }}</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
              value="{{ old('name') }}" required placeholder="User Name">
            @error('name')
            <div class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </div>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label">{{ __('Slug') }}</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
              value="{{ old('slug') }}" required placeholder="Slug">
            @error('slug')
            <div class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </div>
            @enderror
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
          <button type="submit" class="btn btn-primary">{{__('Add User')}}</button>
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
<script type="text/javascript">
var checkslug = "{{route('login')}}";
</script>
@endpush