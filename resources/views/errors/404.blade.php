@extends('general/master')
@section('page_title')
    <title>Page not found</title>
@endsection
@section('page_content')
    <div class="panel">
        <div class="panel-heading">
            <h1><span class="fa fa-exclamation"></span> 404: Page not found.</h1>
        </div>
        <div class="panel-body">
            <p> <img src="{{URL::asset('images/general/gears-gif.gif')}}" />
            We may be working on it or the page does not exists. </p>
        </div>
    </div>
        <?php $showFooter = true ?>
@endsection