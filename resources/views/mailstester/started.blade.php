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
                    <span class="testingEmail">{{ $prefix = substr($email, 0, strrpos($email, '@')) }}</span>@srv1.{{ ($request=Request::capture())->gethttphost() }}
                </b>
            </p>
            <ul>
                <li>
                    <b>chakouri</b>
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
                    <span class="testingEmail">chakouri-clientID-currenttimestamp</span>@mt.YOUR-DOMAIN.com .
                </li>
                <li>
                    <a target="_blank" href="{{ route('contact') }}">Contact us</a>
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
                        https://result.YOUR-DOMAIN.com/<span class="testingEmail">chakouri-clientID-currenttimestamp</span>
                </li>
                <li>
                    <a target="_blank" href="{{ route('contact') }}">Contact us</a>
                    so we can add your sub-domain to our SSL certificate.
                </li>
            </ul>
        </div>
        <h3>Configure your account</h3>
        <div class="answer">
            <form
                method="post"
                autocomplete="off"
                action="{{ route('task-save') }}">
                <h4>Secure your account</h4>
                <p>To make sure you are the only one able to access your results, you can add
                    one of the following security checks:</p>
                <ul>
                    <li>Add this private key to the testing email addresses:
                        <input
                            id="pkey"
                            type="text"
                            style="width:100px;"
                            value=""
                            name="data[users][pkey]"/><br/>
                        So your tests should be sent to
                        <b>
                            <span class="testingEmail">chakouri-clientID-currenttimestamp</span>@{{ ($request=Request::capture())->gethttphost() }}</b>
                    </li>
                    <li>Only accept tests sent from the following mail server IPs (separate your IPs
                        with a comma):<br/>
                        <input
                            type="text"
                            style="width:100%"
                            value=""
                            name="data[users][serverip]"
                            placeholder="Leave this field empty to accept all mail server IPs"/>
                    </li>
                    <li>Load the result page (for a new test) only when loaded from one of the
                        following client IP (separate your IPs with a comma):<br/>
                        <input
                            type="text"
                            style="width:100%"
                            value=""
                            name="data[users][clientip]"
                            placeholder="Leave this field empty to accept all client IPs"/>
                    </li>
                    <li>Only accept tests containing the following X-MT-Token header:<br/>
                        <input
                            type="text"
                            style="width:100%"
                            value=""
                            name="data[users][mttoken]"
                            placeholder="Leave this field empty to accept all X-MT-Token headers"/>
                    </li>
                </ul>
                <h4>Micro-payment system</h4>
                <p>
                    If you turn ON the micro-payment mode, mail-tester will display a payment page
                    to the user and the user will be able to access his test only after paying a
                    small fee.<br/>
                    You will receive a commission of
                    <b>40%</b>
                    of the amount spent by your users (excluded VAT).<br/>
                    Micro-payment mode :
                    <select
                        id="micropayment"
                        name="data[users][micropayment]"
                        size="1"
                        style="width:auto;">
                        <option value="0" selected="selected">Disabled - your users can see their result for free</option>
                        <option value="1">Enabled - your users will have to pay a small fee to see their result</option>
                    </select>
                </p>
                <div id="micropaymentpacks" style="display:none">
                    Please select two or three offers you want to propose to your users:
                    <ul>
                        <li>
                            <label for="product_8">
                                <input
                                    id="product_8"
                                    type="checkbox"
                                    class="selectedproducts"
                                    checked="checked"
                                    value="8"/>
                                1 € : Get access to the result of this test only</label>
                        </li>
                        <li>
                            <label for="product_12">
                                <input
                                    id="product_12"
                                    type="checkbox"
                                    class="selectedproducts"
                                    checked="checked"
                                    value="12"/>
                                3 € : Get access to the next 5 tests you perform</label>
                        </li>
                        <li>
                            <label for="product_10">
                                <input id="product_10" type="checkbox" class="selectedproducts" value="10"/>
                                3 € : Get access to the next 10 tests you perform</label>
                        </li>
                        <li>
                            <label for="product_13">
                                <input
                                    id="product_13"
                                    type="checkbox"
                                    class="selectedproducts"
                                    checked="checked"
                                    value="13"/>
                                5 € : Get access to the next 20 tests you perform</label>
                        </li>
                        <li>
                            <label for="product_11">
                                <input id="product_11" type="checkbox" class="selectedproducts" value="11"/>
                                5 € : Get access to the next 30 tests you perform</label>
                        </li>
                        <li>
                            <label for="product_9">
                                <input id="product_9" type="checkbox" class="selectedproducts" value="9"/>
                                5 € : Perform as many tests as you want in the next 48 hours</label>
                        </li>
                        <li>
                            <label for="product_14">
                                <input id="product_14" type="checkbox" class="selectedproducts" value="14"/>
                                10 € : Perform as many tests as you want during the next 7 days</label>
                        </li>
                        <li>
                            <label for="product_16">
                                <input id="product_16" type="checkbox" class="selectedproducts" value="16"/>
                                25 € : Perform as many tests as you want during the next 30 days</label>
                        </li>
                        <li>
                            <label for="product_18">
                                <input id="product_18" type="checkbox" class="selectedproducts" value="18"/>
                                200 € : Perform as many tests as you want during a year
                            </label>
                        </li>
                    </ul>
                    Do you want to propose another deal to your users?
                    <a href="mailto:contact@mail-tester.org">Get in touch!</a>
                </div>
                <input type="submit" value="Save" class="btn"/>
                <input type="hidden" name="task" value="save"/>
                <input type="hidden" name="option" value="com_mtmanager"/>
                <input
                    type="hidden"
                    id="productsids"
                    name="data[users][productsids]"
                    value="8,12,13,"/>
                <input type="hidden" name="45adedc08584ba24ea6f3e97d550bc4a" value="1"/>
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
                                style="font-size: 1.1em; font-weight: bold; cursor: pointer; padding-left: 10px; color: black; text-align: right; vertical-align: top;">×</span>
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
@endsection