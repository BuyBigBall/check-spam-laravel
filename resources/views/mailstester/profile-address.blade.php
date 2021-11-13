@extends('mailstester.layout')

<link href="/assets/css/vex.css" rel="stylesheet" type="text/css">

@section('content')

<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">

        <div id="system-message-container"></div>

        <div id="hikashop_address_listing">
            <fieldset>
                <div class="header hikashop_header_title">
                    <h1>Addresses</h1>
                </div>
                <div class="toolbar hikashop_header_buttons" id="toolbar">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <a
                                        rel="nofollow"
                                        onclick="return window.hikashop.openBox(this);"
                                        id="hikashop_new_address_popup"
                                        href="https://www.mail-tester.com/manager/account/address/add/tmpl-component.html"
                                        data-hk-popup="vex"
                                        data-vex="{x:760, y:480}">
                                        <span class="icon-32-new" title="New"></span>New</a>
                                </td>
                                <td>
                                    <a href="https://www.mail-tester.com/manager/account/user.html">
                                        <span class="icon-32-back" title="Back"></span>
                                        Back
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </fieldset>
            <div class="hikashop_address_listing_div">
                <form
                    action="{{ route('save-address') }}"
                    name="hikashop_user_address"
                    method="post">
                    @csrf
                    <table class="hikashop_address_listing_table">
                        <tbody>
                            <tr class="hikashop_address_listing_item">
                                <td class="hikashop_address_listing_item_default">
                                    <input
                                        type="radio"
                                        name="address_default"
                                        value="44126"
                                        checked="checked"
                                        onclick="this.form.submit();"/></td>
                                <td class="hikashop_address_listing_item_details">
                                    <span>Samir Chakouri<br/>
                                        Calle julio colomer 29<br/>
                                        46910 Alfafar Valencia<br/>
                                        Spain</span>
                                </td>
                                <td class="hikashop_address_listing_item_actions">
                                    <a
                                        onclick="if(!confirm('Are you sure you want to delete this address ?')){return false;}else{return true;}"
                                        href="#"
                                        title="Delete">
                                        <img src="/assets/images/icons/delete.png" alt="Delete"/></a>
                                    <a
                                        rel="nofollow"
                                        onclick="return window.hikashop.openBox(this);"
                                        id="hikashop_edit_address_popup_44126"
                                        href="#"
                                        data-hk-popup="vex"
                                        data-vex="{x:760, y:480}">
                                        <img src="/assets/images/icons/edit.png" title="Edit" alt="Edit"/></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <input type="hidden" name="option" value="com_hikashop"/>
                    <input type="hidden" name="ctrl" value="address"/>
                    <input type="hidden" name="task" value="setdefault"/>
                    <input type="hidden" name="02da9f5c81fc9e643cc9b1546a6e1e60" value="1"/>
                </form>
            </div>
        </div>
        <div class="clear_both"></div>
    </div>
</div>

@endsection

@section('addressjs')

<!-- <script src="/assets/js/hikashop.js" type="text/javascript"></script>
<script src="/assets/js/vex.min.js" type="text/javascript"></script>
<script src="/assets/js/keepalive.js" type="text/javascript"></script> -->

@endsection