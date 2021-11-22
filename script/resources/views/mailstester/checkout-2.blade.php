@extends('mailstester.layout')

@section('content')
<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">

        <div id="system-message-container"></div>

        <div
            id="mailtester_cart_checkout_page"
            class="mailtester_cart_checkout_page mailtester_cart_checkout_page_step1">
            <div class="mailtester_cart_wizardbar">
                <ul>
                    <li class="mailtester_cart_cart_step_finished">
                        <span class="badge badge-success">1</span>
                        <a
                            href="{{ route('checkout', 'step1')}}">
                            Address
                        </a>
                        <span class="mailtester_cart_chevron"></span>
                    </li>

                    <li class="mailtester_cart_cart_step_current">
                        <span class="badge badge-info">2</span>
                        Payment
                        <span class="mailtester_cart_chevron"></span>
                    </li>

                    <li class="">
                        <span class="badge badge-">3</span>
                        <a
                            href="{{ route('checkout', 'step3')}}">
                            Cart
                        </a>
                        <span class="mailtester_cart_chevron"></span>
                    </li>

                    <li class="">
                        <span class="badge badge-">4</span>
                        <a
                            href="{{ route('checkout', 'step4')}}">
                            End
                        </a>
                        <span class="mailtester_cart_chevron"></span>
                    </li>

                </ul>
            </div>
            <form
                action="{{ route('checkout', 'step3')}}"
                method="post"
                name="mailtester_cart_checkout_form"
                enctype="multipart/form-data" >
                @csrf
                <div id="mailtester_payment_methods" class="mailtester_payment_methods">
                    <fieldset>
                        <legend>Payment method</legend>
                        <div class="controls">
                            <div class="hika-radio">
                                <table class="mailtester_payment_methods_table table table-striped table-hover">
                                    <tbody>
                                        <tr class="row0">
                                            <td>
                                                
                                                <label class="btn btn-radio btn-primary checked @if( $checkout_payment_mode=='paybox_stripe' ) active @endif" style='width:100px;' for="radio_paybox_stripe" onclick='toggle_check(event, this)'>
                                                    <input
                                                        class="mailtester_cart_checkout_payment_radio"
                                                        id="radio_paybox_stripe"
                                                        type="radio"
                                                        name="mailtester_payment"
                                                        value="paybox_stripe"
                                                        @if( $checkout_payment_mode=='paybox_stripe' )
                                                        checked="checked" 
                                                        @endif
                                                        onclick='return false;' />
                                                    Stripe</label>
                                                <span class="mailtester_cart_checkout_payment_image">
                                                    <img src="{{asset('/assets/images/stripe_bar.png')}}" alt=""/>
                                                </span>
                                                <div class="mailtester_cart_checkout_payment_description">
                                                    <p>Pay with your stripe account</p>
                                                </div>
                                                <div class="ccinfo">
                                                    <div style="margin: 0px; position: static; overflow: hidden;">
                                                        <div style="margin: 0px; position: static; overflow: hidden;">
                                                            <div
                                                                id="mailtester_cart_credit_card_paybox_2"
                                                                class="mailtester_cart_credit_card"
                                                                style="margin: 0px; overflow: hidden;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="row0">
                                            <td onclick="">
                                                <label class="btn btn-radio  checked @if( $checkout_payment_mode=='paybox_paypal' ) active @endif" for="radio_paybox_paypal" style='width:100px;'  onclick='toggle_check(event, this)'>
                                                    <input
                                                        class="mailtester_cart_checkout_payment_radio"
                                                        id="radio_paybox_paypal"
                                                        type="radio"
                                                        name="mailtester_payment"
                                                        value="paybox_paypal"
                                                        @if( $checkout_payment_mode=='paybox_paypal' )
                                                        checked="checked" 
                                                        @endif                                                        
                                                        />
                                                    Paypal</label>
                                                <span class="mailtester_cart_checkout_payment_image">
                                                    <img src="{{asset('/assets/images/paypal_bar.png')}}" alt=""/>
                                                </span>
                                                <div class="mailtester_cart_checkout_payment_description">
                                                    <p>Pay with your Paypal account</p>
                                                </div>
                                                <div class="ccinfo">
                                                    <div style="margin: 0px; position: static; overflow: hidden; height: 0px;">
                                                        <div style="margin: 0px; position: static; overflow: hidden; height: 0px;">
                                                            <div
                                                                id="mailtester_cart_credit_card_paypal_1"
                                                                class="mailtester_cart_credit_card"
                                                                style="margin: 0px; overflow: hidden;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <span class="mailtester_cart_checkout_coupon" id="mailtester_cart_checkout_coupon">
                    Do you have a coupon? Enter it here
                    <input id="mailtester_cart_checkout_coupon_input" type="text" 
                            name="coupon" value="{{$checkout_payment_coupon}}"/>
                    <input
                        type="button"
                        class="btn button mailtester_checkout_input_button"
                        name="refresh"
                        value="Add"
                        onclick="return mailtester_cartCheckCoupon('mailtester_cart_checkout_coupon_input');"/>
                </span>
                <!-- <input type="hidden" name="Itemid" value="168"/>
                <input type="hidden" name="option" value="com_mailtester_cart"/>
                <input type="hidden" name="ctrl" value="checkout"/>
                <input type="hidden" name="task" value="step"/> -->
                <input type="hidden" name="previous" value="step1"/>
                <input type="hidden" name="step" value="2"/>
                <!-- <input type="hidden" id="mailtester_cart_validate" name="validate" value="0"/>
                <input type="hidden" name="45adedc08584ba24ea6f3e97d550bc4a" value="1"/> -->

                <input
                    type="hidden"
                    name="unique_id"
                    value="[3ca139d758b38e2c28e29940d4bb0ccd]"/>
                <br style="clear:both"/>
                <input
                    type="submit"
                    class="btn button mailtester_checkout_input_button"
                    name="next"
                    value="Next"
                    id="mailtester_cart_checkout_next_button" />
            </form>
        </div>
        <div class="clear_both"></div>
    </div>
</div>

<script>
    function toggle_check(event, obj)
    {
        $('label.checked').removeClass('active');
        $(obj).addClass('active');
        $('#' + $(obj).attr('for')).prop('checked',  true);
        //alert();
        //alert($('#radio_paybox_stripe').prop('checked'));
    }
    </script>
    <style>
        #mailtester_cart_checkout_coupon_input
        {
            padding:12px !important;
        }
        .mailtester_checkout_input_button
        {
            padding:0 12px 0 12px !important;
            color:#fff !important;
        }
        label.checked
        {
            text-align:right;
            padding-right:2rem;
            padding-left:0rem;
        }
    </style>
@endsection