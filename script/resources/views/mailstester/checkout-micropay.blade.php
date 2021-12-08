<!DOCTYPE html>
<!-- saved from url=(0077)https://www.mail-tester.com/manager/micropayment.html?mailbox=chakouri-fdgdgf -->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="icon" type="image/png" href="https://www.mail-tester.com/manager/templates/mailtester/favicon.png">
<!--<base href="https://www.mail-tester.com/manager/micropayment.html">--><base href=".">
	
	<meta name="description" content="Watch your spam test with the Mail Tester Manager">
	<meta name="generator" content="Joomla! - Open Source Content Management">
	<title>Checkout</title>
	<link href="./Checkout-micropayment_files/component_default.css" rel="stylesheet" type="text/css">
	<link href="./Checkout-micropayment_files/frontend_default.css" rel="stylesheet" type="text/css">
	<link href="./Checkout-micropayment_files/template.css" rel="stylesheet" type="text/css">
	<script async="" src="./Checkout-micropayment_files/analytics.js.download"></script><script src="./Checkout-micropayment_files/hikashop.js.download" type="text/javascript"></script>
	<script src="./Checkout-micropayment_files/jquery.min.js.download" type="text/javascript"></script>
	<script src="./Checkout-micropayment_files/jquery-noconflict.js.download" type="text/javascript"></script>
	<script src="./Checkout-micropayment_files/jquery-migrate.min.js.download" type="text/javascript"></script>
	<script src="./Checkout-micropayment_files/bootstrap.min.js.download" type="text/javascript"></script>
	<script type="text/javascript">
jQuery(document).on('ready',function(){

				jQuery('.productselection').on('click', function (evt) {
					jQuery('.productselection').removeClass('selected');
					jQuery(this).addClass('selected');
					jQuery('#product_id').val(jQuery(this).attr('rel'));
				});
		});
	</script>

<!--[if lt IE 9]>
	<script src="/manager/media/jui/js/html5.js"></script>
<![endif]-->
</head>
<body class="contentpane modal" id="com_mtmanager_checkout_listing">
	<div id="system-message-container">
	</div>

	<div id="micropaymentpage" class="container">
	<div id="navigationbar"><ul><li class="selected"><span class="stepnumber">1</span>Plan</li><li><span class="stepnumber">2</span>Address</li><li><span class="stepnumber">3</span>Payment</li></ul></div><div id="bottompicture"></div>	<form method="post" autocomplete="off" action="https://www.mail-tester.com/manager/micropayment/checkout/address.html">
		<div class="stepcontent">
						We received your email and we are ready to analyze it!			<br>
			To access the result and all explanations helping you to improve your email deliverability, select your plan:<div id="productselection_area" class="productcontainer-3"><div class="productselection" rel="8"><div class="productselection_price">1 €</div><div class="productselection_description">Get access to the result of this test only</div></div><div class="productselection" rel="12"><div class="productselection_price">3 €</div><div class="productselection_description">Get access to the next <strong>5</strong> tests you perform</div></div><div class="productselection selected" rel="13"><div class="productselection_price">5 €</div><div class="productselection_description">Get access to the next <strong>20</strong> tests you perform</div></div></div>				<div style="clear:both"></div>
				<input type="hidden" name="mailbox" value="chakouri-fdgdgf">
				<input type="hidden" id="product_id" name="product_id" value="13">
				<input type="hidden" name="ctrl" value="checkout">
				<input type="hidden" name="task" value="address">
				<input type="hidden" name="option" value="com_mtmanager">
				<div class="nextstep"><input type="submit" class="btn btn-primary" value="Next step"></div>
				<div class="extratext">
					<ul>
						<li>We accept payments via Blue Card, Visa, Master Card, Amex and Paypal</li>
						<li>Your test will be accessible immediately after your purchase</li>
						<li>We tested your email against the most used blacklists, SpamAssassin, SPF, DKIM, Sender-ID, DMARC. We also tested your links and pictures. If you have no clue what that means, don't worry, we explain everything in the result</li>
					</ul>
				</div>
				<br>
						</div>
	</form>
	<div class="bottomarea">
		You have already paid for the access?		<br>Please enter your email address to access your result :		<br>
		<form method="post" action="https://www.mail-tester.com/manager/micropayment/checkout/access.html">
			<input type="text" name="email" style="height:auto;margin:0px;" placeholder="Email address">
			<input type="submit" class="btn btn-primary" value="Submit">
			<input type="hidden" name="mailbox" value="chakouri-fdgdgf">
			<input type="hidden" name="ctrl" value="checkout">
			<input type="hidden" name="task" value="access">
			<input type="hidden" name="option" value="com_mtmanager">
		</form>
	</div>
</div>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-31056342-2', 'auto');
		ga('send', 'pageview');

	</script>


</body></html>