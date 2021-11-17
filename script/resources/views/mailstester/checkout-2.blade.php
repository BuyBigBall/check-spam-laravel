@extends('mailstester.layout')

@section('content')
<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">

        <div id="system-message-container"></div>

        <div
            id="hikashop_checkout_page"
            class="hikashop_checkout_page hikashop_checkout_page_step1">
            <div class="hikashop_wizardbar">
                <ul>
                    <li class="hikashop_cart_step_finished">
                        <span class="badge badge-success">1</span>
                        <a
                            href="{{ route('checkout', 'step1')}}">
                            Address
                        </a>
                        <span class="hikashop_chevron"></span>
                    </li>

                    <li class="hikashop_cart_step_current">
                        <span class="badge badge-info">2</span>
                        Payment
                        <span class="hikashop_chevron"></span>
                    </li>

                    <li class="">
                        <span class="badge badge-">3</span>
                        <a
                            href="{{ route('checkout', 'step3')}}">
                            Cart
                        </a>
                        <span class="hikashop_chevron"></span>
                    </li>

                    <li class="">
                        <span class="badge badge-">4</span>
                        <a
                            href="{{ route('checkout', 'step4')}}">
                            End
                        </a>
                        <span class="hikashop_chevron"></span>
                    </li>

                </ul>
            </div>
            <form
                action="{{ route('checkout', 'step2')}}"
                method="post"
                name="hikashop_checkout_form"
                enctype="multipart/form-data"
                onsubmit="if('function' == typeof(hikashopSubmitForm)) { hikashopSubmitForm('hikashop_checkout_form'); return false; } else { return true; }">
                <div id="hikashop_payment_methods" class="hikashop_payment_methods">
                    <fieldset>
                        <legend>Payment method</legend>
                        <div class="controls">
                            <div class="hika-radio">
                                <table class="hikashop_payment_methods_table table table-striped table-hover">
                                    <tbody>
                                        <tr class="row0">
                                            <td>
                                                <input
                                                    class="hikashop_checkout_payment_radio"
                                                    id="radio_paybox_2"
                                                    type="radio"
                                                    name="hikashop_payment"
                                                    value="paybox_2"
                                                    checked="checked"/>
                                                <label class="btn btn-radio active btn-primary" for="radio_paybox_2">Credit Card</label>
                                                <span class="hikashop_checkout_payment_cost"></span>
                                                <span class="hikashop_checkout_payment_image">
                                                    <img src="/assets/images/MasterCard.jpg" alt=""/>
                                                    <img src="/assets/images/VISA.jpg" alt=""/>
                                                    <img src="/assets/images/Credit_card.jpg" alt=""/>
                                                </span>
                                                <div class="hikashop_checkout_payment_description">
                                                    <p>Pay with a Visa, Master Card, Blue Card or e-Card</p>
                                                </div>
                                                <div class="ccinfo">
                                                    <div style="margin: 0px; position: static; overflow: hidden;">
                                                        <div style="margin: 0px; position: static; overflow: hidden;">
                                                            <div
                                                                id="hikashop_credit_card_paybox_2"
                                                                class="hikashop_credit_card"
                                                                style="margin: 0px; overflow: hidden;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="row1">
                                            <td>
                                                <input
                                                    class="hikashop_checkout_payment_radio"
                                                    id="radio_paybox_3"
                                                    type="radio"
                                                    name="hikashop_payment"
                                                    value="paybox_3"
                                                    onclick="this.form.action=this.form.action+'#hikashop_payment_methods';this.form.submit(); return false;"/>
                                                <label class="btn btn-radio" for="radio_paybox_3">American Express</label>
                                                <span class="hikashop_checkout_payment_cost"></span>
                                                <span class="hikashop_checkout_payment_image">
                                                    <img src="/assets/images/AMEX.gif" alt=""/>
                                                </span>
                                                <div class="hikashop_checkout_payment_description">
                                                    <p>Pay with your American Express Card</p>
                                                </div>
                                                <div class="ccinfo">
                                                    <div style="margin: 0px; position: static; overflow: hidden; height: 0px;">
                                                        <div style="margin: 0px; position: static; overflow: hidden; height: 0px;">
                                                            <div
                                                                id="hikashop_credit_card_paybox_3"
                                                                class="hikashop_credit_card"
                                                                style="margin: 0px; overflow: hidden;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="row0">
                                            <td>
                                                <input
                                                    class="hikashop_checkout_payment_radio"
                                                    id="radio_paypal_1"
                                                    type="radio"
                                                    name="hikashop_payment"
                                                    value="paypal_1"
                                                    onclick="this.form.action=this.form.action+'#hikashop_payment_methods';this.form.submit(); return false;"/>
                                                <label class="btn btn-radio" for="radio_paypal_1">Paypal</label>
                                                <span class="hikashop_checkout_payment_cost"></span>
                                                <span class="hikashop_checkout_payment_image">
                                                    <img src="/assets/images/PayPal.jpg" alt=""/>
                                                </span>
                                                <div class="hikashop_checkout_payment_description">
                                                    <p>Pay with your Paypal account</p>
                                                </div>
                                                <div class="ccinfo">
                                                    <div style="margin: 0px; position: static; overflow: hidden; height: 0px;">
                                                        <div style="margin: 0px; position: static; overflow: hidden; height: 0px;">
                                                            <div
                                                                id="hikashop_credit_card_paypal_1"
                                                                class="hikashop_credit_card"
                                                                style="margin: 0px; overflow: hidden;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <script type="text/javascript">
                                (function ($) {
                                    $("#hikashop_payment_methods .hika-radio input:checked").each(function () {
                                        $("label[for=" + jQuery(this).attr('id') + "]").addClass('active btn-primary');
                                    });
                                    $("#hikashop_payment_methods .hika-radio input").change(function () {
                                        $(this)
                                            .parents('div.hika-radio')
                                            .find('label.active')
                                            .removeClass('active btn-primary');
                                        $("label[for=" + jQuery(this).attr('id') + "]").addClass('active btn-primary');
                                    });
                                })(jQuery);
                            </script>
                        </div>
                    </fieldset>
                </div>
                <span class="hikashop_checkout_coupon" id="hikashop_checkout_coupon">
                    Do you have a coupon? Enter it here
                    <input id="hikashop_checkout_coupon_input" type="text" name="coupon" value=""/>
                    <input
                        type="button"
                        class="btn button hikashop_cart_input_button"
                        name="refresh"
                        value="Add"
                        onclick="return hikashopCheckCoupon('hikashop_checkout_coupon_input');"/>
                </span>
                <input type="hidden" name="Itemid" value="168"/>
                <input type="hidden" name="option" value="com_hikashop"/>
                <input type="hidden" name="ctrl" value="checkout"/>
                <input type="hidden" name="task" value="step"/>
                <input type="hidden" name="previous" value="1"/>
                <input type="hidden" name="step" value="2"/>
                <input type="hidden" id="hikashop_validate" name="validate" value="0"/>
                <input type="hidden" name="45adedc08584ba24ea6f3e97d550bc4a" value="1"/>

                <input
                    type="hidden"
                    name="unique_id"
                    value="[3ca139d758b38e2c28e29940d4bb0ccd]"/>
                <br style="clear:both"/>
                <input
                    type="submit"
                    class="btn button hikashop_cart_input_button"
                    name="next"
                    value="Next"
                    onclick="var field=document.getElementById('hikashop_product_quantity_field_2');if(hikashopCheckChangeForm('order','hikashop_checkout_form')){ if(hikashopCheckMethods()){ document.getElementById('hikashop_validate').value=1; this.disabled = true; document.forms['hikashop_checkout_form'].submit();}} return false;"
                    id="hikashop_checkout_next_button"/>
            </form>
        </div>
        <div class="clear_both"></div>
    </div>
</div>
@endsection