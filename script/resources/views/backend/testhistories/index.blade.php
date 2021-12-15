@extends('layouts.admin')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>{{__('Test History')}}</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{route("dashboard")}}">{{__('Dashboard')}}</a></div>
      <div class="breadcrumb-item">{{__('Test History')}}</div>
    </div>
  </div>
  <div class="section-body">
    <!-- <h2 class="section-title">{{__('Test Historys')}}</h2> -->
    <div class="row mt-4">
      <div class="col-12">
        <div class="card">
          <!-- <div class="card-header">
            <h4>{{__('All Test Historys')}}</h4>
          </div> -->
          <div class="card-body">
            <div class="clearfix mb-3"></div>
            <div class="table-responsive">
              <table class="table table-striped" id="table-1">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>{{__('User')}}</th>
                    <th>{{__('Full Name')}}</th>
                    <th class="text-center">{{__('Subject')}}</th>
                    <th class="text-center">{{__('To')}}</th>
                    <th class="text-center">{{__('From')}}</th>
                    <th class="text-center">{{__('Score')}}</th>
                    <th class="text-center">{{__('Received')}}</th>
                    <th class="text-center">{{__('Tested')}}</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $num = 1; ?>
                  @foreach ($testhistories as $history)
                  <tr>
                    <td>{{$num++}}</td>
                    <td>
                        @if(!empty($history->user))
                        <a href="{{route('users.edit' , $history->user->id )}}">
                          {{$history->user->name}} <br />{{$history->user->email}}
                        </a>
                        @endif
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