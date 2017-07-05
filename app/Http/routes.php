<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('general/home');
});

Route::get('home', ["uses"=>function(){return view('general/home');}, "as"=>"home"]);

Route::get('sign_in', ['uses'=>'SignInController@signIn', 'as'=>'sign_in']);

Route::get('sign_out', 'UserSessionController@stopSession');

Route::get('sign_up', ['uses'=>"SignUpController@signUp",'as'=>"sign_up"]);

Route::get('current_user', 'UserSessionController@getUser');

Route::get('trips', 'UserSessionController@getUserTrips');

Route::get('flights', ['uses'=>function(){return view('services/flights');}, 'as'=>'flights']);

Route::get('users', ['uses'=>"UserSessionController@startSession", 'as'=>'user']);

Route::get('hotels', "HotelsController@handleRequest");

Route::get('executesearch', array('uses' => 'SearchController@executeSearch'));

Route::get('process_payment', "PaymentsController@handleRequest");
