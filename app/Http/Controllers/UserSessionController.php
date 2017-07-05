<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use App\User;
use App\hotelpayments;
use App\flightpayments;
use Illuminate\Support\Facades\Redirect;

class UserSessionController extends Controller
{
    //

    public function __construct(){
        // none for now
    }

    public function startSession(Request $request){
        if($request->session()->has('email')){
           header('Access-Control-Allow-Origin: http://travel_site-mosei168m921691.codeanyapp.com');

            header('Access-Control-Allow-Methods: GET, POST');

            header("Access-Control-Allow-Headers: X-Requested-With");
            return view("users/dashboard");
        }
        else{
            return redirect()->route('sign_in');
        }
    }
    
    public function stopSession(Request $request){
        $request->session()->forget("email");
        
        return redirect()->route('sign_in');
    }

    public function getUser(){
        $email = Session::get('email');
        $userInfo = User::where("email","=",$email)->first();

        echo $userInfo->firstName." ".$userInfo->lastName;
    }

    public function getUserTrips(){
        $email = Session::get('email');

        // get hotel payments
        $bookedHotels = hotelpayments::where("user","=", $email)->get();
        $bookedFlights = flightPayments::where("user","=", $email)->get();

        $data = array('hotels'=>$bookedHotels, 'flights'=>$bookedFlights);
        return json_encode($data);
        // get flight payments
    }
}
