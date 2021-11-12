@extends('mailstester.layout')

@section('content')
<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">

        <div id="system-message-container"></div>

        <div class="hikashop_cpanel_main" id="hikashop_cpanel_main">
            <div class="hikashop_cpanel_title" id="hikashop_cpanel_title">
                <fieldset>
                    <div class="header hikashop_header_title">
                        <h1>Customer Account</h1>
                    </div>
                </fieldset>
            </div>
            <div class="hikashopcpanel" id="hikashopcpanel">
                <div
                    onclick="document.location.href='/manager/login/profile.html?layout=edit';"
                    class="icon hikashop_cpanel_icon_div icon hikashop_cpanel_icon_div_user2">
                    <a href="https://www.mail-tester.com/manager/login/profile.html?layout=edit">
                        <table class="hikashop_cpanel_icon_table">
                            <tbody>
                                <tr>
                                    <td class="hikashop_cpanel_icon_image">
                                        <span
                                            class="hikashop_cpanel_icon_image_span icon-48-user2"
                                            title="Customer Account"></span>
                                        <span class="hikashop_cpanel_button_text">Customer Account</span>
                                    </td>
                                    <td>
                                        <div class="hikashop_cpanel_button_description">
                                            <ul>
                                                <li>Edit your account information</li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </a>
                </div>
                <div
                    onclick="document.location.href='/manager/account/address.html';"
                    class="icon hikashop_cpanel_icon_div icon hikashop_cpanel_icon_div_address">
                    <a href="https://www.mail-tester.com/manager/account/address.html">
                        <table class="hikashop_cpanel_icon_table">
                            <tbody>
                                <tr>
                                    <td class="hikashop_cpanel_icon_image">
                                        <span class="hikashop_cpanel_icon_image_span icon-48-address" title="Addresses"></span>
                                        <span class="hikashop_cpanel_button_text">Addresses</span>
                                    </td>
                                    <td>
                                        <div class="hikashop_cpanel_button_description">
                                            <ul>
                                                <li>Manage your addresses</li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </a>
                </div>
                <div
                    onclick="document.location.href='/manager/account/order.html';"
                    class="icon hikashop_cpanel_icon_div icon hikashop_cpanel_icon_div_order">
                    <a href="https://www.mail-tester.com/manager/account/order.html">
                        <table class="hikashop_cpanel_icon_table">
                            <tbody>
                                <tr>
                                    <td class="hikashop_cpanel_icon_image">
                                        <span class="hikashop_cpanel_icon_image_span icon-48-order" title="Orders"></span>
                                        <span class="hikashop_cpanel_button_text">Orders</span>
                                    </td>
                                    <td>
                                        <div class="hikashop_cpanel_button_description">
                                            <ul>
                                                <li>View your orders</li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </a>
                </div>
                <div
                    onclick="document.location.href='/manager/account/cart/showcart/cart_type-cart.html';"
                    class="icon hikashop_cpanel_icon_div icon hikashop_cpanel_icon_div_cart">
                    <a
                        href="https://www.mail-tester.com/manager/account/cart/showcart/cart_type-cart.html">
                        <table class="hikashop_cpanel_icon_table">
                            <tbody>
                                <tr>
                                    <td class="hikashop_cpanel_icon_image">
                                        <span class="hikashop_cpanel_icon_image_span icon-48-cart" title="Carts"></span>
                                        <span class="hikashop_cpanel_button_text">Carts</span>
                                    </td>
                                    <td>
                                        <div class="hikashop_cpanel_button_description">
                                            <ul>
                                                <li>Display the cart</li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </a>
                </div>
                <div
                    onclick="document.location.href='/manager/account/affiliate.html';"
                    class="icon hikashop_cpanel_icon_div icon hikashop_cpanel_icon_div_affiliate">
                    <a href="https://www.mail-tester.com/manager/account/affiliate.html">
                        <table class="hikashop_cpanel_icon_table">
                            <tbody>
                                <tr>
                                    <td class="hikashop_cpanel_icon_image">
                                        <span
                                            class="hikashop_cpanel_icon_image_span icon-48-affiliate"
                                            title="Affiliate"></span>
                                        <span class="hikashop_cpanel_button_text">Affiliate</span>
                                    </td>
                                    <td>
                                        <div class="hikashop_cpanel_button_description">
                                            <ul>
                                                <li>Micro-payment commissions</li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </a>
                </div>
            </div>
        </div>
        <div class="clear_both"></div>
        <!-- HikaShop Component powered by http://www.hikashop.com -->
        <!-- version Business : 2.6.2 [1604182302] -->

    </div>
</div>
@endsection