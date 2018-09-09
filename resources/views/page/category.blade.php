<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 09/07/2018
 * Time: 10:47 AM
 */
?>

@extends('master')
@section('content')

    <div class="container">
        <div id="content" class="space-top-none">
            <div class="main-content">
                <div class="space60">&nbsp;</div>
                <div class="row">
                    <div class="col-sm-3">
                        <ul class="aside-menu">
                           {{-- @foreach ($danhmuc as $item)
                                <li><a href="{{route('danh-muc-sach',$item->LS_MA)}}">{{$item->LS_TEN}}</a></li>
                            @endforeach--}}

                        </ul>
                    </div>
                    <div class="col-sm-9">
                        <div class="beta-products-list">
                            <h4>Sách mới - Nổi bật</h4>
                            <div class="beta-products-details">
                                {{--<p class="pull-left">Tìm thấy {{count($sach_theoloai)}}</p>--}}
                                <div class="clearfix"></div>
                            </div>

                            <div class="row">
                                {{--@foreach($sach_theoloai as $item)
                                    <div class="col-sm-4">
                                        <div class="single-item">
                                            <div class="single-item-header">
                                                <a href="{{route('chi-tiet-sach', $item->S_MA)}}"><img src="images/{{$item->S_HINHANH}}" height="270" width="200" alt=""></a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{$item->S_TEN}}</p>
                                                <p class="single-item-price">
                                                    @if($item->S_GIAMGIA==0)
                                                        <span class="flash-sale">{{number_format($item->S_GIA)}} VND</span>
                                                    @else
                                                        <span class="flash-del">{{number_format($item->S_GIA)}} VND</span>
                                                        <span class="flash-sale">{{number_format($item->S_GIAMGIA)}} VND</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="single-item-caption">
                                                <a class="add-to-cart pull-left" href="{{route('chi-tiet-sach', $item->S_MA)}}"><i class="fa fa-shopping-cart"></i></a>
                                                <a class="beta-btn primary" href="{{route('chi-tiet-sach', $item->S_MA)}}">Xem chi tiết <i class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach--}}
                            </div>
                            <br/>
                        </div> <!-- .beta-products-list -->

                        <div class="space50">&nbsp;</div>

                        <div class="beta-products-list">
                            <h4>Xem thêm ...</h4>
                            <div class="beta-products-details">

                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                {{--@foreach($inter as $in)
                                    <div class="col-sm-4">
                                        <div class="single-item">
                                            <div class="single-item-header">
                                                <a href="{{route('chi-tiet-sach', $in->S_MA)}}"><img src="images/{{$in->S_HINHANH}}" width="230" height="280" alt=""></a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{$in->S_TEN}}</p>
                                                <p class="single-item-price">
                                                    @if($in->S_GIAMGIA==0)
                                                        <span class="flash-sale">{{number_format($in->S_GIA)}} VND</span>
                                                    @else
                                                        <span class="flash-del">{{number_format($in->S_GIA)}} VND</span>
                                                        <span class="flash-sale">{{number_format($in->S_GIAMGIA)}} VND</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="single-item-caption">
                                                <a class="add-to-cart pull-left" href="{{route('chi-tiet-sach', $in->S_MA)}}"><i class="fa fa-shopping-cart"></i></a>
                                                <a class="beta-btn primary" href="{{route('chi-tiet-sach', $in->S_MA)}}">Xem chi tiết <i class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach--}}
                            </div>
                            <div class="space40">&nbsp;</div>

                        </div> <!-- .beta-products-list -->
                    </div>
                </div> <!-- end section with sidebar and main content -->


            </div> <!-- .main-content -->
        </div> <!-- #content -->
    </div> <!-- .container -->

@endsection
