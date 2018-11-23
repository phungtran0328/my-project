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
        <ul class="breadcrumb">
            <li><a href="{{url('/index')}}">Trang chủ</a></li>
            <li class="active">{{$category->LS_TEN}}</li>
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
                                    @foreach($authors as $author)
                                        <li><a href="{{url('category/author',$author['id'])}}">{{$author['name']}}</a></li>
                                    @endforeach
                                    @foreach($translators as $translator)
                                        <li><a href="{{url('category/author',$translator['id'])}}">{{$translator['name']}}</a></li>
                                    @endforeach
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
                                @for($i=0;$i<count($category_paginate);$i++)
                                    <?php
                                    $temp = new \App\Book();
                                    $cate_book = $temp->getBookPromotion($category_paginate[$i]->S_MA);
                                    ?>
                                    @if($cate_book['in_stock']>0)
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <div style="border: 1px solid #dddddd; margin-bottom: 20px">
                                                <div class="single-item">
                                                    <div class="single-item-header text-center">
                                                        <a href="{{url('/chi-tiet-sach',$cate_book['id'])}}">
                                                            <img src="images/avatar/{{$cate_book['image']}}" alt="" width="90%" height="90%">
                                                        </a>
                                                    </div>
                                                    <div class="single-item-body text-center">
                                                        <a href="{{url('/detail',$cate_book['id'])}}" class="single-item-title" style="font-size: 14px">
                                                            {{ str_limit($cate_book['name'], $limit = 18, $end = '...') }}</a>
                                                        <p class="single-item-price" style="font-size: 13px">
                                                            @if(isset($cate_book['sale']))
                                                                <span class="flash-del">{{number_format($cate_book['price'])}} đ</span>
                                                                <span class="flash-sale">{{number_format($cate_book['sale'])}} đ</span>
                                                            @else
                                                                <span>{{number_format($cate_book['price'])}} đ</span>
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
                        {{$category_paginate->render()}}
                        <div class="space50">&nbsp;</div>

                        <div class="beta-products-list">
                            <h4>Xem thêm ...</h4>
                            <div class="beta-products-details">

                                <div class="clearfix"></div>
                            </div>
                            <div class="row">

                            </div>
                            <div class="space40">&nbsp;</div>

                        </div> <!-- .beta-products-list -->
                    </div>
                </div> <!-- end section with sidebar and main content -->


            </div> <!-- .main-content -->
        </div> <!-- #content -->
    </div> <!-- .container -->

@endsection
