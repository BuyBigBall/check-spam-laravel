@extends('layouts.guest')

@section('checkout_payment_js')
<link href="/assets/css/spamtest.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
	$(window).on("load", function () {
		$(".preloader").fadeOut("slow");
		$(".checkout-micropayment").css('background-color', 'rgb(69 142 211)');
		$('.productselection').on('click', function (evt) {
			$('.productselection').removeClass('selected');
			$(this).addClass('selected');
			$('#product_id').val($(this).attr('rel'));
		});		
	});
    var wait_url =  "{{route('check_email')}}";
    var result_url =  "{{route('testresult')}}";
    function check_validation()
    {
        if($('#product_id').val()=="") 
        {
            alert("please select a plan.");
            return false;
        }
        return true;
    }
	</script>
@endsection		


@section('content')
<section id="waiting-page" class="blog checkout-micropayment d-flex align-items-center">

<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">

        <div id="system-message-container"></div>
        <div id="header" class="mh-25">

            <h1 class="title py-5 m-0 text-primary">Checking out the inbox of</h1>
            <div class="text-center">
                <span class="mailbox" style="border:#ddd solid 1px;">{{ $email }}</span>
            </div>

            <div class="bar container py-5">
                <div class="subtitle text-center countdown my-3">0</div>
                <div class="progress">
                    <div
                        class="progress-bar"
                        role="progressbar"
                        aria-valuenow="0"
                        aria-valuemin="0"
                        aria-valuemax="100"
                        style="width: 0%;">
                        <div class="separator-inner" id="animatedboat"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</section>
<script>

    @if(       Session::has('could_not_use_by_paid_user') && 
        !empty(Session::get('could_not_use_by_paid_user')) )
        alert("{{ Session::get('could_not_use_by_paid_user') }}");
    @endif
    <?php session()->forget('could_not_use_by_paid_user'); ?>
</script>

@if( !empty($css))
    <style>
        {{ $css }}
    </style>
@endif

@endsection

@section('mailtesterjs')
<script type="text/javascript" >
    // var WEBSOCKET_PROTOCAL = '{{env('WEBSOCKET_PROTOCAL')}}';
    // var WEBSOCKET_SERVER = '{{env('WEBSOCKET_SERVER')}}';
    // var WEBSOCKET_PORT = '{{env('WEBSOCKET_PORT')}}';
    var WAIT_TIMEOUT_SECONDS = '{{ env('WAIT_TIMEOUT_SECONDS') }}';
</script>
<script type="text/javascript" src="{{ asset('assets/js/mailstester.js?v1.2.0') }}"></script>
@endsection