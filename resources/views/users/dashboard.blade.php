@extends('general/master')
<?php $showLogin = false; ?>
@section('page_scripts_and_styles')
    <link rel="stylesheet" href="../public/css/sass-output/user/shell.css" />
    <link rel="stylesheet" href="../public/components/jquery-bar-rating/dist/themes/bootstrap-stars.css" />
<!--     <script src="../public/components/jquery-bar-rating/dist/jquery.barrating.min.js"></script> -->
    @endsection
@section('page_content')
    <div id="applicationHost">
              
    </div>
    <script src="../public/components/requirejs/require.js" data-main="../public/js/users/main"></script>
    
    <?php /* do not show footer */ $showFooter = false; ?>

    @endsection