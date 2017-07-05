<?php $showLogin = true; ?>
@extends("general/master")
    @section("page_title")
        <title>Travel Site - Sign In</title>
    @endsection
    @section("page_scripts_and_styles")
        <script src="../public/js/authentication/sign_in.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../public/css/sass-output/authentication/sign_in.css" />
    @endsection
    @section("page_content")
        <div class="contiainer sign-in-form magictime puffIn" id="signIn">
            <div class="panel">
                <div class="panel-heading sign-in-form-header">
                    <h3>Sign In</h3>
                </div>
                <div class="panel-body sign-in-form-body">
                    <form>
                        <p data-bind="visible: hasError, html: generateErrorHtml, animate: { animation: 'pulse', state: hasError}" class="form-control form-error"></p>
                        <div class="form-group">
                            <label class="control-label" for="email">Email </label>
                            <input class="form-control" type="email" data-bind="value: userEmail"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="password">Password </label> 
                            <input class="form-control" type="password" data-bind="value: userPassword"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="checkbox">Remember Me </label>
                            <input type="checkbox"/>
                        </div>
                    </form>
                </div>
                <div class = "panel-footer">
                    <button type="submit" data-bind="click: submit" class="btn btn-success">Sign In</button>
                    <a href="{{url('sign_up')}}"class="btn btn-link">Not a member? Regsiter</a>
                </div>
            </div>
        </div>
            <?php $showFooter = true ?>
    @endsection
