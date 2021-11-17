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
<div class="row-fluid contentsize">

    <div id="system-message-container"></div>

    <div class="profile-edit" id=''>
        <form
            id="member-profile"
            action="{{ route('save-account' )}}"
            method="post"
            class="form-validate form-horizontal well"
            enctype="multipart/form-data"
            onsubmit="return validation();"
            >
            @csrf
            <fieldset>
                <legend>
                    Edit Your Account Informations
                </legend>
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
                <input type="hidden" name="id" id="jform_id" value="{{ $userdata['user_login']['id'] }}"/>
                <div class="control-group">
                    <div class="control-label">
                        <label
                            id="jform_name-lbl"
                            for="jform_name"
                            class="hasPopover required"
                            title=""
                            data-content="If you want to change your username, please contact a site administrator."
                            data-original-title="Name">
                            Name<span class="star">&nbsp;*</span>
                        </label>
                    </div>
                    <div class="controls">
                        <input
                            type="text"
                            name="name"
                            id="jform_name"
                            value="{{ $userdata['user_login']['name'] }}"
                            class="required"
                            size="30"
                            title="If you want to change your username, please contact a site administrator."
                            required="required"
                            readonly
                            aria-required="true"/>
                    </div>
                </div>
                <!-- <div class="control-group">
                    <div class="control-label">
                        <label
                            id="jform_username-lbl"
                            for="jform_username"
                            class="hasPopover"
                            title=""
                            data-content="This is your full name. It can be update in the user address page."
                            data-original-title="Username">
                            Username</label>
                        <span class="optional">
                            (optional)
                        </span>
                    </div>
                    <div class="controls">
                        <input
                            type="text"
                            name="username"
                            id="jform_username"
                            value="{{ $userdata['user_login']['firstname'] . ' '.$userdata['user_login']['lastname'] }}"
                            size="30"
                            readonly />
                    </div>
                </div> -->
                <div class="control-group">
                    <div class="control-label">
                        <label
                            id="jform_password1-lbl"
                            for="jform_password1"
                            class="hasPopover"
                            title=""
                            data-content="Enter your desired password."
                            data-original-title="Password">
                            Password</label>
                    </div>
                    <div class="controls">
                        <input type="password" style="display:none"/>
                        <input
                            type="password"
                            name="password"
                            id="jform_password1"
                            value=""
                            autocomplete="off"
                            class="validate-password"
                            size="30"
                            minlength="6"
                            maxlength="99"/>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">
                        <label
                            id="jform_password2-lbl"
                            for="jform_password2"
                            class="hasPopover"
                            title=""
                            data-content="Confirm your password."
                            data-original-title="Confirm Password">
                            Confirm Password</label>
                    </div>
                    <div class="controls">
                        <input
                            type="password"
                            name="password_confirmation"
                            id="jform_password2"
                            value=""
                            autocomplete="off"
                            class="validate-password"
                            size="30"
                            minlength="6"
                            maxlength="99"/>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">
                        <label
                            id="jform_email1-lbl"
                            for="jform_email1"
                            class="hasPopover required"
                            title=""
                            data-content="Enter your email address."
                            data-original-title="Email Address">
                            Email Address<span class="star">&nbsp;*</span>
                        </label>
                    </div>
                    <div class="controls">
                        <input
                            type="email"
                            name="email"
                            class="validate-email required"
                            id="jform_email1"
                            value="{{ $userdata['user_login']['email'] }}"
                            size="30"
                            autocomplete="email"
                            required="required"
                            aria-required="true"/>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">
                        <label
                            id="jform_email2-lbl"
                            for="jform_email2"
                            class="hasPopover required"
                            title=""
                            data-content="Confirm your email address."
                            data-original-title="Confirm Email Address">
                            Confirm Email Address<span class="star">&nbsp;*</span>
                        </label>
                    </div>
                    <div class="controls">
                        <input
                            type="email"
                            name="email2"
                            class="validate-email required"
                            id="jform_email2"
                            value="{{ $userdata['user_login']['email'] }}"
                            size="30"
                            required="required"
                            aria-required="true"/>
                    </div>
                </div>
            </fieldset>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                    <a
                        class="btn btn-primary"
                        href="{{ route('account') }}"
                        title="Cancel">
                        Cancel
                    </a>
                    <input type="hidden" name="option" value="com_users"/>
                    <input type="hidden" name="task" value="account.save"/>
                </div>
            </div>
            <input type="hidden" name="02da9f5c81fc9e643cc9b1546a6e1e60" value="1"/>
        </form>
    </div>

</div>

<script>
    function validation()
    {
        if($('#jform_password1').val()!=$('#jform_password2').val())
        {
            show_error_msg('The password could not confirm.');
            $('#jform_password2').focus();
            return false;
        }
        if($('#jform_email1').val()!=$('#jform_email2').val())
        {
            show_error_msg('The Email Address could not confirm.');
            $('#jform_email2').focus();
            return false;
        }
        return true;        
    }

</script>
<script type="text/javascript">
    // Joomla.twoFactorMethodChange = function (e) {
    //     var selectedPane = 'com_users_twofactor_' + jQuery('#jform_twofactor_method').val();
    //     jQuery.each(
    //         jQuery('#com_users_twofactor_forms_container>div'),
    //         function (i, el) {
    //             if (el.id != selectedPane) {
    //                 jQuery('#' + el.id).hide(0);
    //             } else {
    //                 jQuery('#' + el.id).show(0);
    //             }
    //         }
    //     );
    // }
</script>
@endsection