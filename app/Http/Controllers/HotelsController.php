<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;

class HotelsController extends Controller
{
    //
    public function __construct(){
        
    }
    
    public function handleRequest(Request $request){
        $category = $request->input('category');
        
        switch($category){
            case "popular":
                return $this->getPopularHotels();
                break;
            case "highest":
                return $this->getHighestRated();
                break;
            case "specific":
                $hotelName = $request->input('name'); 
                return $this->getSpecificHotel($hotelName);
                break;
            case "add_review":
                $hotelName = $request->input('name');
                $reviewText = $request->input('reviewText');
                $rating = $request->input('rating');
                $location = $request->input('location');
                return $this->addReview($hotelName, $reviewText, $rating, $location );
            default:
                return "unknown request";
                break;
        }
        
    }
    
    public function getPopularHotels() {
        $popularHotels = DB::table('hotels')
                        ->where('stars', '>=', '3')
                        ->take(20)
                        ->get();

        return json_encode($popularHotels);
    }


    public function getHighestRated(){
        $highestRated = DB::table('hotels')->where('stars', '=', '5')->get();

        return json_encode($highestRated);
    }


    public function getSpecificHotel($hotelName){
        $hotelInfo = DB::table('hotels')->where('hotelName', '=', $hotelName)->get();
        return json_encode($hotelInfo);
    }

    public function addReview($hotelName, $reviewText, $rating, $location) {

        return "added review";
    }
}
