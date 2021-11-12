@extends('mailstester.layout')

@section('content')
<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">

        <div id="system-message-container"></div>

        <div class='latest-tests'>
            <h1>Perform a new test</h1>
            <form
                method="get"
                target="_blank"
                action="/check.php">
                Send your message to :
                <input
                    placeholder="chakouri-whateveryouwant@srv1.mail-tester.com"
                    type="text"
                    name="id"
                    value="{{ $email }}" />
                <button class="btn" style="margin-bottom:10px;" type="submit">Then access your result</button>
            </form>
        </div>

        <!-- LAST 20s -->

    </div>
</div>
@endsection