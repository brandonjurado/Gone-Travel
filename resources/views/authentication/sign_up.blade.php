<?php $showLogin = true; ?>
@extends("general/master")
    @section("page_title")
        <title>Travel Site - Sign Up</title>
    @endsection
    @section("page_scripts_and_styles")
        <link rel="stylesheet" href="../public/css/sass-output/authentication/sign_up.css">
        <script src="../public/js/authentication/sign_up.js"></script>
    @endsection
    @section("page_content")
        <div id="signUp" class="sign-up-form panel magictime slideUpReturn">
            <div class="panel-heading">
                <h3>Sign Up</h3>
            </div>
            <div class="panel-body container-fluid">
                <div class="col-xs-7">
                    <div class="container-fluid">
                        <form class="form-horizontal">
                            <p data-bind="visible: hasError, html: generateErrorHtml, animate: {animation: 'pulse', state: hasError}" class="form-control form-error"></p>
                            <p data-bind="visible: hasSuccess, html: generateSuccessHtml, animate: {animation: 'pulse', state: hasSuccess}" class="form-control form-success"></p>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">First name <sup>*</sup></label>
                                 <div class="col-sm-8">
                                    <input data-bind="value: firstName" class=" form-control" placeholder="e.g John" type="text" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Last name <sup>*</sup></label>
                                <div class="col-sm-8">
                                    <input data-bind="value: lastName" class=" form-control" placeholder="e.g Doe" type="text" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Email <sup>*</sup></label>
                                <div class="col-sm-8">
                                    <input data-bind="value: email" class=" form-control" placeholder="e.g name@org.com"type="text" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Password <sup>*</sup></label>
                                <div class="col-sm-8">
                                    <input data-bind="value: password" class=" form-control" placeholder="must be at least 9 characters" type="password" required />
                                </div>
                            </div>
                            
                            <p class="control-label"><sup>*</sup> Required fields</p>
                        </form>
                    </div>
                </div>
                <div class="info-panel col-xs-5">
                    <img src="../public/images/general/title.png" />
                    <p class="info-panel-text">Go Places With Us!</p>
                </div>
            </div>
            <div class="panel-footer">
                <button data-bind="click: register" class="btn btn-success">Register</button>
                <a href="{{url('sign_in')}}" class="btn btn-link">Have an Account?</a>
            </div>
        </div>
            <?php $showFooter = true ?>
    @endsection
