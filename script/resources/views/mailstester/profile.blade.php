@extends('mailstester.layout')

@section('content')
<div class="profile-edit">
    <script type="text/javascript">
        Joomla.twoFactorMethodChange = function (e) {
            var selectedPane = 'com_users_twofactor_' + jQuery('#jform_twofactor_method').val();

            jQuery.each(
                jQuery('#com_users_twofactor_forms_container>div'),
                function (i, el) {
                    if (el.id != selectedPane) {
                        jQuery('#' + el.id).hide(0);
                    } else {
                        jQuery('#' + el.id).show(0);
                    }
                }
            );
        }
    </script>
    <form
        id="member-profile"
        action="profile-save"
        method="post"
        class="form-validate form-horizontal well"
        enctype="multipart/form-data">
        <fieldset>
            <legend>
                Edit Your Profile
            </legend>
            <input type="hidden" name="jform[id]" id="jform_id" value="15279">
                <div class="control-group">
                    <div class="control-label">
                        <label
                            id="jform_name-lbl"
                            for="jform_name"
                            class="hasPopover required"
                            title=""
                            data-content="Enter your full name."
                            data-original-title="Name">
                            Name<span class="star">&nbsp;*</span>
                        </label>
                    </div>
                    <div class="controls">
                        <input
                            type="text"
                            name="jform[name]"
                            id="jform_name"
                            value="Samir Chakouri"
                            class="required"
                            size="30"
                            required="required"
                            aria-required="true"></div>
                    </div>
                    <div class="control-group">
                        <div class="control-label">
                            <label
                                id="jform_username-lbl"
                                for="jform_username"
                                class="hasPopover"
                                title=""
                                data-content="If you want to change your username, please contact a site administrator."
                                data-original-title="Username">
                                Username</label>
                            <span class="optional">
                                (optional)
                            </span>
                        </div>
                        <div class="controls">
                            <input
                                type="text"
                                name="jform[username]"
                                id="jform_username"
                                value="chakouri"
                                size="30"
                                readonly=""></div>
                        </div>
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
                                <span class="optional">
                                    (optional)
                                </span>
                            </div>
                            <div class="controls">
                                <input type="password" style="display:none">
                                    <input
                                        type="password"
                                        name="jform[password1]"
                                        id="jform_password1"
                                        value=""
                                        autocomplete="off"
                                        class="validate-password"
                                        size="30"
                                        maxlength="99"></div>
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
                                        <span class="optional">
                                            (optional)
                                        </span>
                                    </div>
                                    <div class="controls">
                                        <input
                                            type="password"
                                            name="jform[password2]"
                                            id="jform_password2"
                                            value=""
                                            autocomplete="off"
                                            class="validate-password"
                                            size="30"
                                            maxlength="99"></div>
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
                                                name="jform[email1]"
                                                class="validate-email required"
                                                id="jform_email1"
                                                value="chakouri.pro@gmail.com"
                                                size="30"
                                                autocomplete="email"
                                                required="required"
                                                aria-required="true"></div>
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
                                                    name="jform[email2]"
                                                    class="validate-email required"
                                                    id="jform_email2"
                                                    value="chakouri.pro@gmail.com"
                                                    size="30"
                                                    required="required"
                                                    aria-required="true"></div>
                                            </div>
                                        </fieldset>
                                        <div class="control-group">
                                            <div class="controls">
                                                <button type="submit" class="btn btn-primary validate">
                                                    Submit
                                                </button>
                                                <a
                                                    class="btn"
                                                    href="https://www.mail-tester.com/manager/login/profile.html"
                                                    title="Cancel">
                                                    Cancel
                                                </a>
                                                <input type="hidden" name="option" value="com_users">
                                                    <input type="hidden" name="task" value="profile.save"></div>
                                                </div>
                                                <input type="hidden" name="45adedc08584ba24ea6f3e97d550bc4a" value="1"></form>
                                            </div>
@endsection