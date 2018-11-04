<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 11/04/2018
 * Time: 9:42 AM
 */
$images=array();
$promotions=array();
$sales=array();
$date=strtotime(date('Y-m-d')); //Lấy thời gian hiện tại=>giây

for($i=0;$i<count($books);$i++){
    $temp = \App\Book::where('S_MA', $books[$i]->S_MA)->first();
    $images[$i] = $temp->image()->first();
    $promotions[$i] = $temp->promotion()->first();
    if (isset($promotions[$i])){
        $start=strtotime($promotions[$i]->KM_APDUNG);
        $end=strtotime($promotions[$i]->KM_HANDUNG);
        if (($start<=$date)and($end>=$date)){
            $sales[$i]=($books[$i]->S_GIA)-($books[$i]->S_GIA)*($promotions[$i]->KM_GIAM);
            //Có khuyến mãi và đang trong thời gian có hiệu lực
        }else{
            $sales[$i]=$books[$i]->S_GIA;
            //Có khuyến mãi nhưng chưa tới thời gian
        }
    }else{
        $sales[$i]=$books[$i]->S_GIA; //Không có khuyến mãi
    }
}
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

                            <h5>Tìm thấy {{$count}} sách</h5>
                            <div class="beta-products-details">
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                @for($i=0;$i<count($books);$i++)
                                    @if($books[$i]->S_SLTON>0)
                                        <div class="col-lg-2">
                                            <div class="single-item">
                                                <div class="single-item-header">
                                                    @if(isset($images[$i]))
                                                        <a href="{{url('/detail',$books[$i]->S_MA)}}" style="" class="text-center">
                                                            <img src="images/{{$images[$i]->HA_URL}}" alt="">
                                                        </a>
                                                    @else
                                                        <a href="{{url('/detail',$books[$i]->S_MA)}}">
                                                            <img src="images/sorry-image-not-available.jpg" alt="">
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="single-item-body text-center">
                                                    <a href="{{url('/detail',$books[$i]->S_MA)}}" class="single-item-title" style="font-size: 16px">{{$books[$i]->S_TEN}}</a>
                                                    <p class="single-item-price" style="font-size: 15px">
                                                        @if($sales[$i]<$books[$i]->S_GIA)
                                                            <span class="flash-del">{{number_format($books[$i]->S_GIA)}} đ</span>
                                                            <span class="flash-sale">{{number_format($sales[$i])}} đ</span>
                                                        @else
                                                            <span>{{number_format($sales[$i])}} đ</span>
                                                        @endif
                                                    </p>
                                                </div>
                                                <br>
                                                <div class="clearfix"></div>
                                                <div class="single-item-caption text-center">
                                                    {{--@if($book->S_SLTON>0)
                                                    <a class="btn btn-primary" href="" style="width: 180px"><span class="fa fa-shopping-cart"></span> Thêm vào giỏ hàng</a>
                                                    --}}{{--<a class="beta-btn primary" href="">Details <i class="fa fa-chevron-right"></i></a>--}}{{--
                                                        @else
                                                        <a class="btn btn-success" href="" style="width: 180px"><span class=""></span> Đã hết hàng</a>
                                                    @endif--}}
                                                </div>
                                                <br>
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

