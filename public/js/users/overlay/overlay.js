define( function (require) {
    var ko = require('knockout');
             require('jquery');
    
    var Overlay = function() {
        this.modalId = '';
        this.content = ko.observable('');
        this.hotels = ko.observableArray([]);
    };
  
    Overlay.prototype.open = function(html, id){
        this.modalId = id;
        $(id).css("width","100%");
        console.log("opening");
        this.content(html);
        console.log(this.content());
    }
    
    Overlay.prototype.close = function(){
        $(this.modalId).css("width","0%");
        this.content('');
    }

    return Overlay;
});