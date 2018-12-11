<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 08/29/2018
 * Time: 1:39 PM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="text/html; charset=utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/x-icon" href="book.ico" />
    <title>Bookstore</title>
    <base href="{{asset('')}}">
    {{--đường dẫn từ public--}}
    <!-- Bootstrap Core CSS -->
    <link href="admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="admin/assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="admin/assets/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="admin/assets/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="admin/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <!--<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>-->
    {{--<![endif]-->--}}

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    @include('admin/header')

    @yield('content')

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="admin/assets/vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="admin/assets/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="admin/assets/vendor/metisMenu/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="admin/assets/vendor/raphael/raphael.min.js"></script>
<script src="admin/assets/vendor/morrisjs/morris.min.js"></script>
<script src="admin/assets/data/morris-data.js"></script>

<!-- Custom Theme JavaScript -->
<script src="admin/assets/dist/js/sb-admin-2.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
/*    $(document).ready(function() {
        $('#myListBook').DataTable( {
            "scrollX": true
        } );
    } );*/
$('#myTooltipBook [data-toggle="tooltip"]').tooltip({
    placement: 'left',
    html: true
});
$('#myTooltipSlider [data-toggle="tooltip"]').tooltip({
    animated: 'fade',
    placement: 'right',
    html: true
});
$(document).ready(function() {
    $('#invoice-in').DataTable();
});
$(document).ready(function() {
    $('#book').DataTable();
});
$(document).ready(function() {
    $('#order').DataTable();
});
$(document).ready(function() {
    $('#my_list').DataTable();
});
$(document).ready(function() {
    $('#show_list_book').DataTable();
});
$(document).ready(function() {
    $('#show_list_customer').DataTable();
});
</script>
</body>

</html>