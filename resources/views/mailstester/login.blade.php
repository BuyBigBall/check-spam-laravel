@extends('mailstester.layout')

@section('content')
<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">

        <div id="system-message-container">
            <div id="system-message">
                <!-- 
                <div class="alert alert-warning"> 
                    <a class="close" data-dismiss="alert">×</a> 
                    <h4 class="alert-heading">Warning</h4> 
                    <div> 
                        <div class="alert-message">
                            Username and password do not match or you do not have an account yet.
                        </div> 
                    </div> 
                </div> 
                <div class="alert alert-warning">
                    <a class="close" data-dismiss="alert">×</a>
                    <h4 class="alert-heading">Warning</h4>
                    <div>
                        <div class="alert-message">
                            Login denied! Your account has either been blocked or
                            you have not activated it yet.
                        </div>
                    </div>
                </div>
                <div class="alert alert-message">
                    <a class="close" data-dismiss="alert">×</a>
                    <h4 class="alert-heading">Message</h4>
                    <div>
                        <div class="alert-message">
                            Please login first
                        </div>
                    </div>
                </div>
                -->

            </div>
        </div>

        <div class="login">
            <form action="login" method="post" class="form-validate form-horizontal well">
                @csrf
                <fieldset>
                    <div class="control-group ">
                        <div class="control-label">
                            <label id="username-lbl" for="username" class="required">
                                <!-- invalid -->
                                Username<span class="star">&nbsp;*</span>
                            </label>
                        </div>
                        <div class="controls">
                            <input
                                type="text"
                                name="username"
                                id="username"
                                value=""
                                class="validate-username required "
                                size="25"
                                required="required"
                                aria-required="true"
                                autofocus=""
                                aria-invalid="true"/>
                            <!-- invalid -->
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="control-label">
                            <label id="password-lbl" for="password" class="required">
                                Password<span class="star">&nbsp;*</span>
                            </label>
                        </div>
                        <div class="controls">
                            <input
                                type="password"
                                name="password"
                                id="password"
                                value=""
                                class="validate-password required"
                                size="25"
                                maxlength="99"
                                required="required"
                                aria-required="true"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="control-label">
                            <label for="remember">
                                Remember me
                            </label>
                        </div>
                        <div class="controls">
                            <input
                                id="remember"
                                type="checkbox"
                                name="remember"
                                class="inputbox"
                                value="yes"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-primary">
                                Log in
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="return" value="aW5kZXgucGhwP0l0ZW1pZD0xMTE="/>
                    <input type="hidden" name="2387cd0cd1462cbda6de0436ed1ff1c1" value="1"/>
                </fieldset>
            </form>
        </div>
        <div>
            <ul class="nav nav-tabs nav-stacked">
                <li>
                    <a href="https://www.mail-tester.com/manager/login.html?view=reset">
                        Forgot your password?
                    </a>
                </li>
                <li>
                    <a href="https://www.mail-tester.com/manager/login.html?view=remind">
                        Forgot your username?
                    </a>
                </li>
                <li>
                    <a href="https://www.mail-tester.com/manager/login.html?view=registration">
                        Don't have an account?
                    </a>
                </li>
            </ul>
        </div>

    </div>
</div>
@endsection