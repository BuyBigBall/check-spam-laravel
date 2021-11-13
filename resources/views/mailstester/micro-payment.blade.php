@extends('mailstester.layout')

@section('content')
<div id="content_container" style="width:100%">
    <div id='micropaymentpage' class="row-fluid contentsize" >

        <div id="system-message-container"></div>

        <div class="item-page" itemscope="" itemtype="https://schema.org/Article">
            <div class="page-header">
                <h2 itemprop="headline">
                    Micro-payment mode
                </h2>
            </div>

            <div itemprop="articleBody">
                <hr/>
                <h3>What's our micro-payment mode?</h3>
                <p>You're probably registered on this manager because you own an email marketing
                    tool and you propose to your clients to perform tests before they send their
                    Newsletters.</p>
                <p>If you have a paid software or service, you probably integrated our spam test
                    for free so it's included in the price your customer already pays.</p>
                <p>But if you propose your software or service for free, you may want to add an
                    extra feature to your software and make money at the same time!</p>
                <p>Your users will be able to test their configuration and Newsletters before
                    they send it... and you will earn a commission for each test performed by your
                    users.</p>
                <h3>How does it work?</h3>
                <p>Just like a regular test, make sure you send an email to
                    <em>yourusername</em>-whateveryouwant[at]{{ Request::root() }} and then display the iframe : /<em>yourusername</em>-whateveryouwant</p>
                <p>If the micro-payment mode
                    <a href="/get-started#micropaymentarea">is enabled on your account</a>, a
                    payment page will be displayed and the user will be able to purchase the test.</p>
                <p>Once purchased, the user will be redirected to his test.</p>
                <p>We only display the payment page if:</p>
                <ul>
                    <li>We received the message sent (until we receive it, your users will see our
                        waiting page with the snail)</li>
                    <li>The result of this test has not been paid already (old tests are accessible
                        for free... we display the payment page only if the test has never been loaded
                        before)</li>
                </ul>
                <p>If you want to embed our spam test using the micro-payment mode for the free
                    version of your software and include spam tests for free in your paid version,
                    please create two accounts on our manager, one with the micro-payment mode
                    enabled and the other without it.<br/>In
                    that case, we can even convert your commission into tests on the other account.</p>
                <h3>What's your commission?</h3>
                <p>You will receive
                    <b>40%</b>
                    of the amount spent by your users (excluded VAT).<br/>That's basically a 50/50
                        deal on the benefit as we have large payment fees for small amounts.</p>
                <h3>How much does a test cost?</h3>
                <p>We have several packs from 1 to 10 euros (+ the local tax if it's from an
                    European Union country) containing several tests, you can pick up 2 or 3 packs
                    and display them on the payment page assigned to your account.</p>
                <p>Want to apply other prices?
                    <a href="{{ route('contact', '#contactus') }}">Get in touch with us!</a>
                </p>
                <h3>When will you get paid?</h3>
                <p>Every 1st of the month, you will receive a payment of your commission to your
                    paypal email address (or to your bank account if you're located in Europe) if
                    you earned more than 100€ of commissions.</p>
            </div>

        </div>

    </div>
</div>
@endsection