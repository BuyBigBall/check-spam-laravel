@extends('mailstester.layout')

@section('content')
<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">

        <div id="system-message-container"></div>

        <div
            id="hikashop_checkout_page"
            class="hikashop_checkout_page hikashop_checkout_page_step2">
            <div class="hikashop_wizardbar">
                <ul>
                    <li class="hikashop_cart_step_finished">
                        <span class="badge badge-success">1</span>
                        <a
                            href="{{ route('checkout', 'step1') }}">
                            Address
                        </a>
                        <span class="hikashop_chevron"></span>
                    </li>

                    <li class="hikashop_cart_step_finished">
                        <span class="badge badge-success">2</span>
                        <a
                            href="{{ route('checkout', 'step2') }}">
                            Payment
                        </a>
                        <span class="hikashop_chevron"></span>
                    </li>

                    <li class="hikashop_cart_step_current">
                        <span class="badge badge-info">3</span>
                        Cart
                        <span class="hikashop_chevron"></span>
                    </li>

                    <li class="">
                        <span class="badge badge-">4</span>
                        <a
                            href="{{ route('checkout', 'step4') }}">
                            End
                        </a>
                        <span class="hikashop_chevron"></span>
                    </li>

                </ul>
            </div>
            <form
                action="{{ route('checkout', 'step3') }}"
                method="post"
                name="hikashop_checkout_form"
                enctype="multipart/form-data"
                onsubmit="if('function' == typeof(hikashopSubmitForm)) { hikashopSubmitForm('hikashop_checkout_form'); return false; } else { return true; }">
                <div id="hikashop_checkout_cart" class="hikashop_checkout_cart">
                    <br/>
                    <table class="table table-striped table-hover" width="100%">
                        <thead>
                            <tr>
                                <th
                                    id="hikashop_cart_product_image_title"
                                    class="hikashop_cart_product_image_title hikashop_cart_title">
                                    Image
                                </th>
                                <th
                                    id="hikashop_cart_product_name_title"
                                    class="hikashop_cart_product_name_title hikashop_cart_title">
                                    Name
                                </th>
                                <th
                                    id="hikashop_cart_product_price_title"
                                    class="hikashop_cart_product_price_title hikashop_cart_title">
                                    Unit price
                                </th>
                                <th
                                    id="hikashop_cart_product_quantity_title"
                                    class="hikashop_cart_product_quantity_title hikashop_cart_title">
                                    Quantity
                                </th>
                                <th
                                    id="hikashop_cart_product_total_title"
                                    class="hikashop_cart_product_total_title hikashop_cart_title">
                                    Total price
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="row0">
                                <td data-title="Image" class="hikashop_cart_product_image_value">
                                    <div class="hikashop_cart_product_image_thumb">
                                        <img
                                            class="hikashop_product_checkout_cart_image"
                                            title=""
                                            alt="snail"
                                            src="/assets/images/snail.png"/>
                                    </div>
                                </td>
                                <td data-title="Name" class="hikashop_cart_product_name_value">
                                    <p class="hikashop_cart_product_name">
                                        <a
                                            class="hikashop_no_print"
                                            href="/hikashop/product/1-500-tests.html?Itemid=0">
                                            500 tests
                                        </a>
                                    </p>
                                </td>
                                <td data-title="Unit price" class="hikashop_cart_product_price_value">
                                    <span class="hikashop_product_price_full">
                                        <span class="hikashop_product_price">50,00 €</span>
                                    </span>
                                    <span class="visible-phone">
                                        each</span>
                                </td>
                                <td data-title="Quantity" class="hikashop_cart_product_quantity_value">
                                    <input
                                        id="hikashop_checkout_quantity_27201"
                                        type="text"
                                        name="item[27201]"
                                        class="hikashop_product_quantity_field"
                                        value="1"
                                        onchange="var qty_field = document.getElementById('hikashop_checkout_quantity_27201'); if (qty_field){}; return true;"/>
                                    <div class="hikashop_cart_product_quantity_refresh">
                                        <a
                                            class="hikashop_no_print"
                                            href="{{ route('checkout', 'step3') }}"
                                            onclick="var qty_field = document.getElementById('hikashop_checkout_quantity_27201'); if (qty_field &amp;&amp; qty_field.value != '1'){ qty_field.form.submit(); } return false;"
                                            title="Refresh">
                                            <img src="/assets/images/refresh.png" border="0" alt="Refresh"/>
                                        </a>
                                    </div>
                                    <div class="hikashop_cart_product_quantity_delete">
                                        <a
                                            class="hikashop_no_print"
                                            href="/checkout/product/updatecart/quantity-0/return_url-aHR0cHM6Ly93d3cubWFpbC10ZXN0ZXIuY29tL21hbmFnZXIvY2hlY2tvdXQvY2hlY2tvdXQvdGFzay1zdGVwL3N0ZXAtMi5odG1s/cid-1.html"
                                            onclick="var qty_field = document.getElementById('hikashop_checkout_quantity_27201'); if(qty_field){qty_field.value=0;  qty_field.form.submit();} return false;"
                                            title="Delete">
                                            <img src="/assets/images/delete2.png" border="0" alt="Delete"/>
                                        </a>
                                    </div>
                                </td>
                                <td data-title="Total price" class="hikashop_cart_product_total_value">
                                    <span class="hikashop_product_price_full">
                                        <span class="hikashop_product_price">50,00 €</span>
                                    </span>
                                </td>
                            </tr>

                            <tr class="margin">
                                <td colspan="3" class="hikashop_cart_empty_footer"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="hikashop_cart_empty_footer"></td>
                                <td
                                    id="hikashop_checkout_cart_total2_title"
                                    class="hikashop_cart_subtotal_title hikashop_cart_title">
                                    Subtotal
                                </td>
                                <td class="hikashop_cart_subtotal_value" data-title="Subtotal">
                                    <span class="hikashop_checkout_cart_subtotal">
                                        50,00 €
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="hikashop_cart_empty_footer"></td>
                                <td
                                    id="hikashop_checkout_cart_tax_title"
                                    class="hikashop_cart_tax_title hikashop_cart_title">
                                    VAT (ES)
                                </td>
                                <td class="hikashop_cart_tax_value" data-title="VAT (ES)">
                                    <span class="hikashop_checkout_cart_taxes">
                                        10,50 €
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="hikashop_cart_empty_footer"></td>
                                <td
                                    id="hikashop_checkout_cart_final_total_title"
                                    class="hikashop_cart_total_title hikashop_cart_title">
                                    Total
                                </td>
                                <td class="hikashop_cart_total_value" data-title="Total">
                                    <span class="hikashop_checkout_cart_final_total">
                                        60,50 €
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br/>
                <span id="hikashop_checkout_status">
                    You chose the payment method:
                    <span class="label label-info">Paypal</span>
                </span>
                <div class="clear_both"></div>
                <input type="hidden" name="Itemid" value="168"/>
                <input type="hidden" name="option" value="com_hikashop"/>
                <input type="hidden" name="ctrl" value="checkout"/>
                <input type="hidden" name="task" value="step"/>
                <input type="hidden" name="previous" value="2"/>
                <input type="hidden" name="step" value="3"/>
                <input type="hidden" id="hikashop_validate" name="validate" value="0"/>
                <input type="hidden" name="45adedc08584ba24ea6f3e97d550bc4a" value="1"/>
                <input
                    type="hidden"
                    name="unique_id"
                    value="[c4978e91d662f0a5a25fff0950e60189]"/>
                <br style="clear:both"/>
                <input
                    type="submit"
                    class="btn button hikashop_cart_input_button"
                    name="next"
                    value="Finish"
                    onclick="var field=document.getElementById('hikashop_product_quantity_field_1');if(hikashopCheckChangeForm('order','hikashop_checkout_form')){ if(hikashopCheckMethods()){ document.getElementById('hikashop_validate').value=1; this.disabled = true; document.forms['hikashop_checkout_form'].submit();}} return false;"
                    id="hikashop_checkout_next_button"/>
            </form>
        </div>
        <div class="clear_both"></div>
        <!-- HikaShop Component powered by http://www.hikashop.com -->
        <!-- version Business : 2.6.2 [1604182302] -->

    </div>
</div>
@endsection