@extends('mailstester.layout')

@section('content')
<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">
        <div id="system-message-container"></div>
        <div class="reset py-1">
            <form
                action="{{route('resetpwd-confirm')}}"
                method="post"
                class="form-validate form-horizontal well">
                @csrf
                <fieldset>
                    <p>An email has been sent to your email address. The email has a verification
                        code, please paste the verification code in the field below to prove that you
                        are the owner of this account.</p>
                    <div class="control-group">
                        <div class="control-label">
                            <label
                                id="jform_username-lbl"
                                for="jform_username"
                                class="hasPopover required"
                                title=""
                                data-content="Enter your username."
                                data-original-title="Username">
                                Username<span class="star">&nbsp;*</span>
                            </label>
                        </div>
                        <div class="controls">
                            <input
                                type="text"
                                name="username"
                                id="jform_username"
                                value="{{$username}}"
                                class="required"
                                size="30"
                                style="height:1.7rem;"
                                required="required"
                                aria-required="true"/></div>
                    </div>
                    <div class="control-group">
                        <div class="control-label">
                            <label
                                id="jform_token-lbl"
                                for="jform_token"
                                class="hasPopover required"
                                title=""
                                data-content="Enter the password reset verification code you received by email."
                                data-original-title="Verification Code">
                                Verification Code<span class="star">&nbsp;*</span>
                            </label>
                        </div>
                        <div class="controls">
                            <input
                                type="text"
                                name="token"
                                id="jform_token"
                                value="{{$token}}"
                                class="required"
                                size="32"
                                style="height:1.7rem;"
                                required="required"
                                aria-required="true"/></div>
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