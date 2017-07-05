<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AuthenticationController extends Controller
{
    public function __construct(){}

    public function login(Request $request){
        $username = $request->input("user");
        $password = $request->input("password");
    }

    public function signUp(){

    }
}
