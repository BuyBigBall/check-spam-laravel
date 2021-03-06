@extends('mailstester.layout')

@section('content')
<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">

        <div id="system-message-container"></div>

        <style type="text/css">
            .myButton {

                -moz-box-shadow: inset 0 1px 0 0 #a4e271;
                -webkit-box-shadow: inset 0 1px 0 0 #a4e271;
                box-shadow: inset 0 1px 0 0 #a4e271;

                background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #89c403), color-stop(1, #77a809));
                background: -moz-linear-gradient(top, #89c403 5%, #77a809 100%);
                background: -webkit-linear-gradient(top, #89c403 5%, #77a809 100%);
                background: -o-linear-gradient(top, #89c403 5%, #77a809 100%);
                background: -ms-linear-gradient(top, #89c403 5%, #77a809 100%);
                background: linear-gradient(to bottom, #89c403 5%, #77a809 100%);
                filter:progid:DXImageTransform.Microsoft.gradient(startColorstr= '#89c403', endColorstr='#77a809',GradientType=0)) background-color: #89c403;

                -moz-border-radius: 6px;
                -webkit-border-radius: 6px;
                border-radius: 6px;

                border: 1px solid #74b807;

                display: inline-block;
                color: #ffffff;
                font-family: arial;
                font-size: 15px;
                font-weight: bold;
                padding: 6px 24px;
                text-decoration: none;

                text-shadow: 0 1px 0 #528009;

            }
            .myButton:hover {

                background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #77a809), color-stop(1, #89c403));
                background: -moz-linear-gradient(top, #77a809 5%, #89c403 100%);
                background: -webkit-linear-gradient(top, #77a809 5%, #89c403 100%);
                background: -o-linear-gradient(top, #77a809 5%, #89c403 100%);
                background: -ms-linear-gradient(top, #77a809 5%, #89c403 100%);
                background: linear-gradient(to bottom, #77a809 5%, #89c403 100%);
                filter:progid:DXImageTransform.Microsoft.gradient(startColorstr= '#77a809', endColorstr='#89c403',GradientType=0)) background-color: #77a809;
            }
            .myButton:active {
                position: relative;
                top: 1px;
            }
        </style>

        <!-- GLOBAL INFROMATIONS -->
        <h2>{{ $userdata['user_login']['name']}}</h2>
        <hr/>
        <h3>How to test your emails?</h3>
        <div class="answer">
            <p>To test your emails:
                <br/>
                1/ Send them to
                <b>
                    <span class="testingEmail">{{ $prefix = substr($email, 0, strrpos($email, '@')) }}</span>{{'@'. ($request=Request::capture())->gethttphost() }}
                </b>
            </p>
            <ul>
                <li>
                    <b>{{ $userdata['user_login']['name'] }}</b>
                    : This is your own username so all tests are assigned to your account properly.</li>
                <li>
                    <b>clientID</b>
                    : Unique ID of your client.<br/>
                    This parameter enables us to identify each of your users so the "previous
                    results" area will display tests performed by this user only.</li>
                <li>
                    <b>currenttimestamp</b>
                    : Current timestamp (time() in php for example) to make sure each test is
                    unique.</li>
            </ul>

            <p>2/ Then you can:</p>
            <ul>
                <li>display the iframe {{ (Request::root())  }}<span class="testingEmail">/{{$userdata['user_login']['name']}}-clientID-currenttimestamp</span>
                    and customize it with
                    <a href="{{ route('design') }}">your own CSS code</a>
                </li>
                <li>
                    or
                    <a href="{{ route('json-api' )}}">use our JSON API</a>
                    to display the result the way you want in your app</li>
            </ul>
        </div>
        <h3>How to white-label mail-tester?</h3>
        <div class="answer">
            That means you will be able to send emails to your own domain and get the result
            via an url from your own domain as well.
            <br/>This option is only available if you purchased at least our
            <b>1000 credits</b>
            pack.
            <br/><br/>
            To white-label our mail server, you should :
            <ul>
                <li>
                    Create a
                    <b>MX</b>
                    record (with priority 1) on your DNS from the sub-domain you want to :
                    <b>reception.{{ ($request=Request::capture())->gethttphost() }}.</b><br/>
                    (for example
                    <i>mt.YOUR-DOMAIN.com IN MX 1 reception.{{ ($request=Request::capture())->gethttphost() }}.</i>)
                    <br/>So then you will be able to send emails to
                    <span class="testingEmail">{{ $userdata['user_login']['name'] }}-clientID-currenttimestamp</span>@mt.YOUR-DOMAIN.com .
                </li>
                <li>
                    <a target="_blank" href="{{ route('contact', '#contactus') }}">Contact us</a>
                    so we can add your sub-domain to our mail server.
                </li>
            </ul>
            <br/>
            To white-label the result, you should :
            <ul>
                <li>
                    Create a
                    <b>CNAME</b>
                    record on your DNS from the sub-domain you want to :
                    <b>{{ ($request=Request::capture())->gethttphost() }}.</b><br/>
                    (for example
                    <i>result.YOUR-DOMAIN.com IN CNAME {{ ($request=Request::capture())->gethttphost() }}.</i>)
                    <br/>So then you will be able to access the result from
                        https://result.YOUR-DOMAIN.com/<span class="testingEmail">{{ $userdata['user_login']['name'] }}-clientID-currenttimestamp</span>
                </li>
                <li>
                    <a target="_blank" href="{{ route('contact', '#contactus') }}">Contact us</a>
                    so we can add your sub-domain to our SSL certificate.
                </li>
            </ul>
        </div>
        <h3>Configure your account</h3>
        <div class="answer">
            <form
                id="tester-configure"
                method="post"
                autocomplete="off"
                action="{{ route('save-configure') }}">
                @csrf
                <h4>Secure your account</h4>
                <p>To make sure you are the only one able to access your results, you can add
                    one of the following security checks:</p>
                <ul>
                    <li>Add this private key to the testing email addresses:
                        <input
                            id="pkey"
                            type="text"
                            style="width:100px;"
                            value="{{ $conf['pkey'] }}"
                            name="pkey"/><br/>
                        So your tests should be sent to
                        <b>
                            <span class="testingEmail">{{ $userdata['user_login']['name'] }}-clientID-currenttimestamp</span>{{ '@'.($request=Request::capture())->gethttphost() }}</b>
                    </li>
                    <li>Only accept tests sent from the following mail server IPs (separate your IPs
                        with a comma):<br/>
                        <input
                            type="text"
                            style="width:100%"
                            value="{{ $conf['serverip'] }}"
                            name="serverip"
                            placeholder="Leave this field empty to accept all mail server IPs"/>
                    </li>
                    <li>Load the result page (for a new test) only when loaded from one of the
                        following client IP (separate your IPs with a comma):<br/>
                        <input
                            type="text"
                            style="width:100%"
                            value="{{ $conf['clientip'] }}"
                            name="clientip"
                            placeholder="Leave this field empty to accept all client IPs"/>
                    </li>
                    <li>Only accept tests containing the following X-MT-Token header:<br/>
                        <input
                            type="text"
                            style="width:100%"
                            value="{{ $conf['mttoken'] }}"
                            name="mttoken"
                            placeholder="Leave this field empty to accept all X-MT-Token headers"/>
                    </li>
                </ul>
                <h4>Micro-payment system</h4>
                <p>
                    If you turn ON the micro-payment mode, mail-tester will display a payment page
                    to the user and the user will be able to access his test only after paying a
                    small fee.<br/>
                    You will receive a commission of
                    <b>{{ env('MICROPAY_PROFIT') }}%</b>
                    of the amount spent by your users (excluded VAT).<br/>
                    Micro-payment mode :
                    <select
                        id="micropayment"
                        name="micropayment"
                        size="1"
                        onchange='changemicropay(event, this);'
                        style="width:auto;">
                        <option value="0" @if( $conf['micropayment']==0 ) selected @endif >Disabled - your users can see their result for free</option>
                        <option value="1" @if( $conf['micropayment']==1 ) selected @endif >Enabled - your users will have to pay a small fee to see their result</option>
                    </select>
                </p>
                <div id="micropaymentpacks"     
                    @if( $conf['micropayment']!=1 ) 
                        style="display:none"
                    @endif
                        >
                    Please select two or three offers you want to propose to your users:
                    <ul>
                        @foreach(App\Http\Controllers\Mailstester\PaymentController::$micropay_plans as $key=>$micropay_plan)
                        <li>
                            <label for="product_{{$key}}">
                                <input
                                    id="product_{{$key}}"
                                    type="checkbox"
                                    class="selectedproducts"
                                    name='pay_type[]'
                                    @if(in_array($key, $conf["pay_type_ids"]))
                                        checked="checked"
                                    @endif
                                    value="{{$key}}"/>
                                {{ $micropay_plan['amount'] }} {{$micropay_plan['unit']}} : {{$micropay_plan['description']}}</label>
                        </li>
                        @endforeach
                    </ul>
                    Do you want to propose another deal to your users?
                    <a href="mailto:contact@mail-tester.org">Get in touch!</a>
                </div>
                <input type="submit" value="Save" class="btn"/>
                <input type="hidden" name="task" value="save"/>
                <input type="hidden" name="option" value="com_mtmanager"/>
            </form>
        </div>
        <h3>Some statistics...</h3>
        <div class="answer">
            <!-- GRAPHS -->
            <div id="stats">
                <div style="width: 100%; margin:auto; text-align:center;">
                    <input
                        class="btn btn-primary  "
                        type="button"
                        name="interval"
                        style="margin:15px;"
                        onclick="window.location = '?interval=day' "
                        value="day"
                        id="day" />
                    <input
                        class="btn btn-primary active "
                        type="button"
                        name="interval"
                        style="margin:15px;"
                        onclick="window.location = '?interval=month' "
                        value="month"
                        id="month"/>
                    <input
                        class="btn btn-primary  "
                        type="button"
                        name="interval"
                        style="margin:15px;"
                        onclick="window.location = '?interval=year' "
                        value="year"
                        id="year"/><br/>
                </div>
                <div id="chart_div" style="width: 100%; height: 600px;">
                    <div
                        id="google-visualization-errors-all-1"
                        style="display: block; padding-top: 2px;">
                        <div
                            id="google-visualization-errors-0"
                            style="font: 0.8em arial, sans-serif; margin-bottom: 5px;">
                            <span style="background-color: rgb(192, 0, 0); color: white; padding: 2px;">Not enough columns given to draw the requested chart.<span
                                style="font-size: 1.1em; font-weight: bold; cursor: pointer; padding-left: 10px; color: black; text-align: right; vertical-align: top;">??</span>
                            </span>
                        </div>
                    </div>
                    <div style="position: relative;">
                        <div dir="ltr" style="position: relative; width: 924px; height: 600px;">
                            <div
                                style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;"></div>
                        </div>
                        <div
                            aria-hidden="true"
                            style="display: none; position: absolute; top: 610px; left: 934px; white-space: nowrap; font-family: Arial; font-size: 8px;">-._.-*^*-._.-*^*-._.-</div>
                        <div></div>
                    </div>
                </div>
                <div style="clear:both"></div>
            </div>
        </div>

    </div>
</div>
<script>
    function changemicropay(evt, obj)
    {
        if($(obj).val()==1)
            $('#micropaymentpacks').show();
        else
            $('#micropaymentpacks').hide();
    }
</script>
@endsection