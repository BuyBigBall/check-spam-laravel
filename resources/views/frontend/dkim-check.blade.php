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
        class="cc-window cc-banner cc-type-info cc-theme-block cc-bottom cc-color-override-688238583  cc-invisible"
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
        style="">
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
        <center><h1 class="title py-5 m-0">Check your SPF and DKIM keys</h1></center>
    </div>

    <div class="bg-white">
        <div class="container py-5  text-center">
            <h2 class="my-3">Check if your domain has these 2 email signatures set up and valid.</h2>
            <strong>What's DKIM and SPF?
            </strong>They're 2 effective email signatures against spoofing, phishing or
            impersonation. When recipients receive your emails, their spam filters
            automatically poke your domain to see if those signatures are not forged.
        </div>
    </div>

    <div>
        <div class="container py-5">
            <form
                class="form"
                method="post"
                action="/toolsresult">
                <div class="row">
                    <div class="col-sm-4 text-sm-right">
                        <label class="form-control-lg" for="domainname">Domain name</label>
                    </div>
                    <div class="col-sm-4">
                        <input
                            type="text"
                            class="form-control form-control-lg"
                            id="domainname"
                            name="domainname"
                            placeholder="example.com"/><br/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4 text-sm-right">
                        <label class="form-control-lg" for="dkim_selector">DKIM Selector</label>
                    </div>
                    <div class="col-sm-4">
                        <input
                            type="text"
                            class="form-control form-control-lg"
                            id="dkim_selector"
                            name="dkim_selector"
                            placeholder="default"/>
                    </div>
                </div>

                <div class="text-center my-3">
                    <input
                        class="btn btn-lg btn-primary"
                        type="submit"
                        value="Check SPF &amp; DKIM keys"/>
                    <input type="hidden" name="area" value="result"/>
                </div>
            </form>
        </div>
    </div>

    <div class="bg-white">
        <div class="container py-5">
            <div id="result"></div>
        </div>
    </div>

    <script type="text/javascript">
        var _gaq = [
            [
                '_setAccount', 'UA-31056342-1'
            ],
            ['_trackPageview']
        ];
        (function (d, t) {
            var g = d.createElement(t),
                s = d.getElementsByTagName(t)[0];
            g.src = (
                'https:' == location.protocol
                    ? '//ssl'
                    : '//www'
            ) + '.google-analytics.com/ga.js';
            s
                .parentNode
                .insertBefore(g, s)
        }(document, 'script'));
    </script>

</body>
@endsection