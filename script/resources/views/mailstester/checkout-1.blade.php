@extends('mailstester.layout')

@section('content')
<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">

        <div id="system-message-container"></div>

        <div
            id="hikashop_checkout_page"
            class="hikashop_checkout_page hikashop_checkout_page_step0">
            <div class="hikashop_wizardbar">
                <ul>
                    <li class="hikashop_cart_step_current">
                        <span class="badge badge-info">1</span>
                        Address
                        <span class="hikashop_chevron"></span>
                    </li>

                    <li class="">
                        <span class="badge badge-">2</span>
                        <a
                            href="{{ route('checkout', 'step2') }}">
                            Payment
                        </a>
                        <span class="hikashop_chevron"></span>
                    </li>

                    <li class="">
                        <span class="badge badge-">3</span>
                        <a
                            href="{{ route('checkout', 'step3') }}">
                            Cart
                        </a>
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
                action="{{ route('checkout', 'step2') }}"
                method="post"
                name="hikashop_checkout_form"
                enctype="multipart/form-data"
                onsubmit="if('function' == typeof(hikashopSubmitForm)) { hikashopSubmitForm('hikashop_checkout_form'); return false; } else { return true; }">
                <div
                    id="hikashop_checkout_address_billing_only"
                    class="hikashop_checkout_address_billing_only row-fluid">
                    <div
                        id="hikashop_checkout_billing_address"
                        class="hikashop_checkout_billing_address span6">
                        <fieldset class="hika_address_field" id="hikashop_checkout_billing_address">
                            <legend>Billing address</legend>
                            <table class="table">
                                <tbody>
                                    <tr class="row0">
                                        <td>
                                            <input
                                                id="hikashop_checkout_billing_address_radio_44126"
                                                type="hidden"
                                                name="hikashop_address_billing"
                                                value="44126"/>
                                            <span class="hikashop_checkout_billing_address_info">
                                                Samir Chakouri<br/>
                                                Calle julio colomer 29<br/>
                                                46910 Alfafar Valencia<br/>
                                                Spain
                                            </span>
                                        </td>
                                        <td>
                                            <span class="hikashop_checkout_billing_address_buttons">
                                                <a
                                                    id="hikashop_checkout_billing_address_edit_44126"
                                                    title="Edit"
                                                    class="hikashop_checkout_billing_address_edit"
                                                    rel="{handler: 'iframe', size: {x: 450, y: 480}}"
                                                    href="{{ route('payment', 'tmpl-component') }}"
                                                    onclick="return hikashopEditAddress(this,0,false);">
                                                    <img alt="Edit" src="./Checkout-1_files/edit.png" border="0"/></a>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <span
                                id="hikashop_checkout_billing_address_new"
                                class="hikashop_checkout_billing_address_new">
                                <a
                                    id="hikashop_checkout_billing_address_new_link"
                                    rel="{handler: 'iframe', size: {x: 450, y: 480}}"
                                    href="{{ route('payment', 'tmpl-component') }}"
                                    onclick="return hikashopEditAddress(this,0,true);">
                                    <input
                                        type="button"
                                        class="btn button hikashop_cart_input_button"
                                        name="new"
                                        value="New"
                                        onclick="var field=document.getElementById('hikashop_product_quantity_field_1');var link = document.getElementById('hikashop_checkout_billing_address_new_link'); if(link) return hikashopEditAddress(link,0,true); return false;"/>
                                </a >
                            </span>
                        </fieldset>
                    </div>
                </div>
                <div style="clear:both"></div>
                <input type="hidden" name="Itemid" value="168"/>
                <input type="hidden" name="option" value="com_hikashop"/>
                <input type="hidden" name="ctrl" value="checkout"/>
                <input type="hidden" name="task" value="step"/>
                <input type="hidden" name="previous" value="0"/>
                <input type="hidden" name="step" value="1"/>
                <input type="hidden" id="hikashop_validate" name="validate" value="0"/>
                <input type="hidden" name="45adedc08584ba24ea6f3e97d550bc4a" value="1"/>
                <input
                    type="hidden"
                    name="unique_id"
                    value="[04a41f3c14335bf17e4ae3d68cf4643e]"/>
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