<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 08/29/2018
 * Time: 1:45 PM
 */

$orders = \App\Order::where('DH_TTDONHANG', 0)->get();

$now = strtotime('now');
$last_week = strtotime('-1 week');
//echo $last_week;
$books_low_in_stock = \App\Book::where('S_SLTON','<',10)
                                ->where('S_SLTON','>',0)
                                ->get();
$books_out_stock = \App\Book::where('S_SLTON','=', 0)->get();
$data_low_in_stock = array();
$data_out_stock = array();
foreach ($books_low_in_stock as $key=>$value){
    $data_low_in_stock[$key]=$value->S_TEN;
}
foreach ($books_out_stock as $key=>$value){
    $data_out_stock[$key]=$value->S_TEN;
}
//dd($data_low_in_stock);
//dd(count($data_out_stock));
?>
@extends('admin/master')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-remove fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{count($data_out_stock)}}</div>

                                <div>Sách hết hàng !</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{url('admin/book')}}">
                        <div class="panel-footer">
                            <span class="pull-left">Xem chi tiết</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="glyphicon glyphicon-alert fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{count($data_low_in_stock)}}</div>
                                <div>Sách sắp hết hàng !</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{url('admin/book')}}">
                        <div class="panel-footer">
                            <span class="pull-left">Xem chi tiết</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-shopping-cart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{count($orders)}}</div>
                                <div>Đơn hàng mới !</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{url('admin/order')}}">
                        <div class="panel-footer">
                            <span class="pull-left">Xem chi tiết</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            {{--<div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-support fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">13</div>
                                <div>Support Tickets!</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>--}}
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bell fa-fw"></i> Sách bán ra trong {{$date_book==0 ? '' : 'ngày '.$date_book.' '}}tháng {{$month_book}} năm {{$year_book}}
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form class="form-inline" action="{{url('admin/index')}}" method="get">
                            <select name="date_book" class="form-control">
                                <option value="0">Ngày</option>
                                @for($i=1;$i<32;$i++)
                                    <option value="{{$i}}" {{$i==$date_book ? 'selected' : ''}}>Ngày {{$i}}</option>
                                @endfor
                            </select>
                            <select name="month_book" class="form-control">
                                @for($i=1;$i<13;$i++)
                                    <option value="{{$i}}" {{$i==$month_book ? 'selected' : ''}}>Tháng {{$i}}</option>
                                @endfor
                            </select>
                            <select name="year_book" class="form-control">
                                @for($i=0;$i<count($array_year);$i++)
                                    <option value="{{$array_year[$i]}}" {{$array_year[$i]==$year_book ? 'selected' : ''}}>Năm {{$year_book}}</option>
                                @endfor
                            </select>
                            <button class="btn btn-primary btn-sm">Xem</button>
                        </form>
                        <hr>
                        <table class="table table-hover table-bordered" id="show_list_book">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên</th>
                                <th>SL bán</th>
                                <th>Tổng giá</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $sum_qty = 0; $sum_price = 0;?>
                            @foreach($books as $index=>$book)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$book['name']}}</td>
                                    <td>{{$book['qty']}}</td>
                                    <td>{{number_format($book['price'])}} đ</td>
                                </tr>
                                <?php $sum_qty+=$book['qty']; $sum_price+=$book['price']?>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="2">Tổng cộng</th>
                                <th>{{number_format($sum_qty)}}</th>
                                <th>{{number_format($sum_price)}} đ</th>
                            </tr>
                            </tfoot>
                        </table>
                        <!-- /.list-group -->
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bell fa-fw"></i> Khách hàng mua nhiều trong tháng {{$month_customer}} năm {{$year_customer}}
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form class="form-inline" action="{{url('admin/index')}}" method="get">
                            <select name="month_customer" class="form-control">
                                @for($i=1;$i<13;$i++)
                                    <option value="{{$i}}" {{$i==$month_customer ? 'selected' : ''}}>Tháng {{$i}}</option>
                                @endfor
                            </select>
                            <select name="year_customer" class="form-control">
                                @for($i=0;$i<count($array_year);$i++)
                                    <option value="{{$array_year[$i]}}" {{$array_year[$i]==$year_customer ? 'selected' : ''}}>Năm {{$year_customer}}</option>
                                @endfor
                            </select>
                            <button class="btn btn-primary btn-sm">Xem</button>
                        </form>
                        <hr>
                        <table class="table table-hover table-bordered" id="show_list_customer">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Tổng SL</th>
                                <th>Tổng giá</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i=0; $i<count($customer); $i++)
                                <tr>
                                    <td>{{$i+1}}</td>
                                    <td>{{$customer[$i]['name']}}</td>
                                    <td>{{$customer[$i]['qty']}}</td>
                                    <td>{{number_format($customer[$i]['total'])}}</td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                        <!-- /.list-group -->
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!-- /.panel -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i> Doanh thu năm {{$year_revenue}}
                        <div class="pull-right">
                            <div class="btn-group">
                                <form action="{{url('admin/index')}}" method="get">
                                    <div>
                                        <select name="year_revenue" >
                                            @for($i=0;$i<count($array_year);$i++)
                                                <option value="{{$array_year[$i]}}" {{$array_year[$i]==$year_revenue ? 'selected' : ''}}>Năm {{$year_revenue}}</option>
                                            @endfor
                                        </select>
                                        <button style="height: 20px" class="btn btn-primary btn-xs">Xem</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div id="revenue-chart">
                            {!! $chart_month->container() !!}
                        </div>
                        <!-- /.row -->
                    </div>
                {!! $chart_month->script() !!}
                <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i> Doanh thu loại sách
                        <div class="pull-right">
                            <div class="btn-group">
                                <form action="{{url('admin/index')}}" method="get">
                                    <div>
                                        <select name="month_kob" >
                                            @for($i=1; $i<13; $i++)
                                                <option value="{{$i}}" {{$i==$month_kob ? 'selected' : ''}}>Tháng {{$i}}</option>
                                            @endfor
                                        </select>
                                        <select name="year_kob" >
                                            @for($i=0;$i<count($array_year);$i++)
                                                <option value="{{$array_year[$i]}}" {{$array_year[$i]==$year_kob ? 'selected' : ''}}>Năm {{$year_kob}}</option>
                                            @endfor
                                        </select>
                                        <button style="height: 20px" class="btn btn-primary btn-xs">Xem</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div id="revenue-category-chart">
                            {!! $chart->container() !!}
                        </div>
                    </div>
                {!! $chart->script() !!}
                <!-- /.panel-body -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js" charset="utf-8"></script>
@endsection
