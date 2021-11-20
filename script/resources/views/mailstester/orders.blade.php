@extends('mailstester.layout')

@section('content')
<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">

        <div id="system-message-container"></div>

        <div id="mailtester_cart_order_listing">
            <fieldset>
                <div class="header mailtester_cart_header_title">
                    <h1>Orders</h1>
                </div>
                <div class="toolbar mailtester_cart_header_buttons" id="toolbar" style="float: right;">
                    <table class="mailtester_cart_no_border">
                        <tbody>
                            <tr>
                                <td>
                                    <a
                                        href="{{ route('account' )}}#">
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
            <form
                action="{{ route('order' )}}"
                method="post"
                name="adminForm"
                id="adminForm">
                <table class="mailtester_cart_no_border">
                    <tbody>
                        <tr>
                            <td width="100%">
                                Filter:
                                <input
                                    type="text"
                                    name="search"
                                    id="mailtester_cart_search"
                                    value=""
                                    class="inputbox"
                                    onchange="document.adminForm.submit();"/>
                                <button class="btn" onclick="this.form.submit();">Go</button>
                                <button
                                    class="btn"
                                    onclick="document.getElementById('mailtester_cart_search').value='';this.form.submit();">Reset</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" name="Itemid" value="111"/>
                <input type="hidden" name="option" value="com_mailtester_cart"/>
                <input type="hidden" name="task" value=""/>
                <input type="hidden" name="ctrl" value="order"/>
                <input type="hidden" name="boxchecked" value="0"/>
                <input type="hidden" name="filter_order" value="a.order_created"/>
                <input type="hidden" name="filter_order_Dir" value="desc"/>
                <input type="hidden" name="45adedc08584ba24ea6f3e97d550bc4a" value="1"/>
            </form>
            <table
                id="mailtester_cart_order_listing"
                class="mailtester_cart_orders adminlist table table-striped table-hover"
                cellpadding="1">
                <thead>
                    <tr>
                        <th class="mailtester_cart_order_num_title title titlenum" align="center">
                            #
                        </th>
                        <th class="mailtester_cart_order_number_title title" align="center">
                            Order number
                        </th>
                        <th class="mailtester_cart_order_date_title title" align="center">
                            <a
                                href="{{ route('order' )}}#"
                                onclick="Joomla.tableOrdering('a.order_created','asc','');return false;"
                                class="hasPopover"
                                title=""
                                data-content="Select to sort by this column"
                                data-placement="top"
                                data-original-title="Date">Date<span class="icon-arrow-down-3"></span>
                            </a>
                        </th>
                        <th class="mailtester_cart_order_status_title title" align="center">
                            <a
                                href="{{ route('order' )}}#"
                                onclick="Joomla.tableOrdering('a.order_status','asc','');return false;"
                                class="hasPopover"
                                title=""
                                data-content="Select to sort by this column"
                                data-placement="top"
                                data-original-title="Order status">Order status</a>
                        </th>
                        <th class="mailtester_cart_order_total_title title" align="center">
                            <a
                                href="{{ route('order' )}}#"
                                onclick="Joomla.tableOrdering('a.order_full_price','asc','');return false;"
                                class="hasPopover"
                                title=""
                                data-content="Select to sort by this column"
                                data-placement="top"
                                data-original-title="Total">Total</a>
                        </th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="10">
                            <div class="pagination">
                                <form
                                    action="{{ route('order' )}}"
                                    method="post"
                                    name="adminForm_bottom">
                                    <div class="list-footer">

                                        <div class="limit">Display #
                                            <select
                                                id="limit"
                                                name="limit"
                                                class="chzn-done inputbox"
                                                size="1"
                                                style="width:70px"
                                                onchange="this.form.submit()">
                                                <option value="20" selected="selected">20</option>
                                                <option value="40">40</option>
                                                <option value="60">60</option>
                                                <option value="80">80</option>
                                                <option value="100">100</option>
                                                <option value="0">all</option>
                                            </select>
                                        </div>
                                        <div class="pagination">
                                            <input type="hidden" name="limitstart" value="0"/></div>
                                    </div>
                                    Results 1 - 1 of 1
                                    <input type="hidden" name="Itemid" value="111"/>
                                    <input type="hidden" name="option" value="com_mailtester_cart"/>
                                    <input type="hidden" name="task" value=""/>
                                    <input type="hidden" name="ctrl" value="order"/>
                                    <input type="hidden" name="boxchecked" value="0"/>
                                    <input type="hidden" name="filter_order" value="a.order_created"/>
                                    <input type="hidden" name="filter_order_Dir" value="desc"/>
                                    <input type="hidden" name="45adedc08584ba24ea6f3e97d550bc4a" value="1"/></form>
                            </div>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                    <tr class="row0">
                        <td class="mailtester_cart_order_num_value">
                            1
                        </td>
                        <td class="mailtester_cart_order_number_value">
                            <a href="{{ route('orderdetail', 'cid-40746') }}">
                                MT202140746
                            </a>
                        </td>
                        <td class="mailtester_cart_order_date_value">
                            2021-11-11 07:23
                        </td>
                        <td class="mailtester_cart_order_status_value">
                            <span class="mailtester_cart_order_listing_status mailtester_cart_order_status_created">
                                created</span>
                        </td>
                        <td class="mailtester_cart_order_total_value">
                            60,50 €
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="clear_both"></div>
        <!-- mailtester_cart Component powered by http://www.mailtester_cart.com -->
        <!-- version Business : 2.6.2 [1604182302] -->

    </div>
</div>
@endsection