define(function(require){
    var ko = require('knockout');
             require('datepicker');
             require('timepicker');

  
    var self = this;
  
    self.flights = ko.observableArray([]);
    self.sourceAirport = ko.observable("DFW");
    self.destinationAirport = ko.observable("JFK");
    self.departureDate = ko.observable("2016-11-17");
    self.arrivalDate = ko.observable("2016-11-18");
    self.selectedFlight = ko.observable();
    
    self.searchFlights = function() {
        console.log("searching for flight");
      
        var formattedDepartureDate = self.departureDate().replace(/-/g, ",") + ",10";
        var formattedArrivalDate = self.arrivalDate().replace(/-/g, ",") + ",10";
        
        console.log(formattedDepartureDate);
      
        $.ajax({
          url: "../public/executesearch?type=flights" +
               "&from=" + self.sourceAirport() +
               "&to=" + self.destinationAirport() +
               "&originTime=" + formattedDepartureDate +
               "&destinationTime=" + formattedArrivalDate ,
        }).done(function(response) {
            var obj = $.parseJSON(response);
            self.flights([]);
          
            obj.forEach(function(data) {
                self.flights.push(data);
            });
        });
    }

    self.openPaymentsView = function(index) {
        var that = this;

           var router = require('plugins/router');
           console.log(index);


           router.navigate("#flight_payments/"+index["departureAirport"]
                                              + "/" + index["arrivalAirport"]
                                              + "/" + index["price"]
                                              + "/" +index["flightNumber"]);
    }
  
    return {
      flights: flights,
      sourceAirport: sourceAirport,
      destinationAirport: destinationAirport,
      searchFlights: searchFlights,
      departureDate: departureDate,
      arrivalDate: arrivalDate,
      openPaymentsView: openPaymentsView,
      selectedFlight: selectedFlight,

      activate: function(){
        if(flights().length > 0){
          return;
        }
        return;
      },
      attached: function(){
        $(".datepicker").datepicker({format:"yyyy-mm-dd"});
        $(".timepicker").timepicker();
      }
    }
});