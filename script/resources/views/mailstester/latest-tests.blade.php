@extends('mailstester.layout')

@section('content')
<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">

        <div id="system-message-container"></div>

        <div class='latest-tests'>
            <h1>Perform a new test</h1>
            <form
                method="POST"
                target="_blank"
                action="{{ route('spamtest') }}">
                @csrf
                Send your message to :
                <input
                    placeholder="{{$userdata['user_login']['name']}}.whateveryouwant{{ '@'.env('MAIL_HOST') }}"
                    type="text"
                    name="trsh_mail"
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
                @csrf
                <!-- <input
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
				-->
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
                        @if( empty($db_hist) || count($db_hist)==0 )
                        <tr>
                            <td colspan='20'>Cannot be found mail test histories.</td>
                        </tr>
                        @endif
                        
                        @foreach($db_hist as $test_result)
                        <?php $mail = explode('@',$test_result->receiver)[0]; ?>
                        <tr>
                            <td>
                                <a href="{{ route('testresult', 'mailbox='.$mail.'&mail_id='.$test_result->mail_id) }}" target="_blank">{{ date('d-m-Y H:i:s', strtotime($test_result->tested_at)) }}</a>
                            </td>
                            <td>
                                <a href="{{ route('testresult', 'mailbox='.$mail.'&mail_id='.$test_result->mail_id) }}" class="underlined-link" target="_blank">{{ $test_result->subject }}</a>
                            </td>
                            <td>
                                <a href="{{ route('testresult', 'mailbox='.$mail.'&mail_id='.$test_result->mail_id) }}" target="_blank">{{ $test_result->email }}</a>
                            </td>
                            <td>
                                <a href="{{ route('testresult', 'mailbox='.$mail.'&mail_id='.$test_result->mail_id) }}" target="_blank">{{ $test_result->score }}</a>
                            </td>
                            <td>
                                <a href="{{ route('testresult', 'mailbox='.$mail.'&mail_id='.$test_result->mail_id) }}" target="_blank">{{ $test_result->sender }}</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection