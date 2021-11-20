@extends('mailstester.layout')

@section('content')
<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">

        <div id="system-message-container"></div>

        <div id="mailtester_cart_order_main">
            <fieldset>
                <div class="header mailtester_cart_header_title">
                    <h1>
                        Order: MT202140746
                    </h1>
                </div>
                <div class="toolbar mailtester_cart_header_buttons" id="toolbar">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <a
                                        id="mailtester_cart_order_back_button"
                                        href="{{ route('order') }}">
                                        <span class="icon-32-back" title="Back"></span>
                                        Back
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </fieldset>
            <form
                action="{{ route('order' )}}"
                method="post"
                name="adminForm"
                id="adminForm">
                <table width="100%">
                    <tbody>
                        <tr>
                            <td>
                                <div id="mailtester_cart_order_right_part" class="mailtester_cart_order_right_part">
                                    Date: 2021-11-11
                                    <br/>
                                    Order: MT202140746
                                </div>
                                <div id="mailtester_cart_order_left_part" class="mailtester_cart_order_left_part">Woobeo<br/>110 av. Barthelemy Buyer<br/>69009 Lyon<br/>France<br/><br/>VAT (TVA) : FR 52 809161177<br/>SIRET : 809 161 177 00013</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <fieldset class="adminform" id="htmlfieldset_billing">
                                                    <legend style="background-color: #FFFFFF;">Billing address</legend>
                                                    Samir Chakouri<br/>
                                                    Calle julio colomer 29<br/>
                                                    46910 Alfafar Valencia<br/>
                                                    Spain
                                                </fieldset>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <fieldset class="adminform" id="htmlfieldset_products">
                                    <legend style="background-color: #FFFFFF;">Product list</legend>
                                    <table cellpadding="1" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="mailtester_cart_order_item_name_title title">Product</th>
                                                <th class="mailtester_cart_order_item_price_title title">Unit price</th>
                                                <th class="mailtester_cart_order_item_quantity_title title titletoggle">Quantity</th>
                                                <th class="mailtester_cart_order_item_total_title title titletoggle">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="row0">
                                                <td class="mailtester_cart_order_item_name_value">
                                                    <a class="mailtester_cart_order_product_link" href="{{ route('prices') }}">
                                                        <p class="mailtester_cart_order_product_name">
                                                            500 tests
                                                        </p>
                                                    </a>
                                                    <p class="mailtester_cart_order_product_custom_item_fields"></p>
                                                </td>
                                                <td class="mailtester_cart_order_item_price_value">50,00 €</td>
                                                <td class="mailtester_cart_order_item_quantity_value">1</td>
                                                <td class="mailtester_cart_order_item_total_value">50,00 €</td>
                                            </tr>
                                            <tr>
                                                <td style="border-top:2px solid #B8B8B8;" colspan="2"></td>
                                                <td class="mailtester_cart_order_subtotal_title" style="border-top:2px solid #B8B8B8;">
                                                    <label>Subtotal</label>
                                                </td>
                                                <td class="mailtester_cart_order_subtotal_value" style="border-top:2px solid #B8B8B8;">50,00 €</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td class="mailtester_cart_order_tax_title key">
                                                    <label>VAT (ES)</label>
                                                </td>
                                                <td class="mailtester_cart_order_tax_value">10,50 €</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td class="mailtester_cart_order_total_title key">
                                                    <label>Total</label>
                                                </td>
                                                <td class="mailtester_cart_order_total_value">60,50 €</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </fieldset>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Payment method : Credit Card
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" name="cid" value="40746"/>
                <input type="hidden" name="option" value="com_mailtester_cart"/>
                <input type="hidden" name="task" value=""/>
                <input type="hidden" name="ctrl" value="order"/>
                <input type="hidden" name="cancel_redirect" value=""/>
                <input type="hidden" name="cancel_url" value=""/>
                <input type="hidden" name="45adedc08584ba24ea6f3e97d550bc4a " value="1"/>
            </form>
        </div>
        <div style="page-break-after:always"></div>
    </div>
</div>
@endsection