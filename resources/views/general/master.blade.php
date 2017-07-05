<!DOCTYPE html>
<html lang="en">
<head>
    @yield("page_title")

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    <link rel="stylesheet" href="{{URL::asset('components/animate.css/animate.css')}}" />
    <script src="{{URL::asset('components/knockout/dist/knockout.js')}}"></script>
    <script src="{{URL::asset('components/knockout.animate/src/knockout.animate.js')}}"></script>

    <link rel="stylesheet" href="{{URL::asset('components/bootstrap/dist/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('css/sass-output/general/master.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('components/font-awesome/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('components/magic/magic.min.css')}}" />
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" />

    @if($showFooter == true)
        <script src="{{URL::asset('components/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{URL::asset('components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    @endif

    @yield("page_scripts_and_styles")
</head>
<body>
    <nav class="master navbar navbar-static navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="{{url('home')}}" class="navbar-brand"></a>
            </div>
            <ul class="nav navbar-nav navbar-left">
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if($showLogin == true)
                <li><a href="{{url('sign_up')}}"><span class="fa fa-user"></span> Sign Up</a></li>
                <li><a href="{{url('sign_in')}}"><span class="fa fa-unlock-alt"></span> Log In</a></li>
                @else
                <li><a href="{{url('sign_out')}}"><span class="fa fa-sign-out"></span> Log out</a></li>
                @endif
            </ul>
        </div>
    </nav>
    @yield("page_content")
    @if($showFooter == true)
    <footer class="">
        <div class="container">
            <p class="center">
                Copyright <?php $carbon = new Carbon\Carbon(); echo "© ". $carbon->now()->year; ?> &nbsp; gone.com -
                &nbsp;
                <a href="#"> Help </a> -
                <a href="#">Privacy & Terms</a>
            </p>
        </div>
    </footer>
    @endif
</body>
</html>