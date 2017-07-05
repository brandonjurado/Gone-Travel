define(function(require){
    var router = require('plugins/router');
    var ko = require("knockout");
    // adjust ui height on start
    adjustHeight();
    self.userName = ko.observable();

    self.getUsername = function(){
        $.ajax({
            url: "../public/current_user",
            type: "GET",
            success: function(response){
                self.userName(response);
            }
        })
    }

    return {
        router: router,
        activate: function(){
            router.map([
                {
                    route: '', 
                    title: "Hotels", 
                    contentHtml:"<span class='fa fa-bed' style='float: left'></span> Hotels", 
                    moduleId: "booking/booking",
                    nav: true
                },{
                    route: 'flights', 
                    title: "Flights", 
                    contentHtml:"<span class='fa fa-plane' style='float: left'></span> Flights", 
                    moduleId: "flights/flights",
                    nav: true
                },{
                    route: 'rent', 
                    title: "Rent A car", 
                    contentHtml:"<span class='fa fa-car' style='float: left'></span> Rent A Car", 
                    moduleId: "rent/rent",
                    nav: true
                },{
                    route: 'trips', 
                    title: "Trip History", 
                    contentHtml:"<span class='fa fa-clock-o' style='float: left'></span> Trip History", 
                    moduleId: "trips/trips",
                    nav: true
                }
                ,{
                    route: 'flight_payments/:src/:dest/:price/:airline',
                    title: "Flight Payments",
                    contentHtml:"<span class='fa fa-money'></span> Payments",
                    moduleId: "flight_payment/flight_payment",
                    nav: false
                },{
                    route: 'hotel_payments/:hotelName',
                    title: "Hotel Payments",
                    contentHtml:"<span class='fa fa-money'></span> Payments",
                    moduleId: "hotel_payment/hotel_payment",
                    nav: false
                },{
                    route: 'reviews/:hotelName/:address',
                    title: "Reviews",
                    contentHtml:"<span class='fa fa-money'></span> Payments",
                    moduleId: "reviews/reviews",
                    nav: false
                }
            ]).buildNavigationModel();

            self.getUsername();
            return router.activate();
        }
    };
});

$(window).resize(function(){
    adjustHeight();
})

function adjustHeight(){
    var navHeight = $("nav").height();
    var footerHeight = $("footer").height();
    var bodyHeight = $("body").height();

    var contentHeight = bodyHeight - (navHeight + footerHeight);

    $("#applicationHost").height(contentHeight);

    return ;
}
