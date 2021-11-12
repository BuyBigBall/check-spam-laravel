@extends('mailstester.layout')

@section('content')
<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">

        <div id="system-message-container"></div>

        <div class="item-page" itemscope="" itemtype="https://schema.org/Article">

            <div class="page-header">
                <h2 itemprop="headline">
                    Terms of service
                </h2>
            </div>

            <div itemprop="articleBody">
                <hr/>
                <ul class="toc">
                    <li>
                        <a href="#whatsatest">What's a test?</a>
                    </li>
                    <li>
                        <a
                            href="#creditsexpiration">For how long can I use my credits?</a>
                    </li>
                    <li>
                        <a
                            href="#paymentsystem">Payment system</a>
                    </li>
                    <li>
                        <a href="#vat">VAT or not VAT?</a>
                    </li>
                    <li>
                        <a
                            href="#refundpolicy">Refund policy</a>
                    </li>
                    <li>
                        <a href="#whoarewe">Who are we?</a>
                    </li>
                </ul>
                <h3 id="whatsatest">What's a test?</h3>
                <p>We consider you made a test if and only if:</p>
                <ol>
                    <li>You sent a new email to your testing address</li>
                    <li>You called the result page</li>
                    <li>We were able to send you back the result (not the waiting page)</li>
                </ol>
                <p>If you call several times the same result without sending a new email, we
                    will consider it as a unique test.<br/>If we do not receive your message, no credit will be removed from your account.<br/>If
                    you send us an email but do not trigger the result page, no credit will be
                    removed from your account (even if we don't know why you would do that...)</p>
                <h3 id="creditsexpiration">For how long can I use my credits?</h3>
                <p>There is no expiry date on your credits... Feel free to purchase a pack and
                    perform tests until you don't have credits any more.<br/>You
                    can refill your account at any time by purchasing a pack of credits. They will
                    be added to your current number of credits left.</p>
                <h3 id="paymentsystem">Payment system</h3>
                <p>We accept payments via Blue Card, Visa, Master Card, Amex and Paypal.<br/>None
                    of your credit card information and/or Paypal account information are stored in
                    any way on our website.</p>
                <h3 id="vat">VAT or not VAT?</h3>
                <p>We are located in France so we apply the European Union tax rules which means:</p>
                <ul>
                    <li>If you are located out of the European Union, the products will be tax free</li>
                    <li>If you are located in European Union and have a Tax number (if you're a
                        company), the products will be tax free</li>
                    <li>If you are located in European Union and do not have a Tax number (if you're
                        not a company for example), we will apply your local tax rate to your order</li>
                    <li>If you are located in France (regardless you're a company or not), we apply
                        the standard French tax for services : 20%.</li>
                </ul>
                <h3 id="refundpolicy">Refund policy</h3>
                <p>Creating an account on our website will automatically give you some free
                    tests so we consider you had the time to test our service and you know what you
                    pay for.<br/>All purchases made through this website are final and there are no refunds.</p>
                <h3 id="whoarewe">Who are we?</h3>
                <p>The company behind mail-tester is :</p>
                <p>WOOBEO<br/>110 av. Barthelemy Buyer<br/>69009 Lyon<br/>France</p>
            </div>

        </div>

    </div>
</div>
@endsection