<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 08/29/2018
 * Time: 9:45 AM
 */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="book.ico" />
    <title>BookStore</title>
    <base href="{{asset('')}}">
    <link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    {{--<link rel="stylesheet" type="text/css" href="css/login.css">--}}
    <link rel="stylesheet" href="source/assets/dest/css/font-awesome.min.css">
    <link rel="stylesheet" href="source/assets/dest/vendors/colorbox/example3/colorbox.css">
    <link rel="stylesheet" href="source/assets/dest/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="source/assets/dest/rs-plugin/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="source/assets/dest/css/style.css?version=51">
    {{--?version=51 dùng làm mới lại css khi có chỉnh sửa trong file css --}}
    <link rel="stylesheet" href="source/assets/dest/css/animate.css">
    <link rel="stylesheet" title="style" href="source/assets/dest/css/huong-style.css">
    <style>
        /* Add a gray background color and some padding to the footer */
        .carousel-inner img {
            width: 100%; /* Set width to 100% */
            min-height: 200px;
        }

        /* Hide the carousel text when the screen is less than 600 pixels wide */
        @media (max-width: 600px) {
            .carousel-caption {
                display: none;
            }
        }

    </style>
</head>
<body>

    @include('header')


    @yield('content')



    @include('footer')


<!-- include js files -->
<script language="JavaScript" type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script language="JavaScript" type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="source/assets/dest/js/jquery.js"></script>

<script src="source/assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
<script language="JavaScript" type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="source/assets/dest/vendors/bxslider/jquery.bxslider.min.js"></script>
<script src="source/assets/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
<script src="source/assets/dest/vendors/animo/Animo.js"></script>
<script src="source/assets/dest/vendors/dug/dug.js"></script>
<script src="source/assets/dest/js/scripts.min.js"></script>
<script src="source/assets/dest/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="source/assets/dest/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="source/assets/dest/js/waypoints.min.js"></script>
<script src="source/assets/dest/js/wow.min.js"></script>

<!--customjs-->
<script src="source/assets/dest/js/custom2.js"></script>

<script>
    $(document).ready(function($) {
        $(window).scroll(function(){
            if($(this).scrollTop()>150){
                $(".header-bottom").addClass('fixNav');
            }else{
                $(".header-bottom").removeClass('fixNav');
            }}
        )
    });
    $(document).ready(function($){
        $("#myDrop").mouseenter(function(){
            $("#menuDrop").show();
        });
        $("#menuDrop").mouseleave(function(){
            $("#menuDrop").hide();
        });
    });

</script>

</body>
</html>

