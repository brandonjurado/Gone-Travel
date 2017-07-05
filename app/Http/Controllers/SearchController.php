<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use App\Http\Requests;
use DB;
use Illuminate\View\View;

class SearchController extends Controller
{
    // search for hotels from database
	const FLIGHT_REQ_FROM = 0;
	const FLIGHT_REQ_TO   = 1;
	const YEAR = 0;
	const MONTH = 1;
	const DAY = 2;
	const HOUR_OF_DAY = 3;

    public function executeHotelSearch() 
	{	
		$keywords = Input::get('keywords');

		$hotels = DB::table('hotels')
					->where('hotelName', 'LIKE',"$keywords%")
					->orwhere('cityName', 'LIKE',"$keywords%")
					->orwhere('stateName', 'LIKE',"$keywords%")
					->orwhere('address', 'LIKE',"$keywords%")
					->orwhere('location', 'LIKE',"$keywords%")
					->get();

		$searchHotels= new \Illuminate\Database\Eloquent\Collection();

		foreach($hotels as $h) {
			if(Str::contains(Str::lower($h->hotelName), Str::lower($keywords))) {
				$searchHotels->add($h);
			}
		}

		return json_encode($hotels);
	}


	/**

	**/
	public function makeFlightAPIRequest($type, $airportCode, $time)
	{
		$restURL = "https://api.flightstats.com/flex/schedules/rest/v1/json/";

		switch($type) {
			case self::FLIGHT_REQ_TO:
				$restURL .= "to/".$airportCode."/arriving/".$time[self::YEAR]."/"
								 .$time[self::MONTH]."/".$time[self::DAY]."/".$time[self::HOUR_OF_DAY];
				break;
			case self::FLIGHT_REQ_FROM:
				$restURL .= "from/".$airportCode."/departing/".$time[self::YEAR]."/"
				 				 .$time[self::MONTH]."/".$time[self::DAY]."/".$time[self::HOUR_OF_DAY];
				break;
			default:
				return "wrong type code";
				break;
		}

		$restURL .= "?appId=060ac1e0&appKey=576437121a869e519ab35039f124aa21&"
				 	."utc=false&numHours=1&maxFlights=5";

		//echo $restURL."<br>";

		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, $restURL);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Don't print the result
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($curl, CURLOPT_TIMEOUT, 10);
		curl_setopt($curl, CURLOPT_FAILONERROR, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Don't verify SSL connection
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); //         ""           ""
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json")); // Send as JSON

		$results = curl_exec($curl);
		//echo $results."<br>";

		return $results;
	}
	

	// search for flights :?
	public function executeFlightSearch($from, $to, $originTime, $destinationTime)
	{
		$originTimeFields = explode(',', $originTime);
		$destinationTimeFields = explode(',', $destinationTime);

		$originFlights = $this->makeFlightAPIRequest(self::FLIGHT_REQ_FROM, $from, $originTimeFields);
		$destinationFlights = $this->makeFlightAPIRequest(self::FLIGHT_REQ_TO, $to, $destinationTimeFields);

		// find all flights that contain both origin and destination
		//var_dump($originFlights);
		//echo "<br>";
		//var_dump($destinationFlights);
		
		$originObj = json_decode($originFlights, true);
					
		$output = "[";
		foreach($originObj["scheduledFlights"] as $flight) {

			if($flight["arrivalAirportFsCode"] == $to) {
				$fields = array(
					"flightNumber"=> $flight["carrierFsCode"]." ".$flight["flightNumber"],
					"departureAirport" => $flight["departureAirportFsCode"],
					"departureTerminal" => $flight["departureTerminal"],
					"departureTime" => $flight["departureTime"],
					"arrivalAirport" => $flight["arrivalAirportFsCode"],
					"arrivalTerminal" => $flight["arrivalTerminal"],
					"arrivalTime" => $flight["arrivalTime"],
					"numStops" => $flight["stops"],
					"price" => "Price: $".rand(200, 700)
				);
				$output .= json_encode($fields).",";
			}
		}
		
		$output .= "{}]";
		echo $output;
	}


	/**
	**/
	public function executeSearch(Request $request)
	{
		$type = $request->input("type");
		
		switch($type){
			case "hotels":
				return $this->executeHotelSearch();
				break;

			case "flights":
				$from = $request->input("from");
				$to = $request->input("to");
				$originTime = $request->input("originTime");
				$destinationTime = $request->input("destinationTime");

				return $this->executeFlightSearch($from, $to, $originTime, $destinationTime);
				break;

			default:
				break;
		}
	}
}
