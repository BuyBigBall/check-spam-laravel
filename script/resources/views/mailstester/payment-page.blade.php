@extends('mailstester.layout')

@section('content')
<style>

    #order_review td{
        height:2.5rem;
    }
    .coupon_error .red{
        color:red;
        font-size:0.8rem;
    }
    .couponrow{
        padding-left:15rem;
    }
    .btn-third
    {
        font-size:0.8rem;
    }

    .mailtester_cart_checkout_page_step0 h1
    {
        border-bottom:none !important;
    }
    .product-total.amount
    {
        text-align : right;
        padding-right:2rem;
    }
    .maz-Price-amount.amount
    {
        font-size:0.9rem;
    }
    .maz-Price-amount.amount.total{
        font-size:1rem;
    }
    .required{
        color : red;
    }
    #payment_container label, #payment_container p
    {
        font-size:13px;
    }
    #payment_container select,
    #payment_container textarea,
    #payment_container input[type="text"],
    #payment_container input[type="password"],
    #payment_container input[type="datetime"],
    #payment_container input[type="datetime-local"],
    #payment_container input[type="date"],
    #payment_container input[type="month"],
    #payment_container input[type="time"],
    #payment_container input[type="week"],
    #payment_container input[type="number"],
    #payment_container input[type="email"],
    #payment_container input[type="url"],
    #payment_container input[type="search"],
    #payment_container input[type="tel"],
    #payment_container input[type="color"],
    #payment_container .uneditable-input {
        height: calc(1.5em + 0.75rem + 2px);
        color:#333;
    }

    #mailtester_cart_checkout_page_coupon
    {
        margin-top:0.8rem;
    }

    .maz-checkout-payment
    {
        margin-top:1rem;
    }
    </style>


<div id="payment_container" style="width:100%">
    <div class="row-fluid contentsize container ">

        <div id="system-message-container" class='row'></div>
        
        <div class="mailtester_cart_cpanel_title" id="mailtester_cart_cpanel_title">
                <fieldset>
                    <div class="header mailtester_cart_header_title">
                        <h3>CHECKOUT</h3>
                    </div>
                </fieldset>
            </div>

        <form class="checkout_coupon woocommerce-form-coupon" method="post" style="">
            @csrf
            <div
                id="mailtester_cart_checkout_page_coupon"
                class="row justify-content-center">    
                <div class="col-sm-12 col-md-12 left pt-1 couponrow">If you have a coupon code, please apply it below.</div>
                <div class="col-sm-12 col-md-6 left  pt-1 couponrow" >
                    <input type="text" name="coupon_code" class="input-text" 
                        placeholder="Coupon code" id="coupon_code" value="{{$checkout_payment_coupon}}">
                </div>
                <div class="col-sm-12 col-md-6" >
                    <button type="submit" class="button btn btn-secondary btn-third" 
                        style='margin-left:1rem;'
                        name="apply_coupon" value="Apply coupon">Apply coupon</button>
                </div>
                <div class="clear"></div>
            </div>
            @if( !empty($error_message['coupon']) )
            <div class="row justify-content-center coupon_error couponrow">
                <div class="col-sm-12 col-md-12">
                    <span class='red'>{{$error_message['coupon']}}</span>
                </div>
            </div>
            @endif
        </form>

        <form class="form-horizontal" method="POST" id="payment-form" role="form" 
            action="{!! URL::route('buy_mail_test') !!}" >
                @csrf
        <div
            id="mailtester_cart_checkout_page"
            class="mailtester_cart_checkout_page mailtester_cart_checkout_page_step0 row">
<div class="col-sm-6 col-md-1"></div>
<div class="col-sm-6 col-md-6">
    <h1>Billing details</h1>
    <div class="maz-billing-fields">
        <div class="maz-billing-fields__field-wrapper">
            
            <div class="form-group row mb-4">
                <label
                    for="firstname"
                    class="col-form-label text-md-right col-12 col-md-4 col-lg-4">
                    First name
                    <span class="required">*</span>
                    :</label>
                <div class="col-sm-12 col-md-6">
                    <input
                        type="text"
                        id="firstname"
                        class="form-control "
                        name="firstname"
                        @if( !empty($userdata['user_profile']) )
                        value="{{$userdata['user_profile']['firstname']}}"
                        @endif
                        required
                        placeholder="First Name"/>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label
                    class="col-form-label text-md-right col-12 col-md-4 col-lg-4"
                    for="lastname">Last name
                    <span class="required">*</span>
                    :</label>
                <div class="col-sm-12 col-md-6">
                    <input
                        type="text"
                        id="lastname"
                        class="form-control "
                        name="lastname"
                        @if( !empty($userdata['user_profile']) )
                        value="{{$userdata['user_profile']['lastname']}}"
                        @endif
                        required
                        placeholder="Last Name"/>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label
                    class="col-form-label text-md-right col-12 col-md-4 col-lg-4"
                    for="company">Company name :</label>
                <div class="col-sm-12 col-md-6">
                    <input
                        type="text"
                        id="company"
                        class="form-control "
                        name="company"
                        @if( !empty($userdata['user_profile']['company'] ) )
                        value="{{$userdata['user_profile']['company']}}"
                        @endif
                        placeholder="Company Name"/>
                </div>
            </div>

            <div class="form-group row mb-4">
                <label
                    class="col-form-label text-md-right col-12 col-md-4 col-lg-4"
                    for="country">Country / Region
                    <span class="required">*</span>
                    :</label>
                <div class="col-sm-12 col-md-6">
                    <input
                        type="text"
                        id="country"
                        class="form-control "
                        name="country"
                        @if( !empty($userdata['user_profile'] ) )
                        value="{{$userdata['user_profile']['country']}}"
                        @endif
                        required
                        placeholder="Country"/>
                </div>
            </div>

            <div class="form-group row mb-4">
                <label
                    class="col-form-label text-md-right col-12 col-md-4 col-lg-4"
                    for="street">Street address
                    <span class="required">*</span>
                    :</label>
                <div class="col-sm-12 col-md-6">
                    <input
                        type="text"
                        id="street"
                        class="form-control "
                        name="address"
                        @if( !empty($userdata['user_profile'] ) )
                        value="{{$userdata['user_profile']['address']}}"
                        @endif
                        required
                        placeholder="Street"/>
                </div>
            </div>

            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-4 col-lg-4" for="city">City
                    <span class="required">*</span>
                    :</label>
                <div class="col-sm-12 col-md-6">
                    <input
                        type="text"
                        id="city"
                        class="form-control "
                        name="city"
                        @if( !empty($userdata['user_profile'] ) )
                        value="{{$userdata['user_profile']['city']}}"
                        @endif
                        required
                        placeholder="City"/>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label
                    class="col-form-label text-md-right col-12 col-md-4 col-lg-4"
                    for="state">State
                    <span class="required">*</span>
                    :</label>
                <div class="col-sm-12 col-md-6">
                    <input
                        type="text"
                        id="state"
                        class="form-control "
                        name="state"
                        @if( !empty($userdata['user_profile'] ) )
                        value="{{$userdata['user_profile']['state']}}"
                        @endif
                        required
                        placeholder="State"/>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label
                    class="col-form-label text-md-right col-12 col-md-4 col-lg-4"
                    for="email">Email Address
                    <span class="required">*</span>
                    :</label>
                <div class="col-sm-12 col-md-6">
                    <input
                        type="email"
                        id="email"
                        class="form-control "
                        name="mail_addr"
                        @if( !empty($userdata['user_profile'] ) )
                        value="{{$userdata['user_profile']['mail_addr']}}"
                        @endif
                        required
                        placeholder="Email Address"/>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label
                    class="col-form-label text-md-right col-12 col-md-4 col-lg-4"
                    for="phone">Phone Number
                    <span class="required">*</span>
                    :</label>
                <div class="col-sm-12 col-md-6">
                    <input
                        type="text"
                        id="phone"
                        class="form-control "
                        name="telephone"
                        @if( !empty($userdata['user_profile'] ) )
                        value="{{$userdata['user_profile']['telephone']}}"
                        @endif
                        required
                        placeholder="Phone Number"/>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label
                    class="col-form-label text-md-right col-12 col-md-4 col-lg-4"
                    for="postcode">Post Code
                    <span class="required">*</span>
                    :</label>
                <div class="col-sm-12 col-md-6">
                    <input
                        type="text"
                        id="postcode"
                        class="form-control "
                        name="postcode"
                        @if( !empty($userdata['user_profile'] ) )
                        value="{{$userdata['user_profile']['postcode']}}"
                        @endif
                        required
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
<div class="col-sm-6 col-md-4">
    <h1>Your order</h1>
    <div id="order_review" class="maz-checkout-review-order">
        <table class="shop_table maz-checkout-review-order-table" width='90%'>
            <thead>
                <tr>
                    <th class="product-name">Product</th>
                    <th class="product-total" style='padding-left:2rem;'>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr class="cart_item">
                    <td class="product-name" style='padding-left:1rem;'>
                        {{$pay_name}}&nbsp;
                        <strong class="product-quantity">×&nbsp;1</strong>
                    </td>
                    <td class="product-total amount">
                        <span class="maz-Price-amount amount">
                            <bdi >
                            <span class="maz-Price-currencySymbol"> € </span>{{$pay_price}}</bdi>
                            <input type='hidden' name='pay_price' value='{{$pay_price}}' />    
                            <input type='hidden' name='pay_qty' value='1' />    
                        </span>
                    </td>
                </tr>
                @if( !empty( $coupon ))
                <tr class="cart_item">
                    <td class="product-name" style='padding-left:1rem;'>
                        coupon : {{$checkout_payment_coupon }}&nbsp;
                    </td>
                    <td class="product-total amount">
                        <span class="maz-Price-amount amount">
                            <bdi>
                            <span class="maz-Price-currencySymbol"> - € </span>{{$coupon}}</bdi>
                            <input type='hidden' name='pay_coupon' value='{{$coupon}}' />    
                            <input type='hidden' name='coupon_code' value='{{$checkout_payment_coupon}}' />    
                        </span>
                    </td>
                </tr>
                @endif
            </tbody>
            <tfoot>

                <tr class="cart-subtotal">
                    <th>Subtotal</th>
                    <td class="product-total amount">
                        <span class="maz-Price-amount amount">
                            <bdi>
                            <span class="maz-Price-currencySymbol">€ </span>{{$pay_price-$coupon}}</bdi>
                        </span>
                    </td>
                </tr>
                <tr class="cart-subtotal">
                    <td style='padding-left:1rem;'>fee</td>
                    <td class="product-total amount">
                        <span class="maz-Price-amount amount">
                            <bdi>
                            <span class="maz-Price-currencySymbol">€ </span>{{$pay_amount - $pay_price + $coupon}}</bdi>
                        </span>
                    </td>
                </tr>
                <tr class="order-total">
                    <th>Total</th>
                    <td class="product-total amount">
                        <strong>
                            <span class="maz-Price-amount amount total">
                                <bdi>
                                <span class="maz-Price-currencySymbol Total">€ </span>{{$pay_amount}}</bdi>
                            </span>
                        </strong>
                    </td>
                </tr>

            </tfoot>
        </table>
<script>
    var winstyle = 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700';
    var winurl = 'https://www.paypal.com/us/webapps/mpp/paypal-popup';
</script>

        <div id="payment" class="maz-checkout-payment">
            <ul class="wc_payment_methods payment_methods methods">
                @if(env('use_stripe'))
                <li class="wc_payment_method payment_method_bacs">
                    <input
                        id="payment_method_bacs"
                        type="radio"
                        class="input-radio"
                        onclick="chenge_method(event, this)"
                        name="payment_method"
                        value="paybox_stripe"
                        style="float:left;margin-right:9px;"
                        data-order_button_text="Proceed to Stripe  "/>

                    <label for="payment_method_bacs">
                        Stripe&nbsp;
                        <img src="{{asset('/assets/images/stripe_bar.png')}}" 
                            style='margin-left:2rem;width:200px;'
                            alt="Stripe acceptance mark" />
                    </label>
                    <div class="payment_box payment_method_bacs" style="display:none;">
                        <p>Make your payment directly into our bank account. Please use your Order ID as
                            the payment reference. Your order will not be shipped until the funds have
                            cleared in our account.</p>
                    </div>
                </li>
                @endif
                @if(env('use_paypal'))
                <li class="wc_payment_method payment_method_paypal">
                    <input
                        id="payment_method_paypal"
                        type="radio"
                        class="input-radio"
                        onclick="chenge_method(event, this)"
                        name="payment_method"
                        value="paybox_paypal"
                        checked="checked"
                        style="float:left;margin-right:9px;"
                        data-order_button_text="Proceed to PayPal"/>
                    <label for="payment_method_paypal">
                        PayPal
                        <img src="{{asset('/assets/images/paypal_bar.png')}}" 
                                style='margin-left:2rem;width:200px;'
                                alt="PayPal acceptance mark" />
                    </label>
                    <div class="payment_box payment_method_paypal">
                        <p style='padding-left:3rem;'>Pay via <a
                            href="https://www.paypal.com/us/webapps/mpp/paypal-popup"
                            class="about_paypal"
                            onclick="window.open(winurl,'WIPaypal',winstyle); return false;">
                                    PayPal</a>; you can pay with your credit card if you don’t have a PayPal
                            account.</p>
                    </div>
                    
                </li>
                @endif
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
                            <a href="{{route('page', 'privacy-policy#pageview')}}" class="maz-privacy-policy-link" target="_blank">privacy policy</a>.</p>
                    </div>
                </div>

                <button
                    id='submitButton'
                    type="submit"
                    class="button alt  btn btn-primary"
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
    function chenge_method(evt, obj)
    {
        $('#submitButton').html($(obj).attr('data-order_button_text'));
    }
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

