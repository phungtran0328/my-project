<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 11/04/2018
 * Time: 9:42 AM
 */

?>
@extends('master')
@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/index')}}">Trang chủ</a></li>
            <li class="active">Kết quả tìm kiếm</li>
        </ul>
    </div>
    <div class="container text-left">
        <div id="content" class="space-top-none">
            <div class="main-content">
                {{--<div class="space60">&nbsp;</div>--}}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="beta-products-list">
                            <h5>Tìm thấy {{$count}} sách gần giống với từ khóa "{{$q}}"</h5>
                            <div class="beta-products-details">
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                @foreach($books as $book)
                                    @php
                                        $temp = new \App\Book();
                                        $book_search = $temp->getBookPromotion($book->S_MA);
                                    @endphp
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                        <div style="margin-bottom: 20px; border: 1px solid #dddddd">
                                            <div class="single-item">
                                                <div class="single-item-header text-center" >
                                                    <a href="{{url('chi-tiet-sach',$book_search['id'])}}" style="" class="">
                                                        <img src="images/avatar/{{$book_search['image']}}" alt="">
                                                    </a>
                                                </div>
                                                <div class="single-item-body">
                                                    <a href="{{url('/chi-tiet-sach',$book_search['id'])}}" class="single-item-title text-left">
                                                        {{ str_limit($book_search['name'], $limit = 16, $end = '...') }}</a>
                                                    <p class="single-item-price text-right">
                                                        @if($book_search['in_stock']>0)
                                                            @if(isset($book_search['sale']))
                                                                <span class="flash-del">{{number_format($book_search['price'])}} đ</span>
                                                                <span class="flash-sale">{{number_format($book_search['sale'])}} đ</span>
                                                            @else
                                                                <span>{{number_format($book_search['price'])}} đ</span>
                                                            @endif
                                                        @else
                                                            <span style="color: darkred">Đã hết hàng</span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {{$books->appends(\Illuminate\Support\Facades\Request::except('page'))->links()}}
                        </div> <!-- .beta-products-list -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

