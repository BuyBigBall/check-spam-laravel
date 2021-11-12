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
.cc-revoke, .cc-window {
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
        <span id="cookieconsent:desc" class="cc-message">
            We use cookies to personalise ads and to analyse our traffic.<br/>We also share
                information about your use of our site with our social media, advertising and
                analytics partners who may combine it with other information that you've
                provided to them or that they've collected from your use of their services.<br/><br/>We do not share tests performed on this platform with anyone.
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

    <div id="header" >
        <div class="back" >
            <a class="btn btn-transparent" href="/">
                <i class="icon-left"></i>
                Back to port</a>
        </div>
        <center>
        <h1 class="title py-5 m-0 text-dark">Guides to Edit Your SPF Record</h1>
        </center>
    </div>

    <div class="container py-3">
        <div class="my-3">
            <h2>What is SPF ?</h2>
            Sender policy framework is a method for recipients to check your domain registry
            where you've authorized your host or your sending service to deliver newsletters
            on your behalf. In other words, it helps your recipients determine if an email
            is a scam or not.
        </div>
        <input
            type="text"
            class="form-control form-control-lg"
            placeholder="Search for your host or registrar..."
            id="searchHost"/>
    </div>
    <div class="bg-white">
        <div class="container py-4">
            <div class="row my-4" id="hosts">
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/123-reg">123-reg</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/1and1">1&amp;1</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/20i">20i</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/34sp">34SP.com</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/a2hosting">A2 Hosting</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/acens">acens</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/aruba">Aruba</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/arvix">Arvix</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/avanhost">avanhost</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/bluehost">Bluehost</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/cdmon">CDmon</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/citynetwork">city network</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/cloudaccess-dot-net">CloudAccess.net</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/cloudflare">CloudFlare</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/cpanel">cPanel Accelerated 2</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/cpanel76">cPanel 76.x</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/crazydomains">Crazy Domains</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/dicoit">Dicoit</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/dinahosting">Dinahosting</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/directadmin">DirectAdmin</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/digitalocean">DigitalOcean</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/domainmonster">DomainMonster</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/domein-registreren">Domein-Registreren</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/dreamhost">DreamHost</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/dnsmadeeasy">DNS Made Easy</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/easyspace">Easyspace</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/enom">eNom</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/fastcomet">FastComet</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/fasthosts">FastHosts</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/gandi">Gandi</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/godaddy">GoDaddy</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/hostgator">HostGator</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/hostinger">Hostinger</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/hostmantis">HostMantis</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/hostmonster">HostMonster</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/hover">Hover</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/ifastnet">iFastNet</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/infomaniak">Infomaniak</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/inmotion-hosting">InMotion Hosting</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/ikoula">Ikoula</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/internet-girona">Internet Girona</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/ispconfig3">ISPConfig 3</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/justhost">JustHost</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/linode">Linode</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/lws">LWS</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/maikelve">MaikelVE</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/melbourne-it">Melbourne IT</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/metanet">METANET</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/name-dot-com">name.com</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/namecheap">Namecheap</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/nazwa">Nazwa.pl</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/neostrada">Neostrada</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/netissime">Netissime</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/network-solutions">Network Solutions</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/nuxit">Nuxit</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/omacomp">OMA Comp</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/one-dot-com">One.com</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/ovh">OVH</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/parallels-plesk-panel">Parallels Plesk Panel</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/planethoster">PlanetHoster</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/plesk-onyx">Plesk Onyx</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/proisp">PRO ISP</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/register-dot-com">Register.com</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/simply-hosting">Simply Hosting</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/site5">Site5</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/siteground">SiteGround</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/softlayer">SoftLayer</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/srsplus">SRSPlus</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/tophost">TopHost.it</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/unoeuro">UnoEuro</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/vesta">Vesta</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/vidahost">Vidahost</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/vip-dot-nl">VIP.nl</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/whm">WHM (Web Host Manager)</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/whmcs">WHMCS (Web Host Manager Complete Solution)</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/spf/wix">Wix</a>
                </div>
            </div>

            <!--<div class="my-4"> <b>Your host is not listed ?</b> Give us a temp access to
            your host account, we will set up your SPF for free and create a guide. <a
            href="/contact">Get in touch!</a> </div>-->

        </div>
    </div>

</body>
@endsection