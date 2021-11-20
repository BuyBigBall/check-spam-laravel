@extends('mailstester.layout')

@section('content')
<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">

        <div id="system-message-container"></div>

        <div class="mailtester_cart_cpanel_main" id="mailtester_cart_cpanel_main">
            <div class="mailtester_cart_cpanel_title" id="mailtester_cart_cpanel_title">
                <fieldset>
                    <div class="header mailtester_cart_header_title">
                        <h1>Customer Account</h1>
                    </div>
                </fieldset>
            </div>
            <div class="mailtester_cartcpanel" id="mailtester_cartcpanel">
                <div
                    onclick="document.location.href=\'{{ route('profile', 'account') }}\'"
                    class="icon mailtester_cart_cpanel_icon_div icon mailtester_cart_cpanel_icon_div_user2">
                    <a href="{{ route('profile', 'account') }}">
                        <table class="mailtester_cart_cpanel_icon_table">
                            <tbody>
                                <tr>
                                    <td class="mailtester_cart_cpanel_icon_image">
                                        <span
                                            class="mailtester_cart_cpanel_icon_image_span icon-48-user2"
                                            title="Customer Account"></span>
                                        <span class="mailtester_cart_cpanel_button_text">Customer Account</span>
                                    </td>
                                    <td>
                                        <div class="mailtester_cart_cpanel_button_description">
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
                    onclick="document.location.href='{{ route('profile', 'address') }}';"
                    class="icon mailtester_cart_cpanel_icon_div icon mailtester_cart_cpanel_icon_div_address">
                    <a href="{{ route('profile', 'address') }}">
                        <table class="mailtester_cart_cpanel_icon_table">
                            <tbody>
                                <tr>
                                    <td class="mailtester_cart_cpanel_icon_image">
                                        <span class="mailtester_cart_cpanel_icon_image_span icon-48-address" title="Addresses"></span>
                                        <span class="mailtester_cart_cpanel_button_text">Addresses</span>
                                    </td>
                                    <td>
                                        <div class="mailtester_cart_cpanel_button_description">
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
                    onclick="document.location.href='{{ route('order') }}';"
                    class="icon mailtester_cart_cpanel_icon_div icon mailtester_cart_cpanel_icon_div_order">
                    <a href="{{ route('order') }}">
                        <table class="mailtester_cart_cpanel_icon_table">
                            <tbody>
                                <tr>
                                    <td class="mailtester_cart_cpanel_icon_image">
                                        <span class="mailtester_cart_cpanel_icon_image_span icon-48-order" title="Orders"></span>
                                        <span class="mailtester_cart_cpanel_button_text">Orders</span>
                                    </td>
                                    <td>
                                        <div class="mailtester_cart_cpanel_button_description">
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
                    onclick="document.location.href='{{ route('cart-type-cart') }}';"
                    class="icon mailtester_cart_cpanel_icon_div icon mailtester_cart_cpanel_icon_div_cart">
                    <a
                        href="{{ route('cart-type-cart') }}">
                        <table class="mailtester_cart_cpanel_icon_table">
                            <tbody>
                                <tr>
                                    <td class="mailtester_cart_cpanel_icon_image">
                                        <span class="mailtester_cart_cpanel_icon_image_span icon-48-cart" title="Carts"></span>
                                        <span class="mailtester_cart_cpanel_button_text">Carts</span>
                                    </td>
                                    <td>
                                        <div class="mailtester_cart_cpanel_button_description">
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
                    onclick="document.location.href='{{ route('affiliate') }}'"
                    class="icon mailtester_cart_cpanel_icon_div icon mailtester_cart_cpanel_icon_div_affiliate">
                    <a href="{{ route('affiliate') }}">
                        <table class="mailtester_cart_cpanel_icon_table">
                            <tbody>
                                <tr>
                                    <td class="mailtester_cart_cpanel_icon_image">
                                        <span
                                            class="mailtester_cart_cpanel_icon_image_span icon-48-affiliate"
                                            title="Affiliate"></span>
                                        <span class="mailtester_cart_cpanel_button_text">Affiliate</span>
                                    </td>
                                    <td>
                                        <div class="mailtester_cart_cpanel_button_description">
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
    </div>
</div>
@endsection