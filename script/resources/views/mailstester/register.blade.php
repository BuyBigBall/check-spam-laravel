@extends('mailstester.layout')

@section('content')
<style>
.sdata-error {
    width: 100%; 
    margin-top: 0.25rem;
    color: #CB5D65; 
    margin-bottom: 20px;
}
.sdata-success {
    width: 100%; 
    margin-top: 0.25rem;
    color: #48b11d; 
    margin-bottom: 20px;
}
</style>
<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">

        <div id="system-message-container"></div>

        <form
            action="{{ route('save-register') }}"
            method="post"
            id="mailtester_cart_registration_form"
            enctype="multipart/form-data"
            autocomplete="off"
            onsubmit="mailtester_cartSubmitForm(this.id); return false;">
            @csrf
            <div class="mailtester_cart_user_registration_page">
                <fieldset class="input">
                    <h2>Registration</h2>

                    @if(session()->has('error'))
                    <div class="sdata-error">
                        <strong>{{ session()->get('error') }}</strong>
                    </div>
                    @endif

                    @if(session()->has('success'))
                    <div class="sdata-success">
                        <strong>{{ session()->get('success') }}</strong>
                    </div>
                    @endif

                    <fieldset class="form-horizontal">
                    <div
                            class="control-group mailtester_cart_registration_name_line"
                            id="mailtester_cart_registration_name_line">
                            <div class="control-label">
                                <label id="namemsg" for="register_name" class="required" title="">Name</label>
                            </div>
                            <div class="controls">
                                <input
                                    type="text"
                                    name="name"
                                    id="register_name"
                                    value=""
                                    class="required validate-username"
                                    autocomplete="off"
                                    size="30"
                                    maxlength="50"
                                    aria-required="true"
                                    onchange="document.getElementById('mail-prefix').innerHTML=this.value.replace(' ', '').replace(' ', '').replace(' ', '') + '-';"
                                    required="required"/>
                                <span style='color:red'><span style='color:red'>*</span></span>
                            </div>
                            <div class="controls hidden" id='div-suffix'>
                                <input
                                    type="text"
                                    name="suffix"
                                    id="input-suffix"
                                    autocomplete="off"
                                    value="{{ $suffix = substr(md5(date('YndHis')),3,3) }}"
                                    class="required"
                                    size="10"
                                    maxlength="100"
                                    aria-required="true"
                                    onchange="document.getElementById('mail-suffix').innerHTML=this.value.replace(' ', '').replace(' ', '').replace(' ', '') + '-';"
                                    required="required"/>
                            </div>
                            <div class="message_username left">All your tests will have to be sent to 
                                <span style='color:#3333dd;'>
                                    <span id='mail-prefix' ></span><span 
                                        id='mail-suffix' style='cursor:pointer;' 
                                        onclick_test="$('#div-suffix').toggleClass('hidden');">WhateverYouWant@</span>
                                </span>{{ ($request=Request::capture())->gethttphost() }}</div>
                            </div>
                        <!-- <div
                            class="control-group mailtester_cart_registration_username_line"
                            id="mailtester_cart_registration_username_line">
                            <div class="control-label">
                                <label id="usernamemsg" for="register_username" class="required" title="">Username</label>
                            </div>
                            <div class="controls">
                                <input
                                    type="text"
                                    name="data[register][username]"
                                    id="register_username"
                                    value=""
                                    class="required validate-username"
                                    maxlength="25"
                                    size="30"
                                    aria-required="true"
                                    required="required"/>
                                <span style='color:red'>*</span>
                            </div>
                        </div> -->
                        <div class="control-group mailtester_cart_registration_email_line">
                            <div class="control-label">
                                <label id="emailmsg" for="register_email" class="required" title="">E-mail</label>
                            </div>
                            <div class="controls">
                                <input
                                    type="text"
                                    name="email"
                                    id="register_email"
                                    value=""
                                    class="required validate-email"
                                    autocomplete="off"
                                    maxlength="100"
                                    size="30"
                                    aria-required="true"
                                    required="required"/>
                                <span style='color:red'>*</span>
                            </div>
                        </div>
                        <div
                            class="control-group mailtester_cart_registration_password_line"
                            id="mailtester_cart_registration_password_line">
                            <div class="control-label">
                                <label id="pwmsg" for="register_password" class="required" title="">Password</label>
                            </div>
                            <div class="controls">
                                <input
                                    autocomplete="off"
                                    type="password"
                                    name="password"
                                    id="register_password"
                                    value=""
                                    class="required validate-password"
                                    autocomplete="off"
                                    size="30"
                                    minlength="6"
                                    aria-required="true"
                                    required="required"/>
                                <span style='color:red'>*</span>
                            </div>
                        </div>
                        <div
                            class="control-group mailtester_cart_registration_password2_line"
                            id="mailtester_cart_registration_password2_line">
                            <div class="control-label">
                                <label id="pw2msg" for="register_password2" class="required" title="">Verify Password</label>
                            </div>
                            <div class="controls">
                                <input
                                    autocomplete="off"
                                    type="password"
                                    name="password_confirmation"
                                    id="register_password2"
                                    value=""
                                    class="required validate-password"
                                    size="30"
                                    minlength="6"
                                    aria-required="true"
                                    required="required"/>
                                <span style='color:red'>*</span>
                            </div>
                            @if( !empty($RECAPTCHA_SITE_KEY) )
                            <div class="recaptcha">
                                <label></label>
                                <div
                                    id="g-recaptcha"
                                    class="g-recaptcha"
                                    data-sitekey="{{ $RECAPTCHA_SITE_KEY }}"
									data-callback="recaptchaCallback"
                                    data-theme="light"></div>
                                <input type="hidden" onclick="checkRecaptcha();" value="submit"></input>
                            </div>
                            @endif
                        </div>

                        <div class="control-group mailtester_cart_registration_required_info_line">
                            <div class="controls">Fields marked with an asterisk (<span style='color:red'>*</span>) are required.</div>
                        </div>
                        <input type="hidden" name="data[register][id]" value="0"/>
                        <input type="hidden" name="data[register][gid]" value="0"/>
                        <div class="control-group">
                            <div class="controls">
                                <input
                                    @if( !empty($RECAPTCHA_SITE_KEY) )
									disabled
                                    @endif
                                    type="submit"
                                    class="btn button mailtester_cart_cart_input_button btn btn-primary p-3"
                                    name="register"
                                    value="Register"
                                    onclick="var field=document.getElementById('mailtester_cart_product_quantity_field_1'); mailtester_cartSubmitForm('mailtester_cart_registration_form', 'register'); return false;"
                                    id="mailtester_cart_register_form_button"/></div>
                        </div>
                    </fieldset>
                </fieldset>
            </div>
        </form>
        <!-- mailtester_cart Component powered by http://www.mailtester_cart.com -->
        <!-- version Business : 2.6.2 [1604182302] -->

    </div>
</div>
@endsection


@section('register-script')

@if( !empty($RECAPTCHA_SITE_KEY) )
<script src='https://www.google.com/recaptcha/api.js' async defer></script>
<script> 
function checkRecaptcha() {
  var response = grecaptcha.getResponse();
  if(response.length == 0) { 
    alert("reCaptcha not verified"); 
    return false;
  }
  else { 
    //alert("reCaptch verified"); 
    return true;
  }
}

// implement on the backend
function backend_API_challenge() {
    var response = grecaptcha.getResponse();
    $.ajax({
        type: "POST",
        url: 'https://www.google.com/recaptcha/api/siteverify',
		crossDomain: true,
		cors: true ,
		headers: 
			{ "Access-Control-Allow-Origin":"*"},
        data: {
                "secret" : '{{ $RECAPTCHA_SECRET_KEY }}', 
                "response" : response, 
                "remoteip":"{{ $_SERVER['REMOTE_ADDR']}}"
            },
        contentType: 'application/x-www-form-urlencoded',
		beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Basic " + btoa(""));
          },
        success: function(data) {
			
		//	{
		//		"success": true,
		//		"challenge_ts": "2021-11-19T10:15:20Z",
		//		"hostname": "87.106.124.240"
		//	}
			
             console.log(data); 
            }
    });
}
</script>
@endif

<script>
    $(document).on('ready', function () {
        $('#register_username').on('change', function (evt) {
            this.value = this
                .value
                .toLowerCase();
            this.value = this
                .value
                .replace(/[^a-z0-9]/g, '');
            $('.message_username').remove();
            errorMessage = $('<div/>')
                .addClass('message_username')
                .html(
                    'All your tests will have to be sent to ' + this.value + '.whateveryouwant@mail' +
                    '-tester.com'
                );
            if (this.value.length > 0) 
                $(this)
                    .parent()
                    .append(errorMessage);
            }
        );

        $('#register_name').focus();
    });
 	function recaptchaCallback(){
        var btnSubmit = document.getElementById("mailtester_cart_register_form_button");
        $('#mailtester_cart_register_form_button').prop('disabled', false);
    }

    function mailtester_cartSubmitForm(formid, method)
    {
        function validateForm(){
            var text = document.getElementById('register_name').value;
            text = text.split(' '); 
            if (text.length == 1) return false ; 
            return true;
        }     

		$('#g-recaptcha-response').html(grecaptcha.getResponse());
        //backend_API_challenge(); 
		//return false;
        if(!validateForm()) return false;
		
        $('#' + formid).submit();
    }
</script>
@endsection
