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
                            <?php
                            $count=0;
                            foreach($books as $book){
                                if ($book->S_SLTON>0){
                                    $count+=1;
                                }
                            }
                            ?>

                            <h5>Tìm thấy {{$count}} sách gần giống với từ khóa "{{$search}}"</h5>
                            <div class="beta-products-details">
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                @for($i=0;$i<count($books);$i++)
                                    @if($books[$i]->S_SLTON>0)
                                        @php
                                            $temp = new \App\Book();
                                            $book_search = $temp->getBookPromotion($books[$i]->S_MA);
                                        @endphp
                                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                            <div style="margin-bottom: 20px; border: 1px solid #dddddd">
                                                <div class="single-item">
                                                    <div class="single-item-header text-center" >
                                                        <a href="{{url('/detail',$book_search['id'])}}" style="" class="">
                                                            <img src="images/avatar/{{$book_search['image']}}" alt="" height="90%" width="90%">
                                                        </a>
                                                    </div>
                                                    <div class="single-item-body text-center">
                                                        <a href="{{url('/detail',$book_search['id'])}}" class="single-item-title" >
                                                            {{ str_limit($book_search['name'], $limit = 18, $end = '...') }}</a>
                                                        <p class="single-item-price" >
                                                            @if(isset($book_search['sale']))
                                                                <span class="flash-del">{{number_format($book_search['price'])}} đ</span>
                                                                <span class="flash-sale">{{number_format($book_search['sale'])}} đ</span>
                                                            @else
                                                                <span>{{number_format($book_search['price'])}} đ</span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endfor
                            </div>
                        </div> <!-- .beta-products-list -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

