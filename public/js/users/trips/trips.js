define(function(require){
    var ko = require('knockout');
  
    var self = this;
    self.bookedHotels = ko.observableArray([]);
    self.bookedFlights = ko.observableArray([]);
  
    self.getUserPayments = function() {
        $.ajax({
            url: "../public/trips",
            type: "GET",
            success: function(response){
                data = JSON.parse(response);
                console.log(data["hotels"]);

                data["hotels"].forEach(function(data){
                    self.bookedHotels.push(data);
                });


                data["flights"].forEach(function(data){
                    self.bookedFlights.push(data);
                });

                console.log(hotelsRecords);
            }
        });
    }

    return {
        bookedHotels: bookedHotels,
        bookedFlights: bookedFlights,
        activate: function(){
            self.bookedHotels([]);
            self.getUserPayments();
            return;
        },
        attached: function(){
        }
    }
});