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
            <li class="active">{{$author->TG_TEN}}</li>
        </ul>
    </div>
    <div class="container">
        <div id="content" class="space-top-none">
            <div class="main-content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="beta-products-list">
                            <div class="row">
                                @for($i=0;$i<count($books);$i++)
                                    @if($books[$i]['in_stock']>0)
                                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                            <div style="border: 1px solid #dddddd; margin-bottom: 20px">
                                                <div class="single-item">
                                                    <div class="single-item-header text-center">
                                                        <a href="{{url('/chi-tiet-sach',$books[$i]['id'])}}">
                                                            <img src="images/avatar/{{$books[$i]['image']}}" alt="" width="90%" height="90%">
                                                        </a>
                                                    </div>
                                                    <div class="single-item-body text-center">
                                                        <a href="{{url('/detail',$books[$i]['id'])}}" class="single-item-title">
                                                            {{ str_limit($books[$i]['name'], $limit = 18, $end = '...') }}</a>
                                                        <p class="single-item-price">
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
                            @if(!is_null($temp_books))
                                {{$temp_books->links()}}
                            @else
                                {{$temp_trans_book->render()}}
                            @endif

                        </div> <!-- .beta-products-list -->
                        <div class="space50">&nbsp;</div>
                    </div>
                </div> <!-- end section with sidebar and main content -->
            </div> <!-- .main-content -->
        </div> <!-- #content -->
    </div> <!-- .container -->
@endsection
