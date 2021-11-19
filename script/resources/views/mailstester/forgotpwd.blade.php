@extends('mailstester.layout')

@section('content')
<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">
        <div id="system-message-container"></div>
        <div class="reset py-6">
            <form
                id="user-registration"
                action="/manager/login.html?task=reset.request"
                method="post"
                class="form-validate form-horizontal well">
                <fieldset>
                    <p>Please enter the email address for your account. A verification code will be
                        sent to you. Once you have received the verification code, you will be able to
                        choose a new password for your account.</p>
                    <div class="control-group">
                        <div class="control-label">
                            <label
                                id="jform_email-lbl"
                                for="jform_email"
                                class="hasPopover required"
                                title=""
                                data-content="Please enter the email address associated with your User account.<br />A verification code will be sent to you. Once you have received the verification code, you will be able to choose a new password for your account."
                                data-original-title="Email Address">
                                Email Address<span class="star">&nbsp;*</span>
                            </label>
                        </div>
                        <div class="controls">
                            <input
                                type="text"
                                name="jform[email]"
                                id="jform_email"
                                value=""
                                class="validate-username required"
                                size="30"
                                required="required"
                                aria-required="true"/>
                        </div>
                    </div>
                </fieldset>
                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-primary validate">
                            Submit
                        </button>
                    </div>
                </div>
                <input type="hidden" name="23672775139cbb4eecd897ab9ae9797b" value="1"/></form>
        </div>

    </div>
</div>
@endsection