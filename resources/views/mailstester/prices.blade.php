@extends('mailstester.layout')

@section('content')
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
                        <a href="https://www.mail-tester.com/manager/api-documentation.html">our JSON API</a>
                    </li>
                    <li>
                        <strong>Earn money by integrating mail-tester results</strong>
                        in your own application with our
                        <a href="https://www.mail-tester.com/manager/micro-payment.html">micro-payment mode</a>
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

                        <table class="pricelist">
                            <thead>
                                <tr>
                                    <th>Number of tests</th>
                                    <th>Price (excl. VAT)</th>
                                    <th>Price per test</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="3">Micro-payment mode<br/>
                                        <span style="font-size:10px">So your users will pay for the tests they perform
                                            and you get a commission... you don't need credits on your account</span>
                                    </td>
                                    <td>
                                        <a
                                            class="btn btn-primary"
                                            href="https://www.mail-tester.com/manager/register.html">Register</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>500</td>
                                    <td>50 €</td>
                                    <td>0.100 €</td>
                                    <td>
                                        <a
                                            class="btn btn-primary"
                                            href="https://www.mail-tester.com/manager/component/hikashop/product/updatecart/quantity-1/checkout-1/cid-1.html">Add 500 tests</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1 000</td>
                                    <td>80 €</td>
                                    <td>0.080 €</td>
                                    <td>
                                        <a
                                            class="btn btn-primary"
                                            href="https://www.mail-tester.com/manager/component/hikashop/product/updatecart/quantity-1/checkout-1/cid-2.html">Add 1 000 tests</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5 000</td>
                                    <td>250 €</td>
                                    <td>0.050 €</td>
                                    <td>
                                        <a
                                            class="btn btn-primary"
                                            href="https://www.mail-tester.com/manager/component/hikashop/product/updatecart/quantity-1/checkout-1/cid-3.html">Add 5 000 tests</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>20 000</td>
                                    <td>700 €</td>
                                    <td>0.035 €</td>
                                    <td>
                                        <a
                                            class="btn btn-primary"
                                            href="https://www.mail-tester.com/manager/component/hikashop/product/updatecart/quantity-1/checkout-1/cid-4.html">Add 20 000 tests</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>100 000</td>
                                    <td>2 500 €</td>
                                    <td>0.025 €</td>
                                    <td>
                                        <a
                                            class="btn btn-primary"
                                            href="https://www.mail-tester.com/manager/component/hikashop/product/updatecart/quantity-1/checkout-1/cid-5.html">Add 100 000 tests</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1 000 000</td>
                                    <td>20 000 €</td>
                                    <td>0.020 €</td>
                                    <td>
                                        <a
                                            class="btn btn-primary"
                                            href="https://www.mail-tester.com/manager/component/hikashop/product/updatecart/quantity-1/checkout-1/cid-6.html">Add 1 000 000 tests</a>
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
                    <a title="Mail-tester" href="https://www.mail-tester.com/">our web interface</a>!
                </p>
            </div>

        </div>

    </div>
</div>
@endsection