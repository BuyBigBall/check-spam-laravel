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
                    <a href="{{ route('spf-detail', '123-reg') }} " >123-reg</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', '1and1') }} " >1&amp;1</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', '20i') }} " >20i</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', '34sp') }} " >34SP.com</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'a2hosting') }} " >A2 Hosting</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'acens') }} " >acens</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'aruba') }} " >Aruba</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'arvix') }} " >Arvix</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'avanhost') }} " >avanhost</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'bluehost') }} " >Bluehost</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'cdmon') }} " >CDmon</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'citynetwork') }} " >city network</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'cloudaccess-dot-net') }} " >CloudAccess.net</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'cloudflare') }} " >CloudFlare</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'cpanel') }} " >cPanel Accelerated 2</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'cpanel76') }} " >cPanel 76.x</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'crazydomains') }} " >Crazy Domains</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'dicoit') }} " >Dicoit</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'dinahosting') }} " >Dinahosting</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'directadmin') }} " >DirectAdmin</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'digitalocean') }} " >DigitalOcean</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'domainmonster') }} " >DomainMonster</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'domein-registreren') }} " >Domein-Registreren</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'dreamhost') }} " >DreamHost</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'dnsmadeeasy') }} " >DNS Made Easy</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'easyspace') }} " >Easyspace</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'enom') }} " >eNom</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'fastcomet') }} " >FastComet</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'fasthosts') }} " >FastHosts</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'gandi') }} " >Gandi</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'godaddy') }} " >GoDaddy</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'hostgator') }} " >HostGator</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'hostinger') }} " >Hostinger</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'hostmantis') }} " >HostMantis</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'hostmonster') }} " >HostMonster</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'hover') }} " >Hover</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'ifastnet') }} " >iFastNet</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'infomaniak') }} " >Infomaniak</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'inmotion-hosting') }} " >InMotion Hosting</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'ikoula') }} " >Ikoula</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'internet-girona') }} " >Internet Girona</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'ispconfig3') }} " >ISPConfig 3</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'justhost') }} " >JustHost</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'linode') }} " >Linode</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'lws') }} " >LWS</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'maikelve') }} " >MaikelVE</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'melbourne-it') }} " >Melbourne IT</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'metanet') }} " >METANET</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'name-dot-com') }} " >name.com</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'namecheap') }} " >Namecheap</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'nazwa') }} " >Nazwa.pl</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'neostrada') }} " >Neostrada</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'netissime') }} " >Netissime</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'network-solutions') }} " >Network Solutions</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'nuxit') }} " >Nuxit</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'omacomp') }} " >OMA Comp</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'one-dot-com') }} " >One.com</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'ovh') }} " >OVH</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'parallels-plesk-panel') }} " >Parallels Plesk Panel</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'planethoster') }} " >PlanetHoster</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'plesk-onyx') }} " >Plesk Onyx</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'proisp') }} " >PRO ISP</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'register-dot-com') }} " >Register.com</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'simply-hosting') }} " >Simply Hosting</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'site5') }} " >Site5</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'siteground') }} " >SiteGround</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'softlayer') }} " >SoftLayer</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'srsplus') }} " >SRSPlus</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'tophost') }} " >TopHost.it</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'unoeuro') }} " >UnoEuro</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'vesta') }} " >Vesta</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'vidahost') }} " >Vidahost</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'vip-dot-nl') }} " >VIP.nl</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'whm') }} " >WHM (Web Host Manager)</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'whmcs') }} " >WHMCS (Web Host Manager Complete Solution)</a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3" >
                    <a href="{{ route('spf-detail', 'wix') }} " >Wix</a>
                </div>
            </div>

            <!--<div class="my-4"> <b>Your host is not listed ?</b> Give us a temp access to
            your host account, we will set up your SPF for free and create a guide. <a
            href="/contact">Get in touch!</a> </div>-->

        </div>
    </div>

</body>
@endsection