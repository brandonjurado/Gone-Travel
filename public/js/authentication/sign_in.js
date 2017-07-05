function SignInViewModel(){
    var self = this;
    this.userEmail = ko.observable("");
    this.userPassword = ko.observable("");
    this.hasError = ko.observable(false);
    this.errorMessage = ko.observable("");

    this.generateErrorHtml = ko.computed(function(){
        return "<span class='fa fa-exclamation-triangle'></span> "+ this.errorMessage();
    }, this);

    this.submit = function(){
        // validate email
        var emailRegex = /\S+@\w+\.\S+/;
        if(emailRegex.test(this.userEmail())) {
            //send to server
            console.log("valid email");
            $.ajax({
                url: "../public/sign_in?user=" + this.userEmail() + "&pass=" + this.userPassword(),
                type: "GET",
                async: true,
                success: function (data){
                    console.log(data);
                    if (data === "none"){
                        self.errorMessage("Email and password pair is invalid");
                        self.hasError(true);
                    }
                    else{
                        self.hasError(false);
                        window.location = "../public/users";
                    }
                }
            });
        }
        else{
            this.errorMessage("Email is invalid!");
            this.hasError(true);

            return;
        }
    };
}

$(document).ready(function () {
    ko.applyBindings(new SignInViewModel());
});