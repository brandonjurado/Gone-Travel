<?php $showLogin = true; ?>
@extends('general/master')
@section('page_title')
    <title>Travel Site - Home</title>
    @endsection
@section('page_scripts_and_styles')
    <link rel="stylesheet" href="../public/css/sass-output/general/home.css" />
    @endsection
@section('page_content')
    <div class="container-fluid content">
        <div class="welcome-content panel">
            <div class="panel-body">
                <div class="logo">
                    
                </div>
                <p>
                    The website is to allow users to book plans and search for
                    travel destinations. Once you create an account you can select hotels and flights, 
                    watch for price drops, 
                    have a history list, give ratings of services, rent cars, 
                    plan recreational activities in advance. 
                    
                </p>
                <p><img src="{{URL::asset('images/general/gears-gif.gif')}}" width=40 height=40 > This page is still under construction</p>
            </div>
        </div>
    </div>


    
    <?php $showFooter = true ?>
    @endsection