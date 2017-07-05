<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Support\Str;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use App\User;

class SignInController extends Controller
{
    public function __construct(){}

    public function signIn(Request $request){
        $userName = $request->input("user");
        $userPassword = $request->input("pass");

        if($request->has('user') && $request->has('pass')) {
            // check if user exists
            if (DB::table('users')->where('email', $userName)->exists()){
                // compare passwords
                $existingUser = User::where("email","=",$userName)->first();
                if(Hash::check($userPassword, $existingUser->password)){
                    // create session
                    Session::put('email', $existingUser->email);
                    $sessionKey = Str::random(30); 
                    Session::put('sessionKey', $sessionKey);
                    
                    return "success";
                }
                else{
                    return "none";
                }
            }
            else{
                return "none";
            }
        }
        else{
            return view("authentication/sign_in");
        }
    }
}
