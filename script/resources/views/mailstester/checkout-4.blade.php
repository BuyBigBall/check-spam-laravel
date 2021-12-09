@extends('mailstester.layout')

@section('content')
<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">
        <div id="system-message-container"></div>
        <div
            id="mailtester_cart_checkout_page"
            class="mailtester_cart_checkout_page mailtester_cart_checkout_page_step3">
            <div class="mailtester_cart_wizardbar">
                <ul>
                    <li class="mailtester_cart_cart_step_finished">
                        <span class="badge badge-success">1</span>
                        Address
                        <span class="mailtester_cart_chevron"></span>
                    </li>

                    <li class="mailtester_cart_cart_step_finished">
                        <span class="badge badge-success">2</span>
                        Payment
                        <span class="mailtester_cart_chevron"></span>
                    </li>

                    <li class="mailtester_cart_cart_step_finished">
                        <span class="badge badge-success">3</span>
                        Cart
                        <span class="mailtester_cart_chevron"></span>
                    </li>

                    <li class="mailtester_cart_cart_step_current">
                        <span class="badge badge-info">4</span>
                        End
                        <span class="mailtester_cart_chevron"></span>
                    </li>

                </ul>
            </div>
            <div class="row-fluid contentsize">

            <div id="system-message-container"></div>

            <div class="latest-tests">
                <h2>Payment successed!</h2>
                <form method="get" target="_blank" action="http://localhost/en/spamtest">
                    Send to your email :
                    <input
                        placeholder="user.whateveryouwant@mail-analyzer.com"
                        type="email"
                        name="id"
                        readonly
                        value="{{ $email }}"/>
                    <button class="btn" style="margin-bottom:10px;" type="submit">Chenge Email</button>
                </form>
            </div>

            <!-- LAST 20s -->
            <div id="last20" style="">
                <div class="oneresult">
                    <h1>Payment Information</h1>
                        <form name="search" method="post" action="{{route('prices')}}">
                            <table class="table table-hover table-striped table-results">
                                <thead>
                                    <tr>
                                        <th>Payment Date</th>
                                        <th>Price for Test</th>
                                        <th>Qty</th>
                                        <th>Amount</th>
                                        <th>Mode</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>{{$charge_date}}</td>
                                        <td>{{$price_type}}</td>
                                        <td>{{$pay_qty}}</td>
                                        <td>{{ $pay_amount }} €</td>
                                        <td>{{$pay_name}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="btn" style="margin-bottom:10px;" 
                                onclick="location.href='{{ route('prices') }}';"
                                type="button">Return</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear_both"></div>
    </div>
</div>
@endsection