@extends('layouts.guest')


@section('checkout_payment_js')
<script type="text/javascript">
	$(window).on("load", function () {
		$(".preloader").fadeOut("slow");
		$(".checkout-micropayment").css('background-color', 'rgb(69 142 211)');
		$('.productselection').on('click', function (evt) {
			$('.productselection').removeClass('selected');
			$(this).addClass('selected');
			$('#product_id').val($(this).attr('rel'));
		});		
	});
    function check_validation()
    {
        if($('#product_id').val()=="") 
        {
            alert("please select a plan.");
            return false;
        }
        return true;
    }
	</script>
@endsection		


@section('content')
<!-- Blog Section Start -->
<section class="blog checkout-micropayment d-flex align-items-center">

    <div id="micropaymentpage" class="container">
        <div id="navigationbar">
            <ul>
                <li class="selected"><span class="stepnumber">1</span>Plan</li>
                <li><span class="stepnumber">2</span>Payment</li>
            </ul>
        </div>
        <div id="bottompicture"></div>
        <form
            method="post"
            autocomplete="off"
            action="{{route('checkout-micropay-address')}}"
            onsubmit="return check_validation();"
            >
            @csrf
            <div class="stepcontent">
                We received your email and we are ready to analyze it!<br/>
                To access the result and all explanations helping you to improve your email
                deliverability, select your plan:
                <div id="productselection_area" class="productcontainer-3">
                    @foreach( explode( ',', $owner->useroption->pay_types) as $pay_type )
                    <?php  $micropay_plan = App\Http\Controllers\Mailstester\PaymentController::$micropay_plans[$pay_type]; ?>
                    <div class="productselection" rel="{{$pay_type}}">
                        <div class="productselection_price">{{ $micropay_plan['amount'] }} {{$micropay_plan['unit']}}</div>
                        <div class="productselection_description">{{$micropay_plan['description']}}</div>
                    </div>
                    @endforeach
                </div>
                <div style="clear:both"></div>
                <input type="hidden" name="mailbox"     value="{{$owner->trashmail[0]->email}}"/>
                <input type="hidden" name="plan_id"     value="" id="product_id" />
                <input type="hidden" name="owner_id"    value="{{$owner->id}}"/>
                <input type="hidden" name="mail_id"     value="{{$mail_id}}"/>
                <input type="hidden" name="option"      value="com_mtmanager"/>
                <div class="nextstep">
                    <input type="submit" class="btn btn-primary" value="Next step"/>
                </div>
                <div class="extratext">
                    <ul>
                        <li>We accept payments via Blue Card, Visa, Master Card, Amex and Paypal</li>
                        <li>Your test will be accessible immediately after your purchase</li>
                        <li>We tested your email against the most used blacklists, SpamAssassin, SPF,
                            DKIM, Sender-ID, DMARC. We also tested your links and pictures. If you have no
                            clue what that means, don't worry, we explain everything in the result</li>
                    </ul>
                </div>
                <br/>
            </div>
        </form>
        <div class="bottomarea">
            You have already paid for the access?
            <br/>Please enter your email address to access your result :
            <br/>
            <form
                autocomplete ='on'
                method="post"
                action="{{route('testresult')}}">
                @csrf
                <input
                    type="text"
                    name="guest_email"
                    style="height:auto;margin:0px;"
                    placeholder="Email address" />
				<input type="submit" class="btn btn-primary" value="Submit"/>
				<input type="hidden" name="mailbox" value="{{$owner->trashmail[0]->email}}"/>
                <input type="hidden" name="mail_id" value="{{$mail_id}}"/>
				<!-- <input type="hidden" name="ctrl" value="checkout" />
				<input type="hidden" name="task" value="access" /> -->
				<input type="hidden" name="option" value="com_mtmanager"/>
			</form>
		</div>
	</div>
</section>
	<!-- <script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-31056342-2', 'auto');
		ga('send', 'pageview');

	</script>
 -->

 @endsection