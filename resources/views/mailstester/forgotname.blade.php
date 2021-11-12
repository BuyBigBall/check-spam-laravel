@extends('mailstester.layout')

@section('content')
<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">

        <div id="system-message-container"></div>

        <div class="remind">
            <form
                id="user-registration"
                action="https://www.mail-tester.com/manager/login.html?task=remind.remind"
                method="post"
                class="form-validate form-horizontal well">
                <fieldset>
                    <p>Please enter the email address associated with your User account. Your
                        username will be emailed to the email address on file.</p>
                    <div class="control-group">
                        <div class="control-label">
                            <label
                                id="jform_email-lbl"
                                for="jform_email"
                                class="hasPopover required"
                                title=""
                                data-content="Please enter the email address associated with your User account.<br />Your username will be emailed to the email address on file."
                                data-original-title="Email Address">
                                Email Address<span class="star">&nbsp;*</span>
                            </label>
                        </div>
                        <div class="controls">
                            <input
                                type="email"
                                name="jform[email]"
                                class="validate-email required"
                                id="jform_email"
                                value=""
                                size="30"
                                autocomplete="email"
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
                <input type="hidden" name="23672775139cbb4eecd897ab9ae9797b" value="1"/>
            </form>
        </div>

    </div>
</div>
@endsection