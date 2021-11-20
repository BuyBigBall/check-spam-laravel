@extends('mailstester.layout')

@section('content')
<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">

        <div id="system-message-container"></div>

        <form
            method="POST"
            id="mailtester_cart_show_cart_form"
            name="mailtester_cart_show_cart_form"
            action="{{ route('cart-type-cart') }}">
            <div
                onload="document.getElementById('task').value='savecart'"
                id="mailtester_cart_cart_listing">
                <fieldset>
                    <div class="header mailtester_cart_header_title">
                        <h1>Carts</h1>
                    </div>
                    <div class="toolbar mailtester_cart_header_buttons" id="toolbar" style="float: right;">
                        <table class="mailtester_cart_no_border">
                            <tbody>
                                <tr>
                                    <td>
                                        <a
                                            href="#"
                                            onclick="history.back(); return false;">
                                            <span class="icon-32-back" title="Back"></span>
                                            Back
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
                <div class="iframedoc" id="iframedoc"></div>
                <table
                    class="mailtester_cart_showcart_infos table table-striped table-hover"
                    width="100%"></table>

                <table
                    id="mailtester_cart_cart_product_listing"
                    class="mailtester_cart_cart_products adminlist table table-striped table-hover"
                    cellpadding="1">
                    <thead>
                        <tr>
                            <th class="mailtester_cart_cart_num_title title titlenum" align="center">
                                #
                            </th>
                            <th class="mailtester_cart_cart_image_title title" align="left">
                                Image
                            </th>
                            <th class="mailtester_cart_cart_name_title title" align="left">
                                Name
                            </th>
                            <th class="mailtester_cart_cart_price_title title" align="right">
                                Unit price
                            </th>
                            <th class="mailtester_cart_cart_quantity_title title" align="center">
                                Quantity
                            </th>
                            <th class="mailtester_cart_cart_price_title title" align="right">
                                Total price
                            </th>
                            <th class="mailtester_cart_cart_status_title title" align="center">
                                Status
                            </th>
                            <th class="mailtester_cart_cart_delete_title title" align="center">
                                Delete
                            </th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="hika_show_cart_total">
                            <td class="hika_show_cart_total_text">Total</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td align="center" class="hika_show_cart_total_quantity">0</td>
                            <td align="right" class="hika_show_cart_total_price">
                                0,00 €
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
                    <tbody></tbody>
                </table>
                <input
                    type="submit"
                    class="btn button mailtester_cart_cart_input_button"
                    name="checkout"
                    value="Proceed to checkout"
                    onclick="var field=document.getElementById('mailtester_cart_product_quantity_field_1');
                            window.location='{{ route('payment', '00') }}';return false;"/>
            </div >
            <div class="clear_both"></div>
            <input type="hidden" id="task" name="task" value="savecart"/>
            <input type="hidden" id="ctrl" name="ctrl" value="cart"/>
            <input type="hidden" name="cid" value=""/>
            <input type="hidden" name="cart_id" value="27201"/>
            <input type="hidden" name="from_id" value="27201"/>
            <input type="hidden" name="cart_type" value="cart"/>
            <input type="hidden" id="action" name="action" value=""/>
        </form>

    </div>
</div>
@endsection