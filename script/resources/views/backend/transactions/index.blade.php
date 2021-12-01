@extends('layouts.admin')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>{{translate('Transaction Report')}}</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{route("dashboard")}}">{{translate('Dashboard')}}</a></div>
      <div class="breadcrumb-item">{{translate('Transaction Report')}}</div>
    </div>
  </div>
  <div class="section-body">
    <!-- <h2 class="section-title">{{translate('Transactions')}}</h2> -->
    <div class="row mt-4">
      <div class="col-12">
        <div class="card">
          <!-- <div class="card-header">
            <h4>{{translate('All Transactions')}}</h4>
          </div> -->
          <div class="card-body">
            <div class="clearfix mb-3"></div>
            <div class="table-responsive">
              <table class="table table-striped" id="table-1">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>{{translate('Buyer')}}</th>
                    <th class="text-center">{{translate('Email')}}</th>
                    <th class="text-center">{{translate('Price Type')}}</th>
                    <th class="text-center">{{translate('Amount')}} (€)</th>
                    <th class="text-center">{{translate('Income')}} (€)</th>
                    <th class="text-center">{{translate('Payment Method')}}</th>
                    <th class="text-center">{{translate('Created At')}}</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $num = 1; ?>
                  @foreach ($transactions as $transaction)
                  <tr>
                    <td>{{$num++}}</td>
                    <td>
                      @if(!empty($transaction->buyer))
                        <a href="{{route('users.profileedit' , $transaction->user_id )}}">
                          {{$transaction->buyer->firstname.' '.$transaction->buyer->lastname}}
                        </a>
                      @endif
                    </td>
                    <td class="text-center">{{$transaction->trash_mail->email}}</td>
                    <td class="text-center">{{$transaction->price_type}}</td>
                    <td class="text-center">{{$transaction->amount}}</td>
                    <td class="text-center">{{$transaction->income}}</td>
                    <td class="text-center">{{$transaction->bank}}</td>
                    <td class="text-center">{{ToDate($transaction->created_at)}}</td>
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