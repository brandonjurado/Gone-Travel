<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use DB;
use App\Http\Requests;
use App\User;

class SignUpController extends Controller{
    public function __construct(){}

    public function signUp(Request $request){
        // if the query string has parameters 'user' and 'pass'
        if($request->has('user') && $request->has('pass')){
            $userEmail = $request->input("user");
            $userPassword = $request->input("pass");
            $userLastName = $request->input("lastName");
            $userFirstName = $request->input("firstName");
            
            // create a user if it does not exists
            if(!DB::table('users')->where('email', $userEmail)->exists()){
                User::create([
                    'lastName' => $userLastName,
                    'firstName' => $userFirstName,
                    'email' => $userEmail,
                    'password' => Hash::make($userPassword),
                ]);
                
                // return to sign_up page for now
                return view("authentication/sign_up");
            }
            else{
                echo "user exists";
            }
        }
        else{
            return view("authentication/sign_up");
        }

        // create php session key for user
    }
}
