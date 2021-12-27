<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
			<div class="title">{{$subject}}</div>
            <div class="content">
				
                <div
                    class="w540_mr_css_attr"
                    style="font-family:sans-serif;font-size:14px;line-height:18px;background-color:#eeeeee;color:#61523a;text-align:center;"
                    width="540">
                    <span style="font-size:16px;">
                        <strong>Hello</strong>
                    </span>
                    <br/>
                    <br/>
                    @if( !empty($username) )
                    A username reminder has been requested for your Mail-Tester Manager account.

                    Your username is {{ $username }}.

                    To login to your account, select the link below.

                    <a href="{{ env('APP_URL') }}/login">{{ env('APP_URL') }}/login</a>

                    Thank you.                    
                    
                    @elseif( !empty($verify_code) )

                    A request has been made to reset your Mail-Analyzer Manager account password. To reset your password, you will need to submit this verification code to verify that the request was legitimate.

                    The verification code is {{ $verify_code }}

                    Select the URL below and proceed with resetting your password.

                    <a href="{{$a_links}}">$a_links</a>

                    Thank you.
                    &nbsp;
                    @elseif( !empty($password) )

                    Your password reset request has been accepted. 

                    The new password is {{ $password }}.

                    Please login for following url again : 
                    
                    <a href="{{ env('APP_URL') }}/login">{{ env('APP_URL') }}/login</a>

                    Thank you.
                    &nbsp;
                    @endif
                    
                    <p style="margin:0px;padding:0px;text-align:center;">
                        <br />
                        From Analyzer.com
                    </p>
                </div>
                
            </div>
        </div>
    </body>
</html>
