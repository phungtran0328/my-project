<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 08/29/2018
 * Time: 10:07 AM
 */

/*$sum=0;
$temp_new_book_promotion = array();
foreach ($results as $result){
    if ($sum<6){
        $temp_new_book = new \App\Book();
        $temp_new_book_promotion[$sum] = $temp_new_book->getBookPromotion($result);
        $sum++;
    }else{
        break;
    }
}*/
//dd($temp_new_book_promotion);
?>
@extends('master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <div class="list-group">
            </div>
        </div>
        <div class="col-sm-8">
            <div class="">
                <div id="myCarousel" class="carousel slide" data-ride="carousel" >
                    <!-- Indicators -->
                    <?php $total=count($sliders); ?>
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        @for($i=1; $i<$total;$i++)
                            <li data-target="#myCarousel" data-slide-to="{{$i}}"></li>
                        @endfor
                    </ol>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="images/slider/{{$sliders[0]->slider}}" alt="Image">
                            <div class="carousel-caption">
                                <h3>Sell $</h3>
                                <p>Money Money.</p>
                            </div>
                        </div>
                        @for($i=1;$i<$total;$i++)
                            <div class="item">
                                <img src="images/slider/{{$sliders[$i]->slider}}" alt="Image">
                                <div class="carousel-caption">
                                    <h3>More Sell $</h3>
                                    <p>Lorem ipsum...</p>
                                </div>
                            </div>
                        @endfor
                    </div>
                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <hr>
</div>

<div class="container text-left">
    <div id="content" class="space-top-none">
        <div class="main-content">
            {{--<div class="space60">&nbsp;</div>--}}
            <div class="row">
                <div class="col-sm-12">
                    {{--<div class="beta-products-list">
                        --}}{{--dựa vào ngày nhập--}}{{--
                        <h4>Sách mới</h4>
                        <div class="beta-products-details">
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            @for($sum=0;$sum<6;$sum++)
                                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                    <div style="margin-bottom: 20px; border: 1px solid #dddddd">
                                        <div class="single-item">
                                            <div class="single-item-header text-center">
                                                <a href="{{url('/chi-tiet-sach',$temp_new_book_promotion[$sum]['id'])}}" style="" class="">
                                                    <img src="images/avatar/{{$temp_new_book_promotion[$sum]['image']}}" alt="" >
                                                </a>
                                            </div>
                                            <div class="single-item-body">
                                                <a href="{{url('/chi-tiet-sach',$temp_new_book_promotion[$sum]['id'])}}" class="single-item-title  text-left" >
                                                    {{ str_limit($temp_new_book_promotion[$sum]['name'], $limit = 16, $end = '...') }}</a>
                                                <p class="single-item-price text-right">
                                                    @if($temp_new_book_promotion[$sum]['in_stock']>0)
                                                        @if(isset($temp_new_book_promotion[$sum]['sale']))
                                                            <span class="flash-del">{{number_format($temp_new_book_promotion[$sum]['price'])}} đ</span>
                                                            <span class="flash-sale">{{number_format($temp_new_book_promotion[$sum]['sale'])}} đ</span>
                                                        @else
                                                            <span>{{number_format($temp_new_book_promotion[$sum]['price'])}} đ</span>
                                                        @endif
                                                    @else
                                                        <span style="color: darkred">Đã hết hàng</span>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endfor
                        </div>
                    </div>--}} <!-- .beta-products-list -->
                    <div class="beta-products-list">
                        {{--dựa vào ngày nhập--}}
                        <h4>Sách mới</h4>
                        <div class="beta-products-details">
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            @foreach($news as $new)
                                @php
                                    $temp = new \App\Book();
                                    $new_promotion = $temp->getBookPromotion($new);
                                @endphp
                                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                    <div style="margin-bottom: 20px; border: 1px solid #dddddd">
                                        <div class="single-item">
                                            <div class="single-item-header text-center">
                                                <a href="{{url('/chi-tiet-sach',$new_promotion['id'])}}" style="" class="">
                                                    <img src="images/avatar/{{$new_promotion['image']}}" alt="" >
                                                </a>
                                            </div>
                                            <div class="single-item-body">
                                                <a href="{{url('/chi-tiet-sach',$new_promotion['id'])}}" class="single-item-title text-left" >
                                                    {{ str_limit($new_promotion['name'], $limit = 16, $end = '...') }}</a>
                                                <p class="single-item-price text-right">
                                                    @if($new_promotion['in_stock']>0)
                                                        @if(isset($new_promotion['sale']))
                                                            <span class="flash-del">{{number_format($new_promotion['price'])}} đ</span>
                                                            <span class="flash-sale">{{number_format($new_promotion['sale'])}} đ</span>
                                                        @else
                                                            <span>{{number_format($new_promotion['price'])}} đ</span>
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
                    </div> <!-- .beta-products-list -->
                    <div class="beta-products-list">
                        {{--dựa vào lượt xem--}}
                        <h4>Sách nổi bật</h4>
                        <div class="beta-products-details">
                            <?php
/*                                $views=\App\Book::where('S_SLTON','<>',0)->orderBy('S_LUOTXEM','desc')
                                    ->take(6)->get();
                            */?>
                            {{--<p class="pull-left">Có {{$count}} sách</p>--}}
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            @foreach($views as $view)
                                <?php
                                $temp_view = new \App\Book();
                                $temp_view_book = $temp_view->getBookPromotion($view);

                                ?>
                                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                    <div style="margin-bottom: 20px; border: 1px solid #dddddd">
                                        <div class="single-item">
                                            <div class="single-item-header text-center">
                                                <a href="{{url('/chi-tiet-sach',$temp_view_book['id'])}}" style="" class="">
                                                    <img src="images/avatar/{{$temp_view_book['image']}}" alt="">
                                                </a>
                                            </div>
                                            <div class="single-item-body">
                                                <a href="{{url('/chi-tiet-sach',$temp_view_book['id'])}}" class="single-item-title  text-left">
                                                    {{ str_limit($temp_view_book['name'], $limit = 16, $end = '...') }}</a>
                                                <p class="single-item-price text-right" >
                                                    @if($temp_view_book['in_stock']>0)
                                                        @if(isset($temp_view_book['sale']))
                                                            <span class="flash-del">{{number_format($temp_view_book['price'])}} đ</span>
                                                            <span class="flash-sale">{{number_format($temp_view_book['sale'])}} đ</span>
                                                        @else
                                                            <span>{{number_format($temp_view_book['price'])}} đ</span>
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
                    </div>
                    <div class="beta-products-list">
                        {{--dựa vào hóa đơn--}}
                        <h4>Sách bán chạy</h4>
                        <div class="beta-products-details">
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            @foreach($invoices as $invoice)
                                <?php
                                $temp_invoice = new \App\Book();
                                $temp_invoice_book = $temp_invoice->getBookPromotion($invoice->S_MA);
                                ?>
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                        <div style="margin-bottom: 20px; border: 1px solid #dddddd">
                                            <div class="single-item">
                                                <div class="single-item-header text-center">
                                                    <a href="{{url('/chi-tiet-sach',$temp_invoice_book['id'])}}" style="" class="">
                                                        <img src="images/avatar/{{$temp_invoice_book['image']}}" alt="">
                                                    </a>
                                                </div>
                                                <div class="single-item-body">
                                                    <a href="{{url('/chi-tiet-sach',$temp_invoice_book['id'])}}" class="single-item-title text-left" >
                                                        {{ str_limit($temp_invoice_book['name'], $limit = 16, $end = '...') }}</a>
                                                    <p class="single-item-price text-right" >
                                                        @if($temp_invoice_book['in_stock']>0)
                                                            @if(isset($temp_invoice_book['sale']))
                                                                <span class="flash-del">{{number_format($temp_invoice_book['price'])}} đ</span>
                                                                <span class="flash-sale">{{number_format($temp_invoice_book['sale'])}} đ</span>
                                                            @else
                                                                <span>{{number_format($temp_invoice_book['price'])}} đ</span>
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
                    </div> <!-- .beta-products-list -->
                </div>
            </div> <!-- end section with sidebar and main content -->
        </div> <!-- .main-content -->
    </div> <!-- #content -->

</div> <!-- .container -->
    <script>
        window.onload = function () {
            var x = window.location.href;
            if (x=='http://localhost:8000/bookstore/public/index'){
                document.getElementById('menuDrop').style.display='block';
            }
            console.log(window.location.href);
        }
    </script>
@endsection

