define(function(require){
	var router = require("plugins/router");
	var ko = require("knockout");

	var self = this;

	self.departureAirport = ko.observable();
	self.arrivalAirport = ko.observable();
	self.price = ko.observable();
	self.flightNumber = ko.observable();
	self.fullName = ko.observable("John Doe");
	self.cardNumber = ko.observable("123456789");
	self.expirationDate = ko.observable("2016-11-17");
	self.securityCode = ko.observable("123");
	self.hasError = ko.observable(false);
    self.hasSuccess = ko.observable(false);
    self.errorMessage = ko.observable("");

    self.generateErrorHtml = ko.computed(function(){
        return "<span class='fa fa-exclamation-triangle'></span> "+ this.errorMessage();
    }, this);
    
    self.generateSuccessHtml = ko.computed(function(){
        return "<span class='fa fa-exclamation'></span> "+ this.errorMessage();
    }, this);

	self.sendPayment = function(){
		$.ajax({
			url: "../public/process_payment?type=flights"
				+ "&dest=" + self.arrivalAirport() 
				+ "&src=" + self.departureAirport() 
				+ "&price=" + self.price()
				+ "&flight=" + self.flightNumber() 
				+ "&cardNumber=" + self.cardNumber() 
				+ "&expirationDate=" + self.expirationDate()  
				+ "&securityCode=" + self.securityCode() 
				+ "&fullName=" + self.fullName(),
			type: "GET", 
			success: function(response){
				if(response === "success"){
					console.log("all done");

					self.errorMessage("Successfully signed up. You can login now!");
	                                    self.hasError(false);
	                                    self.hasSuccess(true);
				}
				else{
					console.log(response);
				}
			}
		});
	}

	self.validate = function(){
        // validate fields
        if(self.fullName() === "" || self.cardNumber() === ""||
            self.expirationDate() === "" || self.securityCode() === ""){
            self.errorMessage("Some fields are empty!");
            self.hasError(true);

            return false;
        }
        else{
        	self.sendPayment();
        }
    }

	return {
		departureAirport: departureAirport,
		arrivalAirport: arrivalAirport,
		flightNumber: flightNumber,
		price: price,
		name: fullName,
		cardNumber: cardNumber,
		expirationDate: expirationDate,
		securityCode: securityCode,
		sendPayment: sendPayment,
		validate: validate,

		activate: function(){
			var src = router.activeInstruction().params[0];
			var dest = router.activeInstruction().params[1];
			var price = router.activeInstruction().params[2];
			var flight = router.activeInstruction().params[3];

			this.departureAirport(src);
			this.arrivalAirport(dest);
			this.price(price);
			this.flightNumber(flight);

			return;
		}
	}
});