define(function(require){
	var ko = require("knockout");
	var router = require("plugins/router");
	require('jrating');
	require('barrating');

	var self = this;
	self.reviewText = ko.observable();
	self.hotelName = ko.observable();
	self.rating = ko.observable();
	self.hotelLocation = ko.observable();

	self.publish = function(){
		$.ajax({
			url: "../public/reviews?type=add"
				+"&text="+self.reviewText()
				+"&rating="+self.rating()
				+"&hotel="+self.hotelName()
				+"&location="+self.hotelLocation(),

			type: "GET",
			success: function(){
				alert("Review added");
			}
		})
	}

	return {
		hotelName: hotelName,
		reviewText: reviewText,
		rating: rating,
		hotelLocation: hotelLocation,
		publish: publish,

		activate: function(){
			hotelName(router.activeInstruction().params[0]);
			hotelLocation(router.activeInstruction().params[1]);
		},

		attached: function(){
            //$(".ratings-bar").rating({readonly: true});
            $('.ratings-bar').barrating({
                theme: 'css-stars',
            });
        }
	}
});