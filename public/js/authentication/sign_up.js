/**
 * @brief
 * @constructor
 */
function SignUpViewModel(){
    var self = this;
    this.firstName = ko.observable("");
    this.lastName = ko.observable("");
    this.email = ko.observable("");
    this.password = ko.observable("");
    this.hasError = ko.observable(false);
    this.hasSuccess = ko.observable(false);
    this.errorMessage = ko.observable("");

    this.generateErrorHtml = ko.computed(function(){
        return "<span class='fa fa-exclamation-triangle'></span> "+ this.errorMessage();
    }, this);
    
    this.generateSuccessHtml = ko.computed(function(){
        return "<span class='fa fa-exclamation'></span> "+ this.errorMessage();
    }, this);

    /**
     * @brief validates the form fields
     */
    this.validate = function(){
        // validate fields
        if(this.firstName() === "" || this.lastName() === ""||
            this.email() === "" || this.password() === ""){
            this.errorMessage(" Some fields are empty!");
            this.hasError(true);

            return false;
        }
        else{
            // validate email
            var emailRegex = /\S+@\w+\.\S+/;
            if (!emailRegex.test(this.email())) {
                this.errorMessage("Your email is invalid!");
                this.hasError(true);

                return false;
            }
            else {
                // validate password
                if(this.password().length < 9){
                    this.errorMessage("Your password is too short!");
                    this.hasError(true);

                    return false;
                }
                else{
                    this.hasError(false);
                    $.ajax({
                            type: "GET",
                            url: "../public/sign_up?user="+this.email()
                                +"&pass="+this.password()
                                +"&firstName="+this.firstName()
                                +"&lastName="+this.lastName(),
                            async: true,
                            success: function(data){
                                if(data === "user exists"){
                                    self.errorMessage("User with this email already exists!");
                                    self.hasError(true);
                                }
                                else{
                                    self.errorMessage("Successfully signed up. You can login now!");
                                    self.hasError(false);
                                    self.hasSuccess(true);
                                }
                            }
                    });
                    return true;
                }
            }
        }
    }

    /**
     * @brief
     */
    this.register = function(){
        if(this.validate()) {
            console.log("form is good!");
        }
    }
}

$(document).ready(function() {
    ko.applyBindings(new SignUpViewModel());
});
