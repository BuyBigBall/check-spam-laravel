@extends('layouts.admin')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>{{translate('Test History')}}</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{route("dashboard")}}">{{translate('Dashboard')}}</a></div>
      <div class="breadcrumb-item">{{translate('Test History')}}</div>
    </div>
  </div>
  <div class="section-body">
    <!-- <h2 class="section-title">{{translate('Test Historys')}}</h2> -->
    <div class="row mt-4">
      <div class="col-12">
        <div class="card">
          <!-- <div class="card-header">
            <h4>{{translate('All Test Historys')}}</h4>
          </div> -->
          <div class="card-body">
            <div class="clearfix mb-3"></div>
            <div class="table-responsive">
              <table class="table table-striped" id="table-1">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>{{translate('User')}}</th>
                    <th>{{translate('Full Name')}}</th>
                    <th class="text-center">{{translate('Subject')}}</th>
                    <th class="text-center">{{translate('To')}}</th>
                    <th class="text-center">{{translate('From')}}</th>
                    <th class="text-center">{{translate('Score')}}</th>
                    <th class="text-center">{{translate('Received')}}</th>
                    <th class="text-center">{{translate('Tested')}}</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $num = 1; ?>
                  @foreach ($testhistories as $history)
                  <tr>
                    <td>{{$num++}}</td>
                    <td>
                        <a href="{{route('users.edit' , $history->user->id )}}">
                          {{$history->user->name}} <br />{{$history->user->email}}
                        </a>
                    </td>
                    <td>
                      @if(!empty($history->user) && !empty($history->user->default))
                        <a href="{{route('users.profileedit' , $history->user->default->id )}}">
                          {{$history->user->default->firstname.' '.$history->user->default->lastname}}
                        </a>
                      @endif
                    </td>
                    <td class="text-center">
                      <?php $mail = explode('@',$history->receiver)[0]; ?>
                      <a href="{{ route('testresult', 'mailbox='.$mail.'&mail_id='.$history->mail_id) }}" >
                        {{$history->subject}}
                      </a>
                    </td>
                    
                    <td class="text-center">
                        {{$history->receiver}}
                    </td>
                    <td class="text-center">{{$history->sender}}</td>
                    <td class="text-center">{{$history->score}}</td>
                    <td class="text-center">{{ToDate($history->received_at)}}</td>
                    <td class="text-center">{{ToDate($history->tested_at)}}</td>
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
@endpush