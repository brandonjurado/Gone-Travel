<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\hotelpayments;
use Session;

class PaymentsController extends Controller
{
    //
    public function handleRequest(Request $request){
    	$type = $request->input("type");

    	switch($type){
    		case "flights":
    			return $this->makeFlightPayment();
    			break;
    		case "hotels":
                $data = array('roomType' => $request->input('roomType'),
                              'price'=> $request->input('price'),
                              'hotel' => $request->input('hotel'),
                              'startDate' => $request->input('startDate'),
                              'endDate' => $request->input('endDate'));
    			return $this->makeHotelPayment($data);
    			break;
    		default: 
    			echo "unknown request";
    			break;
    	}
    }


    public function makeFlightPayment(){
    	return "success";
    }

    public function makeHotelPayment($data){
    	// check if user has a payment
        $email = Session::get("email");
        $hotel = $data["hotel"];
        $startDate = $data["startDate"];
        $endDate = $data["endDate"];
        $roomType = $data["roomType"];
        $price = $data["price"];

        if(DB::table('hotelpayments')->where('user', '=', $email)->exists()) {
            // get all for this user
            $userEntries = DB::table('hotelpayments')->where('user', '=', $email)->get();

            foreach ($userEntries as $entry) {
                if($entry->hotel == $hotel && $entry->startDate == $startDate){
                    return "startDate conflict";
                }
            }
        }

        hotelpayments::create([
            'user' => $email,
            'roomType' => $roomType,
            'price' => $price,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'hotel' => $hotel
        ]);
    }
}
