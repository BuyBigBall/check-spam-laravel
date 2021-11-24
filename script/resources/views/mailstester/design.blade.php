@extends('mailstester.layout')

@section('content')
<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">

        <div id="system-message-container"></div>

        <form method="post" name="designForm" id="designForm" autocomplete="off">
            @csrf
            <fieldset class="adminform respuserinfogeneral">
                <h1>iFrame CSS Edition</h1>
                <hr/>
                <p>The following CSS code will be loaded automatically after our own CSS file
                    when your spam test is displayed. It enables you to customize or hide certain
                    part of the test and even change the whole design if you don't like it.</p>
                <p>
                    <b>Note :</b>
                    Editing CSS requires some knowledges and you better know what you do when you
                    customize something here!</p>
                <p>
                    <script>
                        let whitelabel = "#header {\n  background-image: none !important;\n  background-color: #f5f5f5 !" +
                                "important;\n  min-height: 0px !important;\n}\n#header h1.text-white {\n  color" +
                                ": #235480 !important;\n  text-shadow: 1px 1px 2px white;\n}\n#header .subtitle" +
                                ".text-white {\n  color: #235480 !important;\n  text-shadow: 1px 1px 2px white;" +
                                "\n}\n#header .countdown {\n  color: #fff;\n  background-color: #235480;\n  lin" +
                                "e-height: 2rem;\n  font-size: 20px;\n  line-height: 40px;\n  height: 40px;\n  " +
                                "width: 40px;\n  border-radius: 40px;\n  text-shadow: none;\n  margin: auto;\n " +
                                " text-align: center;\n}\n\n.py-5 {\n  padding-top: 2rem !important;\n  padding" +
                                "-bottom: 2rem !important;\n}\n\n.separator-inner {\n  display: none;\n}\n\n#fo" +
                                "oter {\n  display: none;\n}\n\n#reason_bcc, #reason_mailchimp, .back {\n  disp" +
                                "lay: none;\n}\n\n\/*# sourceMappingURL=whitelabel.css.map *\/\n";
                    </script>
                    <span
                        class="btn btn-primary"
                        onclick="jQuery('#newcss').val(jQuery('#newcss').val()+whitelabel);">Add CSS code to whitelabel mail-tester</span>
                </p>
                <div
                    class="respuserinfo respuserinfo50"
                    style="min-width:40%; margin-right:20px;">
                    <textarea
                        name="userCss"
                        id="newcss"
                        style="width:98%"
                        rows="20"
                        placeholder="Add your own CSS here that will be loaded on top of our upcoming stylesheet">{{$css}}</textarea>
                    <input class="btn btn-primary" type="submit" 
                        style="float:right;margin-right:1rem; margin-top:0.5rem;" value="Save"/>
                </div>
                <p>
                    You can test your custom CSS file :
                </p>
                <ul>
                    <li>
                        <a target="_blank" href='#' onclick="return WaitingPage(event)">Waiting</a>
                    </li>
                    <li>
                        <a target="_blank" href='#' onclick="return ScorePage(event)">Score</a>
                    </li>
                    <li>
                        <a
                            target="_blank" 
                            href="{{ route('not-received') }}">Not received</a>
                    </li>
                </ul>

            </fieldset>
        </form>
        <br/>
        <p>Our users usually want to remove our footer, the "previous results" area and
            the "share your test" area,<br/>in which case you should add the following CSS to the above stylesheet:
        </p>
        <pre>#footer,#oldresults,#share-me{display:none}</pre>
        <p></p>
        <div style='display:none;'> 
            <form id='displayform' method='post' target='_blank'>
                @csrf
                <input type='hidden' name='flag' value='whitelabel'>
                <textarea name='css' id='UseCss'></textarea>
            </form>
        </div>
    </div>
</div>
<script>
    function WaitingPage(e)
    {
        e.preventDefault();
        $('#UseCss').html( $('newcss').html() );
        $('#displayform').attr('action', "{{ 'spamtest' }}" );
        $('#displayform').submit();
        return false;
    }
    function ScorePage(e){
        e.preventDefault();
        $('#UseCss').html( $('newcss').html() );
        $('#displayform').attr('action', "{{ 'testresult' }}" );
        $('#displayform').submit();
        return false;
    }
</script>
@endsection