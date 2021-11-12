@extends('layouts.user')

@section('content')
<style>
    .cc-color-override-688238583.cc-window {
        color: rgb(255, 255, 255);
        background-color: rgb(0, 0, 0);
    }
    .cc-banner.cc-bottom {
        left: 0;
        right: 0;
        bottom: 0;
    }
    .cc-window.cc-banner {
        -ms-flex-align: center;
        align-items: center;
    }
    .cc-window.cc-banner {
        padding: 1em 1.8em;
        width: 100%;
        -ms-flex-direction: row;
        flex-direction: row;
    }
    .cc-bottom {
        bottom: 1em;
    }
    .cc-revoke,
    .cc-window {
        position: fixed;
        overflow: hidden;
        box-sizing: border-box;
        font-family: Helvetica,Calibri,Arial,sans-serif;
        font-size: 16px;
        line-height: 1.5em;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: nowrap;
        flex-wrap: nowrap;
        z-index: 9999;
    }
    .cc-window {
        opacity: 1;
        transition: opacity 1s ease;
    }
</style>
<body>
    <div
        role="dialog"
        aria-live="polite"
        aria-label="cookieconsent"
        aria-describedby="cookieconsent:desc"
        class="cc-window cc-banner cc-type-info cc-theme-block cc-bottom cc-color-override-688238583 "
        style="display:none;">
        <!--googleoff: all-->
        <span id="cookieconsent:desc" class="cc-message">We use cookies to personalise ads and to analyse our traffic.<br/>We
            also share information about your use of our site with our social media,
            advertising and analytics partners who may combine it with other information
            that you've provided to them or that they've collected from your use of their
            services.<br/><br/>We do not share tests performed on this platform with anyone.
            <a
                aria-label="learn more about cookies"
                role="button"
                tabindex="0"
                class="cc-link"
                href="http://cookiesandyou.com"
                target="_blank">Learn more</a>
        </span>
        <div class="cc-compliance">
            <a
                aria-label="dismiss cookie message"
                role="button"
                tabindex="0"
                class="cc-btn cc-dismiss">Got it!</a>
        </div>
        <!--googleon: all-->
    </div>
    <div
        role="dialog"
        aria-live="polite"
        aria-label="cookieconsent"
        aria-describedby="cookieconsent:desc"
        class="cc-window cc-banner cc-type-info cc-theme-block cc-bottom cc-color-override-688238583 cc-invisible"
        style="display: none;">
        <!--googleoff: all-->
        <span id="cookieconsent:desc" class="cc-message">We use cookies to personalise ads and to analyse our traffic.<br/>We
            also share information about your use of our site with our social media,
            advertising and analytics partners who may combine it with other information
            that you've provided to them or that they've collected from your use of their
            services.<br/><br/>We do not share tests performed on this platform with anyone.
            <a
                aria-label="learn more about cookies"
                role="button"
                tabindex="0"
                class="cc-link"
                href="http://cookiesandyou.com/"
                target="_blank">Learn more</a>
        </span>
        <div class="cc-compliance">
            <a
                aria-label="dismiss cookie message"
                role="button"
                tabindex="0"
                class="cc-btn cc-dismiss">Got it!</a>
        </div>
        <!--googleon: all-->
    </div>

    <div id="header">
        <div class="back">
            <a class="btn btn-transparent" href="/">
                <i class="icon-left"></i>
                Back to port</a>
        </div>

        <center>
        <h1 class="title py-5 m-0">Guide to Edit Your SPF Record on 123-reg</h1></center>

        <div class="container text-center">
            <div class="list-group list-group-flush pb-5">
                <a
                    class="list-group-item list-group-item-action list-group-item-transparent"
                    href="#access-dns-editor">Access the DNS Zone Editor</a>
                <a
                    class="list-group-item list-group-item-action list-group-item-transparent"
                    href="#create-spf-record">Create a SPF record</a>
            </div>
        </div>
    </div>
    <div class="bg-white">
        <div class="container py-3 clearfix">
            <h2 class="question" id="access-dns-editor">Access the DNS Zone Editor</h2>

            <div class="answer">
                <ol>
                    <li>Log in to your
                        <a href="http://www.123-reg.com/">123-reg account</a>.</li>
                    <li>Click on the
                        <b>Control panel login</b>
                        button.
                        <p class="text-center"><img
                            src="/assets/images/controlpanel.png"
                            alt="123-reg Control Panel"/></p>
                    </li>
                    <li>Select your domain name and click on
                        <b>Manage</b>.
                        <p class="text-center"><img
                            src="/assets/images/managedomain.png"
                            alt="123-reg Domain manager"/></p>
                    </li>
                    <li>Click on the
                        <b>Manage DNS</b>
                        link.
                        <p class="text-center"><img
                            src="/assets/images/accessdns.png"
                            alt="Access 123-reg DNS"/></p>
                    </li>
                    <li>Click on the
                        <b>Advanced DNS</b>
                        tab.
                        <p class="text-center"><img
                            src="/assets/images/advanceddns.png"
                            alt="Advanced DNS tab"/></p>
                    </li>
                </ol>
                <a
                    class="btn btn-transparent float-right"
                    href="#header">
                    <i class="icon-up"></i>Back to top</a>
            </div>
        </div>
    </div>

    <div class="bg-white">
        <div class="container py-3 clearfix">
            <h2 class="question" id="create-spf-record">Create a SPF record</h2>

            <div class="answer">
                <ol>
                    <li>
                        <b>Hostname</b>: Enter the Host Record you would like to use ("@" for
                        example.com, "mail" for mail.example.com, etc).</li>
                    <li>
                        <b>Type</b>: From the drop down menu choose
                        <b>TXT</b>.</li>
                    <li>
                        <b>Destination</b>: Enter here your SPF record ( v=spf1 a mx ~all )</li>
                    <li>Click on the
                        <b>Add new entry</b>
                        button.</li>
                </ol>
                <p class="text-center"><img
                    src="/assets/images/createrecord.png"
                    alt="Create SPF record"/></p>
                <a
                    class="btn btn-transparent float-right"
                    href="#header">
                    <i class="icon-up"></i>Back to top</a>
            </div>

        </div>
    </div>

</body>
@endsection