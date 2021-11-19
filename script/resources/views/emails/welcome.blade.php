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
                        <strong>Hi {{ $name }},</strong>
                    </span>
                    <br/>
                    <br/>
                    Thank you for creating an account on our website.<br />
                    We need to verify that your email address is a valid one...<br />
                    Please click on the link below to confirm your account :<br />
                    &nbsp;
                    <p style="margin:0px;padding:0px;text-align:center;">
                        <br />
                        <a
                            href="{{$activate}}"
                            style="cursor:pointer;color:#ffffff;text-decoration:none;border:none;font-size:18px;padding:20px;background-color:#235480;"
                            target="_blank"
                            rel=" noopener noreferrer">Confirm your account</a>
                    </p>
                </div>
                <div
                    class="w540_mr_css_attr"
                    style="font-family:sans-serif;font-size:14px;line-height:18px;background-color:#eeeeee;color:#61523a;text-align:center;"
                    width="540">
                    <br/><br/>
                    As a reminder, here is the information you used to create an account on
                    {{ env('MAIL_HOST') }}/manager :<br/><br/>
                    Username : yasha<br/>
                    Email address:
                    <a href="/compose?To={{@email}}">{{ @email }}</a>
                </div>
                
            </div>
        </div>
    </body>
</html>
