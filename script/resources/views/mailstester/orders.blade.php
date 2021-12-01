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
            <table
                id="order_list" style="width:100%"
                class="display table table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="title titlenum" align="center">
                            #
                        </th>
                        <th class=" title" align="center">
                            Order number
                        </th>
                        <th class=" title" align="center">
                            Purchase Date
                        </th>
                        <th class=" title" align="center">
                            Order status
                        </th>
                        <th class=" title" align="center">
                            Total
                        </th>
                        <th class=" title" align="center">
                            Purchase Counts
                        </th>
                        <th class=" title" align="center">
                            Tested Counts
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $num=1; ?>
                    @foreach( $order_rows as $row)
                    <tr class="row0">
                        <td class="">
                            {{$num++}}
                        </td>
                        <td class="">
                            <a href="{{ route('orderdetail', $row->pay_id) }}">
                                {{$row->pay_id}}
                            </a>
                        </td>
                        <td class="">
                            {{ date('Y-n-d H:i', strtotime( $row->created_at))}}
                        </td>
                        <td class="">
                            <span class=" ">
                                created</span>
                        </td>
                        <td class="">
                            {{$row->amount}} €
                        </td>
                        <td class="">
                            @if(!empty($row->balance))
                            {{ $row->balance->supply }} 
                            @endif
                        </td>
                        <td class="">
                            @if(!empty($row->balance) && !empty($row->balance->used) )
                            {{ $row->balance->used }} 
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="clear_both"></div>
        <!-- mailtester_cart Component powered by http://www.mailtester_cart.com -->
        <!-- version Business : 2.6.2 [1604182302] -->

    </div>
</div>
@endsection