<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 11/06/2018
 * Time: 10:16 AM
 */
?>
@extends('master')
@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/index')}}">Trang chủ</a></li>
            <li><a href="{{url('/category',$cate->LS_MA)}}">{{$cate->LS_TEN}}</a></li>
            <li class="active">{{$author->TG_TEN}}</li>
        </ul>
    </div>
    <div class="container">
        <div id="content" class="space-top-none">
            <div class="main-content">

                <div class="row">
                    <div class="col-sm-3">
                        <div class="aside-menu">
                            <div style="font-size: 15px; font-weight: bold">
                                TÁC GIẢ
                            </div>
                            <div>
                                <ul>
                                    {{--@foreach($authors as $author)
                                        <li><a href="">{{$author['name']}}</a></li>
                                    @endforeach
                                    @foreach($translators as $translator)
                                        <li><a href="">{{$translator['name']}}</a></li>
                                    @endforeach--}}
                                </ul>
                            </div>
                        </div>
                        {{--<ul class="aside-menu">
                           --}}{{-- @foreach ($danhmuc as $item)
                                <li><a href="{{route('danh-muc-sach',$item->LS_MA)}}">{{$item->LS_TEN}}</a></li>
                            @endforeach--}}{{--

                        </ul>--}}
                    </div>
                    <div class="col-sm-9">
                        <div class="beta-products-list">
                            <h4>Sách mới - Nổi bật</h4>
                            <div class="beta-products-details">
                                {{--<p class="pull-left">Tìm thấy {{count($category_book)}}</p>--}}
                                <div class="clearfix"></div>
                            </div>

                            <div class="row">
                                @for($i=0;$i<count($books);$i++)
                                    @if($books[$i]['in_stock']>0)
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <div style="border: 1px solid #dddddd; margin-bottom: 20px">
                                                <div class="single-item">
                                                    <div class="single-item-header">
                                                        <a href="{{url('/detail',$books[$i]['id'])}}" class="text-center">
                                                            <img src="images/avatar/{{$books[$i]['image']}}" alt="" style="width: 100%;" height="250px">
                                                        </a>
                                                    </div>
                                                    <div class="single-item-body text-center">
                                                        <a href="{{url('/detail',$books[$i]['id'])}}" class="single-item-title" style="font-size: 14px">
                                                            {{ str_limit($books[$i]['name'], $limit = 20, $end = '...') }}</a>
                                                        <p class="single-item-price" style="font-size: 13px">
                                                            @if(isset($books[$i]['sale']))
                                                                <span class="flash-del">{{number_format($books[$i]['price'])}} đ</span>
                                                                <span class="flash-sale">{{number_format($books[$i]['sale'])}} đ</span>
                                                            @else
                                                                <span>{{number_format($books[$i]['price'])}} đ</span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endfor
                            </div>
                            <br/>
                        </div> <!-- .beta-products-list -->
                        @if(!is_null($temp_books))
                            {{$temp_books->links()}}
                            @else
                            {{$temp_trans_book->links()}}
                        @endif

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
