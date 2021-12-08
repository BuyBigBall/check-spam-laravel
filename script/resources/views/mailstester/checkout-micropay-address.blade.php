@extends('layouts.guest')

@section('checkout_payment_js')
<script type="text/javascript">
	$(window).on("load", function () {
		$(".preloader").fadeOut("slow");
		$(".checkout-micropayment").css('background-color', '#a7a5df');
	});
    function chenge_method(evt, obj)
    {
        $('#submitButton').val($(obj).attr('data-order_button_text'));
        $('#payment_method').val();
    }

    function check_validation()
    {
        if($('#address_firstname').val()=="") 
        {
            alert("please input your first name.");
            $('#address_firstname').focus();
            return false;
        }
        if($('#address_lastname').val()=="") 
        {
            alert("please input your last name.");
            $('#address_lastname').focus();
            return false;
        }
        if($('#user_email').val()=="") 
        {
            alert("please input your email address.");
            $('#user_email').focus();
            return false;
        }
        if(! (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($('#user_email').val())) )
        {
            alert("please input your email address.");
            $('#user_email').focus();
            return (false);
        }
        return true;
    }
	</script>
@endsection		


@section('content')
<!-- Blog Section Start -->
<section class="blog checkout-micropayment d-flex align-items-center">
    <div id="micropaymentpage" class="container">
        <div id="navigationbar">
            <ul>
                <li><span class="stepnumber">1</span>Plan</li>
                <li><span class="stepnumber">2</span>Payment</li>
            </ul>
        </div>
        <div id="bottompicture"></div>
        <?php  $micropay_plan = App\Http\Controllers\Mailstester\PaymentController::$micropay_plans[$plan_id]; ?>
        <form
            method="post"
            onsubmit="return check_validation();"
            action="{{ route('micropay_sitepay') }}">
            @csrf    
            <div class="stepcontent">
                <div id="addressarea">
                    <label for="address_firstname" style="float:left;width:55%;">
                        <input
                        required="required"
                            style="width:82%;margin-right:18%;"
                            placeholder="First name"
                            id="address_firstname"
                            type="text"
                            name="firstname"
                            value=""/></label>
                    <label for="address_lastname" style="float:left;width:45%;">
                        <input
                            required="required"
                            style="width:100%;"
                            placeholder="Last name"
                            id="address_lastname"
                            type="text"
                            name="lastname"
                            value=""/></label>
                    <label for="user_email" style="clear:both;width:100%;">
                        <input
                            required="required"
                            style="width:100%;"
                            placeholder="Email address"
                            id="user_email"
                            type="email"
                            name="guest_email"
                            value=""/>
                        <span style="display:none" id="emailerror"></span>
                    </label>
                    <label for="address_country" style="width:100%;">
                        <span style="padding-right:20px;display:inline-table;">Country :</span>
                        <select id="address_country" name="country" size="1" style="width:auto;">
                            @foreach(App\Http\Controllers\Mailstester\PaymentController::$countries as $key=>$country)
	                        <option value="{{$key}}">{{$country}}</option>
                            @endforeach
                        </select>
                    </label>
<script>
    var winstyle = 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700';
    var winurl = 'https://www.paypal.com/us/webapps/mpp/paypal-popup';
</script>

                    <div id="paymentmethods" style="width: 100%;margin:auto;text-align: center">
                        <!-- <img
                            class="paymentmethod selected"
                            rel="2_paybox"
                            src="./Checkout-micropayment2_files/mastercard.png"/>
                        <img
                            class="paymentmethod"
                            rel="2_paybox"
                            src="./Checkout-micropayment2_files/visa.png"/>
                        <img
                            class="paymentmethod"
                            rel="2_paybox"
                            src="./Checkout-micropayment2_files/credit_card.png"/>
                        <img
                            class="paymentmethod"
                            rel="3_paybox"
                            src="./Checkout-micropayment2_files/amex.png"/>
                        <img
                            class="paymentmethod"
                            rel="1_paypal"
                            src="./Checkout-micropayment2_files/paypal.png"/> -->
                        <ul class="wc_payment_methods payment_methods methods">
                        <li class="wc_payment_method payment_method_bacs">
                            <input
                                id="payment_method_bacs"
                                type="radio"
                                class="input-radio"
                                onclick="chenge_method(event, this)"
                                name="payment_method"
                                value="paybox_stripe"
                                style="float:left;margin-top:9px;"
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
                        <li class="wc_payment_method payment_method_paypal">
                            <input
                                id="payment_method_paypal"
                                type="radio"
                                class="input-radio"
                                onclick="chenge_method(event, this)"
                                name="payment_method"
                                value="paybox_paypal"
                                checked="checked"
                                style="float:left;margin-top:9px;"
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
                    </ul>
                    </div>
                    <label for="needinvoice">
                        <input type="checkbox" value="1" name="needinvoice" id="needinvoice"/>
                        I need an invoice
                    </label>
                    <div id="billinginformation" style="display:none;">
                        <label for="address_company" style="clear:both;width:100%;">
                            <input
                                style="width:100%;"
                                placeholder="Company name"
                                id="address_company"
                                type="text"
                                name="data[address][address_company]"
                                value=""/></label>
                        <label for="address_vat" style="clear:both;width:100%;">
                            <input
                                style="width:100%;"
                                placeholder="VAT number (for EU companies only)"
                                id="address_vat"
                                type="text"
                                name="data[address][address_vat]"
                                value=""/>
                            <span style="display:none" id="vaterror"></span>
                        </label>
                        <label for="address_street" style="clear:both;width:100%;">
                            <input
                                style="width:100%;"
                                placeholder="Address"
                                id="address_street"
                                type="text"
                                name="data[address][address_street]"
                                value=""/></label>
                        <label for="address_post_code" style="float:left;width:40%;">
                            <input
                                style="width:80%;margin-right:20%"
                                placeholder="Postcode"
                                id="address_post_code"
                                type="text"
                                name="data[address][address_post_code]"
                                value=""/></label>
                        <label for="address_city" style="float:left;width:60%;">
                            <input
                                style="width:100%;"
                                placeholder="City"
                                id="address_city"
                                type="text"
                                name="data[address][address_city]"
                                value=""/></label>
                        <div class="extratext">You will receive a PDF invoice via email once the purchase completed</div>
                    </div>
                    <div style="clear:both"></div>
                    <input type="hidden" name="plan_id" value="{{ $plan_id }}"/>
                    <input type="hidden" name="mailbox" value="{{ $mailbox }}"/>
                    <input type="hidden" name="mail_id" value="{{ $mail_id }}"/>
                    <input type="hidden" name="owner_id" value="{{ $owner->id }}"/>
                    <input type="hidden" name="pay_price" value="{{ $micropay_plan['amount'] }}"/>
                </div>
                <div id="price" style="opacity: 0.5;">Total price :<br/>
                    <br/>{{ $micropay_plan['amount'] }} {{$micropay_plan['unit']}}</div>
                <div style="clear:both"></div>
                <div class="nextstep"><input type="submit" id="submitButton" 
                            class="btn btn-primary" value="Proceed to PayPal"/></div>
            </div>
        </form>
    </div>
</section>
 @endsection