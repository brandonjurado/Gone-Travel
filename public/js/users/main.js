/**
 * @brief dependencies
 */
requirejs.config({
    paths: {
        "jquery":       "../../components/jquery/dist/jquery.min",
        "text":         "../../components/requirejs-text/text",
        "durandal":     "../../components/durandal/js",
        "plugins":      "../../components/durandal/js/plugins",
        "transitions":  "../../components/durandal/js/transitions",
        "knockout":     "../../components/knockout/dist/knockout",
        "bootstrap":    "../../components/bootstrap/dist/js/bootstrap.min",
        "barrating":    "../../components/bootstrap-star-rating/js/star-rating.min",
        "jrating":      "../../components/jquery-bar-rating/dist/jquery.barrating.min",
        "overlay":      "../../js/users/overlay/overlay",
        "spinjs":       "../../components/spin.js/spin.min",
        "datepicker":   "../../components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min",
        "timepicker":   "../../components/bootstrap-timepicker/js/bootstrap-timepicker",
        "async":        "../../components/requirejs-plugins/src/async",
        "mapping":      "../../js/users/mapping/mapping",
        "knockout-notify": "../../components/knockout-notify/KnockoutNotification.knockout.min"
    }
});

/**
 * @brief modula definition for main
 */
define(function(require){
    var system = require('durandal/system');
    var app = require('durandal/app');

    // TODO: turn on debugging for now, remove later
    system.debug(true);

    app.title = "Travel Site - User";

    // enable router for page navigation
    app.configurePlugins({
        router: true,
        dialog: true
    });

    app.start().then(function(){
        app.setRoot("shell/shell");
    });
});


