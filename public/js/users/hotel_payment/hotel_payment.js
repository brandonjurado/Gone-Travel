define(function(require){
	var ko = require("knockout");
	var router = require("plugins/router");
	require("datepicker");
	require("async");
	require('jrating');
	require("knockout-notify");
	var mapping = require("mapping");

	var self = this;
	self.description = ko.observable();
	self.hotelName = ko.observable();
	self.price = ko.observable();
	self.hotelLocation = ko.observable();
	self.rooms = ko.observable();
	self.stars = ko.observable();
	self.address = ko.observable();
	self.latitude = ko.observable();
	self.longitude = ko.observable();
	self.message = ko.observable();
	self.url = ko.observable();
	self.tripAdvisor = ko.observable("tripadvisor.com");

	// form fields
	self.startDate = ko.observable("11-13-2016");
	self.endDate = ko.observable("15-12-2016");
	self.roomType = ko.observable("deluxe");
	self.fullName = ko.observable();
	self.cardNumber = ko.observable();
	self.expirationDate = ko.observable();
	self.securityCode = ko.observable();

	self.drawMap = function(addr){
		var location = {lat: self.latitude(), lng: self.longitude()};
		// draw map
		var map = new google.maps.Map(document.getElementById("hotelMapInfo"),{
			center: location,
			zoom: 18,
			mapTypeId: 'satellite',
		});


		// find location with geocoding
		var geoCoder = new google.maps.Geocoder();
		geoCoder.geocode({
			address: addr
		}, function(results, status){
			if(status === 'OK'){
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					position: results[0].geometry.location,
					map: map
				});
			}
			else{
				console.log(addr);
				console.log("No location for this hotel");
			}
		})

		// draw marker

	}

	self.getHotelInfo = function(hotelName) {
		var genericDescription = "It is a low-rise boutique hotel \
		that features a pool in the back side of the building, although \
		it's empty. The " + hotelName + " also features an underground parking garage \
		that can be accessed from any place of convienience."

		$.ajax({
			url: "../public/hotels?category=specific"
				 +"&name="+hotelName,
			type: "GET",
			success: function(response){
				data = JSON.parse(response)[0];
				console.log(data);
				self.price("$"+data["price"]+" per night");
				self.description(genericDescription);
				self.rooms(data["rooms"] + " rooms available");
				self.address(data["address"]);
				self.hotelLocation(data["location"]);
				self.latitude(data["latitude"]);
				self.longitude(data["longitude"]);
				self.stars(data["stars"]);
				self.url(data["url"]);
				self.tripAdvisor("http://tripadvisor.com" + data["tripadvisorUrl"]);
			}
		});
	}

	self.makeBooking = function() {
		$_token = "{{ csrf_token() }}";

		$.ajax({
			url: "../public/process_payment?type=hotels"
				+"&roomType="+ self.roomType()
				+"&price="+ self.price()
				+"&startDate="+ self.startDate()
				+"&endDate="+self.endDate()
				+"&hotel="+self.hotelName(),
			type: "GET",
			success: function(response){
				if(response === "startDate conflict"){
					alert(response);
				}
				else{
					alert("You successfully booked a room! We sent you an updated travel plan");
					self.message = ko.observable("You successfully booked a room! We sent you an updated travel plan");
				}
			}
		})
	}

	return {
		hotelName: hotelName,
		address: address,
		price: price,
		rooms: rooms,
		description: description,
		hotelLocation: hotelLocation,
		stars: stars,
		message: message,

		startDate: startDate,
		endDate: endDate,
		roomType: roomType,
		fullName: fullName,
		cardNumber: cardNumber,
		expirationDate: expirationDate,
		securityCode: securityCode,

		activate: function(){
			hotelName(router.activeInstruction().params[0]);
			getHotelInfo(self.hotelName());
			setTimeout(function(){
				mapping.done(function(){
	        		drawMap(self.address() +","+ self.hotelLocation());
	        	})
			}, 2000);
		},

		attached: function(){
        	$(".datepicker").datepicker({
        		format:"yyyy-mm-dd",
        		autoclose: true,
        		todayBtn: true,
        		todayHighlight: true,
        		orientation: "bottom"
        	});

        	setTimeout(function(){
        		$('.ratings-bar').barrating({
                theme: 'css-stars',
                readonly: true,
            })}, 600);
		}
	}
});
