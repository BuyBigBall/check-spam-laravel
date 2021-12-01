@extends('mailstester.layout')

@section('content')
<style>
    td a.btn{
        font-size:0.8rem;
    }
    .pricelist td{
        font-size:0.8rem;
    }
</style>
<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">
        <div id="system-message-container"></div>
        <div class="item-page" itemscope="" itemtype="https://schema.org/Article">
            <div itemprop="articleBody">
                <p>Having an account will enable you to:</p>
                <ul>
                    <li>
                        <strong>Integrate mail-tester results in your own application</strong>
                        either by using an iframe or
                        <a href="{{ route('json-api') }}">our JSON API</a>
                    </li>
                    <li>
                        <strong>Earn money by integrating mail-tester results</strong>
                        in your own application with our
                        <a href="{{ route('micro-payment') }}">micro-payment mode</a>
                    </li>
                    <li>Customize the CSS of the result page</li>
                    <li>
                        <strong>Fully white-label our service</strong>
                        (once done please contact us so we will authorize our servers to receive emails
                        from your domain)</li>
                    <li>Get statistics about your tests (daily, weekly and monthly usage)</li>
                    <li>Have a listing of all tests performed within the last 30 days</li>
                    <li>
                        <strong>No advertisement</strong>
                        will be displayed on your tests</li>
                    <li>There is
                        <strong>no expiry date</strong>
                        on the tests you purchase and you can purchase additional tests at any time you
                        want with the same account</li>
                </ul>
                <div>
                    <div class="moduletable">
                        @if( !empty($left_count))
                        <h1 style="text-align:center;">You have {{ $left_count }} tests left on your account</h1>
                        @endif
                        <table class="pricelist" style="width:760px;">
                            <thead>
                                <tr>
                                    <th>Number of tests</th>
                                    <th>Price (excl. VAT)</th>
                                    <th>Price per test</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (empty($userdata['user_login'])) 
                                <tr>
                                    <td colspan="3" style='text-align:left;'>Micro-payment mode<br/>
                                        <span style="font-size:10px">So your users will pay for the tests they perform
                                            and you get a commission... you don't need credits on your account</span>
                                    </td>
                                    <td>
                                        <a
                                            class="btn btn-primary"
                                            href="{{ route('signup') }}">Register</a>
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td>500</td>
                                    <td>50 €</td>
                                    <td>0.100 €</td>
                                    <td>
                                        <a class="btn btn-primary" onclick="showPayOnePage('50','500', '500 tests')">Add 500 tests</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1 000</td>
                                    <td>80 €</td>
                                    <td>0.080 €</td>
                                    <td>
                                        <a class="btn btn-primary" onclick="showPayOnePage('80','1000', '1000 tests')">Add 1 000 tests</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5 000</td>
                                    <td>250 €</td>
                                    <td>0.050 €</td>
                                    <td>
                                        <a class="btn btn-primary" onclick="showPayOnePage('250','5000', '5000 tests')">Add 5 000 tests</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>20 000</td>
                                    <td>700 €</td>
                                    <td>0.035 €</td>
                                    <td>
                                        <a class="btn btn-primary" onclick="showPayOnePage('700','20000', '20000 tests')">Add 20 000 tests</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>100 000</td>
                                    <td>2 500 €</td>
                                    <td>0.025 €</td>
                                    <td>
                                        <a class="btn btn-primary" onclick="showPayOnePage('2500','100000', '100000 tests')">Add 100 000 tests</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1 000 000</td>
                                    <td>20 000 €</td>
                                    <td>0.020 €</td>
                                    <td>
                                        <a class="btn btn-primary" onclick="showPayOnePage('20000','1000000', '1000000 testes')">Add 1 000 000 tests</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br/>
                        <br/>
                    </div>
                </div>
                <p>If you occasionally perform manual tests, no need to create an account, you
                    can still use
                    <a title="Mail-tester" href="{{ (Request::root())  }}">our web interface</a>!
                </p>
            </div>

        </div>

    </div>
</div>

<!-- Modal -->
<style>
.input-stripe {
    margin-left: 50px !important;
}  
.buy-mode {
    margin-top: 0px !important;
}  
#buyModal {
    height: 280px;
    top: 20px;
    padding-right: 0px !important;
    opacity: 1;
}
</style>
<div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form class="form-horizontal" method="POST" id="micro-payment-form" role="form" 
        action="{!! URL::route('buy_mail_test') !!}" >
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Select payment method</h4>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="mail_price" name="price" value="0">
                    <input type="hidden" id="mail_qty" name="qty" value="0">
                    <input type="radio" class="buy-mode" checked id="mode-1" value="paypal" name="buyMode">
                    &nbsp;
                    <label class="radio-label" for="mode-1">Paypal</label>

                    <input type="radio" class="buy-mode input-stripe" id="mode-2" value="stripe" name="buyMode">
                    &nbsp;
                    <label class="radio-label" for="mode-2">Stripe</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Pay</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class='hidden'>
<form class="form-horizontal" method="POST" id="onepage-payment-form" role="form" 
        action="{!! URL::route('checkout') !!}" >
        @csrf
    <input type="hidden" id="pay_price" name="price" value="0">
    <input type="hidden" id="buy_qty" name="buy_qty" value="0">
    <input type="hidden" id="pay_qty" name="qty" value="1">
    <input type="hidden" id="pay_name" name="name" value="0">
    <input type="hidden" id="pay_paymethod" name="payment_method" value="paybox_paypal">
</form>
</div>
<script>
function showBuyModal(price,qty, goodsname){
    $('#mail_price').val(price);
    $('#mail_qty').val(qty);
    $('#buyModal').modal('show');
}

function showPayOnePage(price,qty, goodsname){
    $('#pay_price').val(price);
    $('#buy_qty').val(qty);
    $('#pay_name').val(goodsname);
    $('#onepage-payment-form').submit();
}
</script>
@endsection