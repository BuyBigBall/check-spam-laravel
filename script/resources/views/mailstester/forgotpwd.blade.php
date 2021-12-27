@extends('mailstester.layout')

@section('content')
<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">
    <div id="system-message-container">
        @if( !empty($message) )
            <div id="system-message">
                <div class="alert alert-warning">
                    <a class="close" data-dismiss="alert">×</a>
                    <h4 class="alert-heading">Warning</h4>
                    <div>
                        <div class="alert-message">{{$$message}}</div>
                    </div>
                </div>
            </div>        
        @endif
	</div>
        <div class="reset py-1">
            <form
                id="user-registration"
                action="/forgottask?task=reset.pwd"
                method="post"
                class="form-validate form-horizontal well">
                @csrf
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
                                type="email"
                                name="email"
                                id="jform_email"
                                value=""
                                class="validate-username required"
                                size="30"
                                style="height:1.7rem;"
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
            </form>
        </div>

    </div>
</div>
@endsection