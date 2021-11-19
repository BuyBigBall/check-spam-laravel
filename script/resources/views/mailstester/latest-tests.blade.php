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
                action="{{ route('check') }}">
                Send your message to :
                <input
                    placeholder="{{$userdata['user_login']['name']}}-whateveryouwant{{ '@'.env('MAIL_HOST') }}"
                    type="text"
                    name="id"
                    value="{{ $email }}" />
                <button class="btn" style="margin-bottom:10px;" type="submit">Then access your result</button>
            </form>
        </div>

        <!-- LAST 20s -->
        <div id="last20" style="">
            <div class="oneresult">
            <h1>Latest Tests</h1>
            <hr/>
            <form name="search" method="post">
                <input
                    class="inputbox required"
                    placeholder="Search for a test..."
                    type="text"
                    name="search"
                    id="search"
                    title="Type here what you are looking for. It can be the subject of the email, the address mailed or the sender. Note that if you type a number the search will be done on the global mark."
                    style="width:85%"
                    value=""/>
                <input
                    class="btn btn-primary"
                    type="submit"
                    value="Search!"
                    style="margin-bottom:10px;"/>

                <input type="hidden" name="option" value="com_mtmanager"/>
                <input type="hidden" name="task" value=""/>
                <input type="hidden" name="ctrl" value="results"/></form>

                <table class="table table-hover table-striped table-results">
                    <thead>
                        <tr>
                            <th>Test Date</th>
                            <th>Subject</th>
                            <th>Source</th>
                            <th>Score</th>
                            <th>Sender</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <a href="{{ route('testresult', 'chakouri-RKSB') }}" target="_blank">2021-11-15 11:09:55</a>
                            </td>
                            <td>
                                <a href="{{ route('testresult', 'chakouri-RKSB') }}" class="underlined-link" target="_blank">spam - test</a>
                            </td>
                            <td>
                                <a href="{{ route('testresult', 'chakouri-RKSB') }}" target="_blank">chakouri - RKSB</a>
                            </td>
                            <td>
                                <a href="{{ route('testresult', 'chakouri-RKSB') }}" target="_blank">9.7</a>
                            </td>
                            <td>
                                <a href="{{ route('testresult', 'chakouri-RKSB') }}" target="_blank"></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection