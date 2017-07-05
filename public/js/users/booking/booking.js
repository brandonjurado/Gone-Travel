define(function (require) {
    var http    = require('plugins/http'),
        ko      = require('knockout'),
        app     = require('durandal/app'),
        Overlay = require('overlay'),
        dialog  = require('plugins/dialog');
                  require('jquery');
                  require('bootstrap');
                  require('barrating');
                  require('jrating');
        router  = require('plugins/router');
  
    var self = this;
    var overlay = new Overlay();
    
    self.popularHotels = ko.observableArray();
    self.highestRated = ko.observableArray();
    self.searchKeyword = ko.observable();
    self.searchResults = ko.observableArray();
    self.activeTab = null;
    
    self.searchHotels = function(){
        var that = this;
        $.getJSON('../public/executesearch', {type:"hotels", keywords: that.searchKeyword()}, function(response){
            that.searchResults([]);
            console.log(overlay);
          
            //each object from response (query to db) is added into searchResults array
            response.forEach(function(data){
                that.searchResults.push(data);
            });
            
            // add tab search tab

            //get active tab
            $(".top-content.panel ul.nav.nav-tabs").append(
                '<li class="nav-item active">'+
                '<a data-toggle="tab" data-target="#searchResults">'+
                '<span class="fa fa-search"></span> Search Results</a>'+
                '</li>');

            var searchfragment = "";
            that.searchResults().forEach(function(data){
                searchfragment += '<div class="card-grid-holder row">\
                      <!-- cards -->\
                      <div class="cards-grid" data-bind="foreach: searchResults">\
                        <div class="col-sm-4 center-block card">\
                            <div class="card-image">\
                                <div class="room-image">\
                                  <p data-bind="text: hotelName"></p>\
                                </div>\
                            </div>\
                            <div class="card-content">\
                               <p data-bind="text: address"></p>\
                               <p data-bind="text: location"></p>\
                            </div>\
                            <div class="card-action">\
                                <a data-bind="click: function($index){openHotelPaymentsView($index)}"><span class="fa fa-book"></span> Book a room</a>\
                                <a data-bind="click: function($index){openHotelReviewsView($index)}"><span class="fa fa-pencil"></span> Write a review</a>\
                                <!-- <input class="ratings-bar" class="rating-loading"  data-bind="value: $data.stars" /> -->\
                                <select data-bind="value: $data.stars" class="ratings-bar">\
                                    <option value="1">1</option>\
                                    <option value="2">2</option>\
                                    <option value="3">3</option>\
                                    <option value="4">4</option>\
                                    <option value="5">5</option>\
                                </select>\
                            </div>\
                        </div>\
                      </div>\
                    </div>';
            });
                $('.tab-content #searchResults').html(searchfragment);

            $('.nav-tabs a[data-target="#searchResults"]').tab('show');
        });
    };
  
    self.closeSearchResults = function(){
          overlay.close();
    }

    self.getPopular = function(){
        var that = this;
        $.getJSON('../public/hotels?category=popular', function(response){
            // console.log(response);
            response.forEach(function(data){
                //console.log(data);
                that.popularHotels.push(data);
            });
            
            $('.ratings-bar').barrating({
                theme: 'css-stars',
                readonly: true,
            });

            //console.log(that.popularHotels())
        });
    };

    self.getHighestRated = function(){
        var that = this;
        $.getJSON('../public/hotels?category=highest', function(response){
            // console.log(response);
            response.forEach(function(data){
                //console.log(data);
                that.highestRated.push(data);
            });

            //console.log(that.highestRated())

            $('.ratings-bar').barrating({
                theme: 'css-stars',
                readonly: true,
            });
        });
    };

    self.openHotelPaymentsView = function(index){
        var that = this;

        router.navigate("#hotel_payments/"+index["hotelName"]);
    }

    self.openHotelReviewsView = function(index){
        var that = this;

        router.navigate("#reviews/"+index["hotelName"]+"/"+index["address"]);
    }
 
    return {
        popularHotels: popularHotels,
        highestRated: highestRated,
        searchKeyword: searchKeyword,
        searchHotels: searchHotels,
        searchResults: searchResults,
        closeSearchResults: closeSearchResults,
        openHotelPaymentsView: openHotelPaymentsView,
        openHotelReviewsView: openHotelReviewsView,
      
        activate: function () {
            if(popularHotels().length > 0){
                return;
            }
          
            self.getPopular();
            self.getHighestRated();

            $('a[data-toggle="tab"]').on('shown', function (e) {
                self.activeTab = e.target;
            })
        },
        
        attached: function(){
            //$(".ratings-bar").rating({readonly: true});
            $('.ratings-bar').barrating({
                theme: 'css-stars',
                readonly: true,
            });
        }
    };
});