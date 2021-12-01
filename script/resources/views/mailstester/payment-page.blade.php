@extends('mailstester.layout')

@section('content')
<style>
    .required{
        color : red;
    }
    .btn-third
    {
        line-height : 1rem;
    }
    </style>
<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize container ">

        <div id="system-message-container" class='row'></div>

        <form class="checkout_coupon woocommerce-form-coupon" method="post" style="">
            <div
                id="mailtester_cart_checkout_page_coupon"
                class="mailtester_cart_checkout_page mailtester_cart_checkout_page_step0 row justify-content-center">    
                <p>If you have a coupon code, please apply it below.</p>
                <p class="form-row form-row-first">
                    <input type="text" name="coupon_code" class="input-text" placeholder="Coupon code" id="coupon_code" value="">
                </p>
                <p class="form-row form-row-last">
                    <button type="submit" class="button btn btn-secondary btn-third" 
                        style='padding:1px; margin-left:1rem;'
                        name="apply_coupon" value="Apply coupon">Apply coupon</button>
                </p>
                <div class="clear"></div>
            </div>
        </form>

        <form>
                @csrf
        <div
            id="mailtester_cart_checkout_page"
            class="mailtester_cart_checkout_page mailtester_cart_checkout_page_step0 row">
<div class="col-sm-6 col-md-7">
    <div class="maz-billing-fields">
        <div class="maz-billing-fields__field-wrapper">
            <div class="form-group row mb-4">
                <label
                    for="firstname"
                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                    First name
                    <span class="required">*</span>
                    :</label>
                <div class="col-sm-12 col-md-7">
                    <input
                        type="text"
                        id="firstname"
                        class="form-control "
                        name="firstname"
                        value=""
                        required=""
                        placeholder="First Name"/>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label
                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                    for="lastname">Last name
                    <span class="required">*</span>
                    :</label>
                <div class="col-sm-12 col-md-7">
                    <input
                        type="text"
                        id="lastname"
                        class="form-control "
                        name="lastname"
                        value=""
                        required=""
                        placeholder="Last Name"/>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label
                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                    for="company">Company name :</label>
                <div class="col-sm-12 col-md-7">
                    <input
                        type="text"
                        id="company"
                        class="form-control "
                        name="company"
                        value=""
                        placeholder="Company Name"/>
                </div>
            </div>

            <div class="form-group row mb-4">
                <label
                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                    for="country">Country / Region
                    <span class="required">*</span>
                    :</label>
                <div class="col-sm-12 col-md-7">
                    <input
                        type="text"
                        id="country"
                        class="form-control "
                        name="country"
                        value=""
                        placeholder="Country"/>
                </div>
            </div>

            <div class="form-group row mb-4">
                <label
                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                    for="street">Street address
                    <span class="required">*</span>
                    :</label>
                <div class="col-sm-12 col-md-7">
                    <input
                        type="text"
                        id="street"
                        class="form-control "
                        name="address"
                        value=""
                        placeholder="Street"/>
                </div>
            </div>

            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="city">City
                    <span class="required">*</span>
                    :</label>
                <div class="col-sm-12 col-md-7">
                    <input
                        type="text"
                        id="city"
                        class="form-control "
                        name="city"
                        value=""
                        placeholder="City"/>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label
                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                    for="state">State
                    <span class="required">*</span>
                    :</label>
                <div class="col-sm-12 col-md-7">
                    <input
                        type="text"
                        id="state"
                        class="form-control "
                        name="state"
                        value=""
                        placeholder="State"/>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label
                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                    for="email">Email Address
                    <span class="required">*</span>
                    :</label>
                <div class="col-sm-12 col-md-7">
                    <input
                        type="email"
                        id="email"
                        class="form-control "
                        name="mail_addr"
                        value=""
                        placeholder="Email Address"/>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label
                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                    for="phone">Phone Number
                    <span class="required">*</span>
                    :</label>
                <div class="col-sm-12 col-md-7">
                    <input
                        type="text"
                        id="phone"
                        class="form-control "
                        name="telephone"
                        value=""
                        placeholder="Phone Number"/>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label
                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                    for="postcode">Post Code
                    <span class="required">*</span>
                    :</label>
                <div class="col-sm-12 col-md-7">
                    <input
                        type="text"
                        id="postcode"
                        class="form-control "
                        name="postcode"
                        value=""
                        placeholder="Post Code"/>

                </div>
            </div>
            <div class="maz-additional-fields" style="display:none;">
                <h3>Additional information</h3>

                <div class="maz-additional-fields__field-wrapper">
                    <p class="form-row notes" id="order_comments_field" data-priority="">
                        <label for="order_comments" class="">Order notes&nbsp;<span class="optional">(optional)</span>
                        </label>
                        <span class="maz-input-wrapper">
                            <textarea
                                name="order_comments"
                                class="input-text "
                                id="order_comments"
                                placeholder="Notes about your order, e.g. special notes for delivery."
                                rows="2"
                                cols="5"
                                style="margin: 0px -2px 0px 0px; height: 114px; width: 595px;"></textarea>
                        </span>
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>            
<div class="col-sm-6 col-md-5">
    <div id="order_review" class="maz-checkout-review-order">
        <table class="shop_table maz-checkout-review-order-table" width='90%'>
            <thead>
                <tr>
                    <th class="product-name">Product</th>
                    <th class="product-total">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr class="cart_item">
                    <td class="product-name">
                        Avanti Shirt Orange&nbsp;
                        <strong class="product-quantity">×&nbsp;2</strong>
                    </td>
                    <td class="product-total">
                        <span class="maz-Price-amount amount">
                            <bdi>
                                <span class="maz-Price-currencySymbol">$</span>39.90</bdi>
                        </span>
                    </td>
                </tr>
            </tbody>
            <tfoot>

                <tr class="cart-subtotal">
                    <th>Subtotal</th>
                    <td>
                        <span class="maz-Price-amount amount">
                            <bdi>
                                <span class="maz-Price-currencySymbol">$</span>39.90</bdi>
                        </span>
                    </td>
                </tr>

                <tr class="order-total">
                    <th>Total</th>
                    <td>
                        <strong>
                            <span class="maz-Price-amount amount">
                                <bdi>
                                    <span class="maz-Price-currencySymbol">$</span>39.90</bdi>
                            </span>
                        </strong>
                    </td>
                </tr>

            </tfoot>
        </table>

        <div id="payment" class="maz-checkout-payment">
            <ul class="wc_payment_methods payment_methods methods">
                <li class="wc_payment_method payment_method_bacs">
                    <input
                        id="payment_method_bacs"
                        type="radio"
                        class="input-radio"
                        name="payment_method"
                        value="bacs"
                        data-order_button_text=""/>

                    <label for="payment_method_bacs">
                        Stripe
                        <img src="{{asset('/assets/images/stripe_bar.png')}}" 
                            style='margin-left:2rem;width:220px;'
                            alt="Stripe acceptance mark" />
                    </label>
                    <div class="payment_box payment_method_bacs" style="display:none;">
                        <p>Make your payment directly into our bank account. Please use your Order ID as
                            the payment reference. Your order will not be shipped until the funds have
                            cleared in our account.</p>
                    </div>
                </li>
                <li class="wc_payment_method payment_method_paypal">
                    <input
                        id="payment_method_paypal"
                        type="radio"
                        class="input-radio"
                        name="payment_method"
                        value="paypal"
                        checked="checked"
                        data-order_button_text="Proceed to PayPal"/>
<script>
    var winstyle = 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700';
    var winurl = 'https://www.paypal.com/us/webapps/mpp/paypal-popup';
</script>
                    <label for="payment_method_paypal">
                        PayPal
                        <img src="{{asset('/assets/images/paypal_bar.png')}}" 
                                style='margin-left:2rem;width:220px;'
                                alt="PayPal acceptance mark" />
                    </label>
                    <div class="payment_box payment_method_paypal">
                        <p>Pay via <a
                            href="https://www.paypal.com/us/webapps/mpp/paypal-popup"
                            class="about_paypal"
                            onclick="window.open(winurl,'WIPaypal',winstyle); return false;">
                                    PayPal</a>; you can pay with your credit card if you don’t have a PayPal
                            account.</p>
                    </div>
                    
                                                </li>
            </ul>
            <div class="form-row place-order">
                <noscript>
                    Since your browser does not support JavaScript, or it is disabled, please ensure
                    you click the
                    <em>Update Totals</em>
                    button before placing your order. You may be charged more than the amount stated
                    above if you fail to do so.
                    <br/>
                    <button
                        type="submit"
                        class="button alt"
                        name="woocommerce_checkout_update_totals"
                        value="Update totals">Update totals</button>
                </noscript>

                <div class="maz-terms-and-conditions-wrapper">
                    <div class="maz-privacy-policy-text">
                        <p>Your personal data will be used to process your order, support your
                            experience throughout this website, and for other purposes described in our
                            <a href="" class="maz-privacy-policy-link" target="_blank">privacy policy</a>.</p>
                    </div>
                </div>

                <button
                    type="submit"
                    class="button alt  btn btn-secondary"
                    name="woocommerce_checkout_place_order"
                    id="place_order"
                    value="Place order"
                    data-value="Place order">Proceed to PayPal</button>

                <input
                    type="hidden"
                    id="maz-process-checkout-nonce"
                    name="maz-process-checkout-nonce"
                    value="2c8c6f9b08"><input
                    type="hidden"
                    name="_wp_http_referer"
                    value="/?wc-ajax=update_order_review"/>
            </div>
        </div>
    </div>
</div>
        </div>
        </form>
        <div class="clear_both"></div>

    </div>
</div>

<script>

</script>

<style>
a#mailtester_cart_checkout_next_button, a#mailtester_cart_checkout_billing_address_new_link
{
    color:#fff;
    padding-top : 1px !important;
    padding-bottom : 1px !important;
}
</style>

@endsection

