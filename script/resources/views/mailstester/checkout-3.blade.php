@extends('mailstester.layout')

@section('content')
<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">

        <div id="system-message-container"></div>

        <div
            id="mailtester_cart_checkout_page"
            class="mailtester_cart_checkout_page mailtester_cart_checkout_page_step2">
            <div class="mailtester_cart_wizardbar">
                <ul>
                    <li class="mailtester_cart_cart_step_finished">
                        <span class="badge badge-success">1</span>
                        <a
                            href="{{ route('checkout', 'step1') }}">
                            Address
                        </a>
                        <span class="mailtester_cart_chevron"></span>
                    </li>

                    <li class="mailtester_cart_cart_step_finished">
                        <span class="badge badge-success">2</span>
                        <a
                            href="{{ route('checkout', 'step2') }}">
                            Payment
                        </a>
                        <span class="mailtester_cart_chevron"></span>
                    </li>

                    <li class="mailtester_cart_cart_step_current">
                        <span class="badge badge-info">3</span>
                        Cart
                        <span class="mailtester_cart_chevron"></span>
                    </li>

                    <li class="">
                        <span class="badge badge-">4</span>
                        <a class='disabled' disabled >
                            End
                        </a>
                        <span class="mailtester_cart_chevron"></span>
                    </li>

                </ul>
            </div>
            <form
                action="{!! URL::route('buy_mail_test') !!}"
                method="post"
                name="mailtester_cart_checkout_form"
                id="mailtester_checkout_form"
                enctype="multipart/form-data" >
                @csrf
                <input type='hidden' name='buyMode' value='{{$checkout_payment_mode}}'>
                <input type='hidden' name='pay_name' value='{{$pay_name}}'>
                <input type='hidden' name='pay_coupon' value='{{$checkout_payment_coupon}}'>
                
                <div id="mailtester_cart_checkout_cart" class="mailtester_cart_checkout_cart">
                    <br/>
                    <table class="table table-striped table-hover" width="100%">
                        <thead>
                            <tr>
                                <th
                                    id="mailtester_cart_cart_product_image_title"
                                    class="mailtester_cart_cart_product_image_title mailtester_cart_cart_title">
                                    Image
                                </th>
                                <th
                                    id="mailtester_cart_cart_product_name_title"
                                    class="mailtester_cart_cart_product_name_title mailtester_cart_cart_title">
                                    Name
                                </th>
                                <th
                                    id="mailtester_cart_cart_product_price_title"
                                    class="mailtester_cart_cart_product_price_title mailtester_cart_cart_title">
                                    Unit price
                                </th>
                                <th
                                    id="mailtester_cart_cart_product_quantity_title"
                                    class="mailtester_cart_cart_product_quantity_title mailtester_cart_cart_title">
                                    Quantity
                                </th>
                                <th
                                    id="mailtester_cart_cart_product_total_title"
                                    class="mailtester_cart_cart_product_total_title mailtester_cart_cart_title">
                                    Total price
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="row0">
                                <td data-title="Image" class="mailtester_cart_cart_product_image_value">
                                    <div class="mailtester_cart_cart_product_image_thumb">
                                        <img
                                            class="mailtester_cart_product_checkout_cart_image"
                                            title=""
                                            alt="snail"
                                            src="/assets/images/snail.png"/>
                                    </div>
                                </td>
                                <td data-title="Name" class="mailtester_cart_cart_product_name_value">
                                    <p class="mailtester_cart_cart_product_name">
                                        <a
                                            class="mailtester_cart_no_print"
                                            href="/mailtester_cart/product/1-500-tests.html?Itemid=0">
                                            {{ $pay_name }}
                                        </a>
                                    </p>
                                </td>
                                <td data-title="Unit price" class="mailtester_cart_cart_product_price_value">
                                    <span class="mailtester_cart_product_price_full">
                                        <span class="mailtester_cart_product_price">{{ $pay_price }} €</span>
                                        <input type="hidden" id="mail_price"    name="pay_price"    value="{{$pay_price}}" />
                                    </span>
                                    <span class="visible-phone">
                                        each</span>
                                </td>
                                <td data-title="Quantity" class="mailtester_cart_cart_product_quantity_value">
                                    <input
                                        id="mailtester_cart_checkout_quantity_27201"
                                        type="number"
                                        name="pay_qty"
                                        class="mailtester_cart_product_quantity_field"
                                        value="{{ $pay_qty }}"
                                        />
                                    <div class="mailtester_cart_cart_product_quantity_refresh">
                                        <a
                                            class="mailtester_cart_no_print"
                                            href="{{ route('checkout', 'step3') }}"
                                            onclick="var qty_field = document.getElementById('mailtester_cart_checkout_quantity_27201'); if (qty_field && qty_field.value != '1'){ qty_field.value = '1';requery(); } return false;"
                                            title="Refresh">
                                            <img src="/assets/images/refresh.png" alt="Refresh"/>
                                        </a>
                                    </div>
                                    <div class="mailtester_cart_cart_product_quantity_delete">
                                        <a
                                            class="mailtester_cart_no_print"
                                            href="/checkout/product/updatecart/quantity-0/return_url-aHR0cHM6Ly93d3cubWFpbC10ZXN0ZXIuY29tL21hbmFnZXIvY2hlY2tvdXQvY2hlY2tvdXQvdGFzay1zdGVwL3N0ZXAtMi5odG1s/cid-1.html"
                                            onclick="var qty_field = document.getElementById('mailtester_cart_checkout_quantity_27201'); if(qty_field){qty_field.value=0;  requery();} return false;"
                                            title="Delete">
                                            <img src="/assets/images/delete2.png" alt="Delete"/>
                                        </a>
                                    </div>
                                </td>
                                <td data-title="Total price" class="mailtester_cart_cart_product_total_value">
                                    <span class="mailtester_cart_product_price_full">
                                        <span class="mailtester_cart_product_price">{{ number_format ($pay_price * $pay_qty, 2, ',' , ' ') }} €</span>
                                    </span>
                                </td>
                            </tr>

                            <tr class="margin">
                                <td colspan="3" class="mailtester_cart_cart_empty_footer"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="mailtester_cart_cart_empty_footer"></td>
                                <td
                                    id="mailtester_cart_checkout_cart_total2_title"
                                    class="mailtester_cart_cart_subtotal_title mailtester_cart_cart_title">
                                    Subtotal
                                </td>
                                <td class="mailtester_cart_cart_subtotal_value" data-title="Subtotal">
                                    <span class="mailtester_cart_checkout_cart_subtotal">
                                        {{ number_format ($pay_price * $pay_qty, 2, ',' , ' ') }} €
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="mailtester_cart_cart_empty_footer"></td>
                                <td
                                    id="mailtester_cart_checkout_cart_tax_title"
                                    class="mailtester_cart_cart_tax_title mailtester_cart_cart_title">
                                    VAT (ES)
                                </td>
                                <td class="mailtester_cart_cart_tax_value" data-title="VAT (ES)">
                                    <span class="mailtester_cart_checkout_cart_taxes">
                                        {{ number_format ($pay_price * $pay_qty *  env('VAT_FEE')  / 100.0, 2, ',' , ' ') }} €
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="mailtester_cart_cart_empty_footer"></td>
                                <td
                                    id="mailtester_cart_checkout_cart_final_total_title"
                                    class="mailtester_cart_cart_total_title mailtester_cart_cart_title">
                                    Total
                                </td>
                                <td class="mailtester_cart_cart_total_value" data-title="Total">
                                    <span class="mailtester_cart_checkout_cart_final_total">
                                    {{ number_format ($pay_price * $pay_qty * (100+ env('VAT_FEE') )/100.0, 2, ',' , ' ') }} €
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br/>
                <span id="mailtester_cart_checkout_status">
                    You chose the payment method:
                    <span class="label label-info">
                        @if( $checkout_payment_mode=='paybox_paypal' )
                            Paypal
                        @elseif( $checkout_payment_mode=='paybox_stripe' )
                            Stripe
                        @else 
                            Error!
                        @endif
                    </span>
                </span>
                <div class="clear_both"></div>
                <!-- <input type="hidden" name="Itemid" value="168"/>
                <input type="hidden" name="option" value="com_mailtester_cart"/>
                <input type="hidden" name="ctrl" value="checkout"/>
                <input type="hidden" name="task" value="step"/> -->
                <input type="hidden" name="previous" value="step2"/>
                <input type="hidden" name="step" value="3"/>
                <!-- <input type="hidden" id="mailtester_cart_validate" name="validate" value="0"/>
                <input type="hidden" name="45adedc08584ba24ea6f3e97d550bc4a" value="1"/> -->
                <input
                    type="submit"
                    class="btn button mailtester_cart_cart_input_button"
                    name="next"
                    value="Finish"
                    id="mailtester_cart_checkout_next_button"/>
            </form>
        </div>
        <div class="clear_both"></div>
    </div>
</div>
<style>
    #mailtester_cart_checkout_next_button
    {
        color:#fff !important;
    }

    input#mailtester_cart_checkout_quantity_27201.mailtester_cart_product_quantity_field
    {
        width:40px;
        margin-left:60px !important;
    }
</style>
<script>
    function requery()
    {
        $('#mailtester_checkout_form').attr('action', "{{route('checkout', 'step3')}}");
        $('#mailtester_checkout_form').submit();
    }
    </script>
@endsection