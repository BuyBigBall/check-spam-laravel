@extends('mailstester.layout')

@section('content')
<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">
        <div id="system-message-container"></div>
        <div
            id="hikashop_checkout_page"
            class="hikashop_checkout_page hikashop_checkout_page_step3">
            <div class="hikashop_wizardbar">
                <ul>
                    <li class="hikashop_cart_step_finished">
                        <span class="badge badge-success">1</span>
                        Address
                        <span class="hikashop_chevron"></span>
                    </li>

                    <li class="hikashop_cart_step_finished">
                        <span class="badge badge-success">2</span>
                        Payment
                        <span class="hikashop_chevron"></span>
                    </li>

                    <li class="hikashop_cart_step_finished">
                        <span class="badge badge-success">3</span>
                        Cart
                        <span class="hikashop_chevron"></span>
                    </li>

                    <li class="hikashop_cart_step_current">
                        <span class="badge badge-info">4</span>
                        End
                        <span class="hikashop_chevron"></span>
                    </li>

                </ul>
            </div>
            <div class="hikashop_paybox_end" id="hikashop_paybox_end">
                <span
                    id="hikashop_paybox_end_message"
                    class="hikashop_paypal_end_message"
                    style="display: none;">
                    Please wait while you are redirected to Credit Card<br/>If you are not redirected after 10 seconds, please click on the button below.
                </span>
                <span
                    id="hikashop_paybox_end_spinner"
                    class="hikashop_paybox_end_spinner hikashop_checkout_end_spinner"
                    style="display: none;"></span>
                <br/>
                <form
                    id="hikashop_paybox_form"
                    name="hikashop_paybox_form"
                    action="https://tpeweb.paybox.com/cgi/FramepagepaiementRWD.cgi"
                    method="post"
                    target="payboxframe">
                    <input type="hidden" name="PBX_SITE" value="1483184"/>
                    <input type="hidden" name="PBX_RANG" value="01"/>
                    <input type="hidden" name="PBX_IDENTIFIANT" value="623834855"/>
                    <input type="hidden" name="PBX_TOTAL" value="6050"/>
                    <input type="hidden" name="PBX_DEVISE" value="978"/>
                    <input type="hidden" name="PBX_CMD" value="40865"/>
                    <input type="hidden" name="PBX_PORTEUR" value="sales@woobeo.com"/>
                    <input type="hidden" name="PBX_RETOUR" value="mt:M;ref:R;auth:A;err:E;sign:K"/>
                    <input type="hidden" name="PBX_HASH" value="SHA512"/>
                    <input type="hidden" name="PBX_TIME" value="2021-11-17T04:09:15+01:00"/>
                    <input
                        type="hidden"
                        name="PBX_EFFECTUE"
                        value="/manager/paybox_2.php?pbx=user&amp;t=confirm"/>
                    <input
                        type="hidden"
                        name="PBX_ATTENTE"
                        value="/manager/paybox_2.php?pbx=user&amp;t=wait"/>
                    <input
                        type="hidden"
                        name="PBX_REFUSE"
                        value="/manager/paybox_2.php?pbx=user&amp;t=refuse"/>
                    <input
                        type="hidden"
                        name="PBX_ANNULE"
                        value="/manager/paybox_2.php?pbx=user&amp;t=cancel"/>
                    <input
                        type="hidden"
                        name="PBX_REPONDRE_A"
                        value="/manager/paybox_2.php"/>
                    <input type="hidden" name="PBX_TYPEPAIEMENT" value="CARTE"/>
                    <input type="hidden" name="PBX_TYPECARTE" value="CB"/>
                    <input type="hidden" name="PBX_LANGUE" value="GBR"/>
                    <input
                        type="hidden"
                        name="PBX_HMAC"
                        value="ABF4724A744AEF4DFF2B96639765EDAFB4A7621B1FCA2457A8CBA42684305B9D474BEDA5947E76E67242BC25DF74024F5B52C881F61C5A6A66F1979009AD88D2"/>
                    <div
                        id="hikashop_paybox_end_image"
                        class="hikashop_paybox_end_image"
                        style="display: none;">
                        <input
                            id="hikashop_paybox_button"
                            type="submit"
                            class="btn btn-primary"
                            value="Pay now"
                            alt="Pay now"/>
                    </div>
                </form>
                <div style="width:100%;height:800px;margin:auto;">
                    <iframe
                        id="payboxframe"
                        name="payboxframe"
                        src="/assets/images/saved_resource.html"
                        frameborder="0"
                        width="100%"
                        height="800px"
                        allowtransparency="true"
                        scrolling="auto"></iframe>
                </div>
                <script type="text/javascript"></script>
            </div>
        </div>
        <div class="clear_both"></div>
    </div>
</div>
@endsection