@extends('layouts.user')

@section('content')
<!-- Blog Section Start -->
<section class="blog d-flex align-items-center">
    <div class="effect-wrap">
        <i class="fas fa-plus effect effect-1"></i>
        <i class="fas fa-plus effect effect-2"></i>
        <i class="fas fa-circle-notch effect effect-3"></i>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="blog-text">
                    <h1>We didn't get your email</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Section End -->

<!-- Reason Section Start -->
<section class="view section-padding view_rtl">

<div id="reason_notsent">
	<div class="container py-4">
		<h2 class="question">Number 1 reason for this page</h2>
		<div class="answer">
			Your email client, plugin or extension said "sent", and it sure did. But your email got stopped just after, and never got sent. <br>Why? Your SMTP or web host is probably blocking your emails. Quite common. Get in touch with them now to find out.			</div>
	</div>
</div>

<div class="bg-white" id="reason_bcc">
	<div class="container py-4">
		<h2 class="question">Don't CC or BCC us</h2>
		<div class="answer">
			Make sure you send your emails TO us. We notoriously don't like being CCed or BCCed. We're picky, yes.<p></p>
		</div>
	</div>
</div>

<div id="reason_newtest">
	<div class="container py-4">
		<h2 class="question">Try again, do a new test</h2>
		<div class="answer">
			You never know, it might work a second time. Cross your fingers, hug your favorite voodoo doll, and pray Jah Almighty!			</div>
	</div>
</div>

<div class="bg-white" id="reason_mailchimp">
	<div class="container py-4">
		<h2 class="question">Do you use MailChimp?</h2>
		<div class="answer">
			<p>We have a known issue with MailChimp, the default "To" field in MailChimp is causing us some problems...<br>
				To fix this please switch off "Personalize the 'To' field" option on the Campaign setup page.
			</p>
		</div>
	</div>
</div>

</section>
<!-- Contact Us End -->

@endsection