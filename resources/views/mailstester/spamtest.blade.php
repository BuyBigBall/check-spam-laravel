@extends('mailstester.layout')

@section('content')
<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">

        <div id="system-message-container"></div>
        <div id="header" class="mh-25">

            <h1 class="title py-5 m-0 text-primary">Checking out the inbox of</h1>
            <div class="text-center">
                <span class="mailbox" style="border:#ddd solid 1px;">test-2x9vpi14q@srv1.mail-tester.com</span>
            </div>

            <div class="container py-5">
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
@endsection