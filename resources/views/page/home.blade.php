<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 08/29/2018
 * Time: 10:07 AM
 */

$sum=0;
$temp_new_book_promotion = array();
foreach ($results as $result){
    if ($sum<4){
        $temp_new_book = new \App\Book();
        $temp_new_book_promotion[$sum] = $temp_new_book->getBookPromotion($result);
        $sum++;
    }else{
        break;
    }
}
//dd($temp_new_book_promotion);
?>
@extends('master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <div class="list-group">
                {{--<a class="list-group-item" style="font-size: medium; text-align: center; background: gray; color: white; border: none">Danh mục sách</a>--}}
                {{--@foreach($categories as $category)
                <a href="{{url('/category',$category->LS_MA)}}" class="list-group-item" style="font-size: 15px; color: black; border: none"
                   onmouseover="tagActive(this)" onmouseout="tagDisable(this)">{{$category->LS_TEN}}</a>
                @endforeach--}}
            </div>
        </div>
        <div class="col-sm-8">
            <div class="">
                {{--<a class="list-group-item" style="border: none">Daily Deals</a>--}}

                <div id="myCarousel" class="carousel slide" data-ride="carousel" style="height: 410px">
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
                            <img src="images/{{$sliders[0]->slider}}" alt="Image" style="width: 800px; height: 410px">
                            <div class="carousel-caption">
                                <h3>Sell $</h3>
                                <p>Money Money.</p>
                            </div>
                        </div>
                        @for($i=1;$i<$total;$i++)
                            <div class="item">
                                <img src="images/{{$sliders[$i]->slider}}" alt="Image" style="width: 800px; height: 410px">
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
                    <div class="beta-products-list">
                        <h4>Sách full</h4>
                        <div class="beta-products-details">
                            <?php
                                $count=0;
                                foreach($books as $book){
                                    if ($book->S_SLTON>0){
                                        $count+=1;
                                    }
                                }
                            ?>
                            <p class="pull-left">Có {{$count}} sách</p>
                            <div class="clearfix"></div>
                        </div>

                        <div class="row">
                            @for($i=0;$i<count($books);$i++)
                                @if($books[$i]->S_SLTON>0)
                                    @php
                                        $new_book = new \App\Book();
                                        $book_promotion = $new_book->getBookPromotion($books[$i]->S_MA);
                                    @endphp
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <div style="margin-bottom: 20px; border: 1px solid #dddddd">
                                            <div class="single-item">
                                                <div class="single-item-header text-center" >
                                                    <a href="{{url('/detail',$book_promotion['id'])}}" style="" class="">
                                                        <img src="images/{{$book_promotion['image']}}" alt="ádasd" height="250px">
                                                    </a>
                                                </div>
                                                <div class="single-item-body text-center">
                                                    <a href="{{url('/detail',$book_promotion['id'])}}" class="single-item-title" >
                                                        {{ str_limit($book_promotion['name'], $limit = 25, $end = '...') }}</a>
                                                    <p class="single-item-price" >
                                                        @if(isset($book_promotion['sale']))
                                                            <span class="flash-del">{{number_format($book_promotion['price'])}} đ</span>
                                                            <span class="flash-sale">{{number_format($book_promotion['sale'])}} đ</span>
                                                        @else
                                                            <span>{{number_format($book_promotion['price'])}} đ</span>
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
                    <div class="clearfix"></div>
                    <div class="space50">&nbsp;</div>

                    <div class="beta-products-list">
                        <h4>Sách mới (dựa vào ngày nhập)</h4>
                        <div class="beta-products-details">
                            {{--<p class="pull-left">Sách mới</p>--}}
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            @for($sum=0;$sum<4;$sum++)
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div style="margin-bottom: 20px; border: 1px solid #dddddd">
                                        <div class="single-item">
                                            <div class="single-item-header text-center">
                                                <a href="{{url('/detail',$temp_new_book_promotion[$sum]['id'])}}" style="" class="">
                                                    <img src="images/{{$temp_new_book_promotion[$sum]['image']}}" alt="" height="250px">
                                                </a>
                                            </div>
                                            <div class="single-item-body text-center">
                                                <a href="{{url('/detail',$temp_new_book_promotion[$sum]['id'])}}" class="single-item-title" >
                                                    {{ str_limit($temp_new_book_promotion[$sum]['name'], $limit = 25, $end = '...') }}</a>
                                                <p class="single-item-price" >
                                                    @if(isset($temp_new_book_promotion[$sum]['sale']))
                                                        <span class="flash-del">{{number_format($temp_new_book_promotion[$sum]['price'])}} đ</span>
                                                        <span class="flash-sale">{{number_format($temp_new_book_promotion[$sum]['sale'])}} đ</span>
                                                    @else
                                                        <span>{{number_format($temp_new_book_promotion[$sum]['price'])}} đ</span>
                                                    @endif
                                                </p>
                                            </div>
                                            {{--<div class="single-item-caption">
                                                 <a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
                                                 <a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
                                                 <div class="clearfix"></div>
                                            </div>--}}
                                        </div>
                                    </div>

                                </div>
                            @endfor
                        </div>
                        <div class="space40">&nbsp;</div>
                    </div> <!-- .beta-products-list -->

                    <div class="space50">&nbsp;</div>

                    <div class="beta-products-list">
                        <h4>Sách nổi bật (dựa vào lượt xem)</h4>
                        <div class="beta-products-details">
                            <?php
                                $views=\App\Book::where('S_SLTON','<>',0)->orderBy('S_LUOTXEM','desc')
                                    ->take(4)->get();
                            ?>
                            {{--<p class="pull-left">Có {{$count}} sách</p>--}}
                            <div class="clearfix"></div>
                        </div>

                        <div class="row">
                            @foreach($views as $view)
                                <?php
                                $temp_view = new \App\Book();
                                $temp_view_book = $temp_view->getBookPromotion($view->S_MA);

                                ?>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div style="margin-bottom: 20px; border: 1px solid #dddddd">
                                        <div class="single-item">
                                            <div class="single-item-header text-center">
                                                <a href="{{url('/detail',$temp_view_book['id'])}}" style="" class="">
                                                    <img src="images/{{$temp_view_book['image']}}" alt="" height="250px">
                                                </a>
                                            </div>
                                            <div class="single-item-body text-center">
                                                <a href="{{url('/detail',$temp_view_book['id'])}}" class="single-item-title">
                                                    {{ str_limit($temp_view_book['name'], $limit = 25, $end = '...') }}</a>
                                                <p class="single-item-price" >
                                                    @if(isset($temp_view_book['sale']))
                                                        <span class="flash-del">{{number_format($temp_view_book['price'])}} đ</span>
                                                        <span class="flash-sale">{{number_format($temp_view_book['sale'])}} đ</span>
                                                    @else
                                                        <span>{{number_format($temp_view_book['price'])}} đ</span>
                                                    @endif
                                                </p>
                                            </div>
                                            {{--<br>
                                            <div class="clearfix"></div>
                                            <div class="single-item-caption text-center">
                                                @if($book->S_SLTON>0)
                                                <a class="btn btn-primary" href="" style="width: 180px"><span class="fa fa-shopping-cart"></span> Thêm vào giỏ hàng</a>
                                                <a class="beta-btn primary" href="">Details <i class="fa fa-chevron-right"></i></a>
                                                    @else
                                                    <a class="btn btn-success" href="" style="width: 180px"><span class=""></span> Đã hết hàng</a>
                                                @endif
                                            </div>
                                            <br>--}}
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="space50">&nbsp;</div>

                    <div class="beta-products-list">
                        <h4>Sách bán chạy (dựa vào hóa đơn)</h4>
                        <div class="beta-products-details">
                            {{--<p class="pull-left">Có {{$count}} sách</p>--}}
                            <div class="clearfix"></div>
                        </div>

                        <div class="row">
                            @foreach($invoices as $invoice)
                                <?php
                                $in_stock = \App\Book::where('S_MA', $invoice->S_MA)->first();
                                $temp_invoice = new \App\Book();
                                $temp_invoice_book = $temp_invoice->getBookPromotion($invoice->S_MA);
                                ?>
                                @if($in_stock->S_SLTON>0)
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <div style="margin-bottom: 20px; border: 1px solid #dddddd">
                                            <div class="single-item">
                                                <div class="single-item-header text-center">
                                                    <a href="{{url('/detail',$temp_invoice_book['id'])}}" style="" class="">
                                                        <img src="images/{{$temp_invoice_book['image']}}" alt="" height="250px">
                                                    </a>
                                                </div>
                                                <div class="single-item-body text-center">
                                                    <a href="{{url('/detail',$temp_invoice_book['id'])}}" class="single-item-title" >
                                                        {{ str_limit($temp_invoice_book['name'], $limit = 25, $end = '...') }}</a>
                                                    <p class="single-item-price" >
                                                        @if(isset($temp_invoice_book['sale']))
                                                            <span class="flash-del">{{number_format($temp_invoice_book['price'])}} đ</span>
                                                            <span class="flash-sale">{{number_format($temp_invoice_book['sale'])}} đ</span>
                                                        @else
                                                            <span>{{number_format($temp_invoice_book['price'])}} đ</span>
                                                        @endif
                                                    </p>
                                                </div>

                                                <div class="clearfix"></div>
                                                {{--<div class="single-item-caption text-center">
                                                    @if($book->S_SLTON>0)
                                                    <a class="btn btn-primary" href="" style="width: 180px"><span class="fa fa-shopping-cart"></span> Thêm vào giỏ hàng</a>
                                                    <a class="beta-btn primary" href="">Details <i class="fa fa-chevron-right"></i></a>
                                                        @else
                                                        <a class="btn btn-success" href="" style="width: 180px"><span class=""></span> Đã hết hàng</a>
                                                    @endif
                                                </div>--}}

                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div> <!-- .beta-products-list -->

                    <div class="space50">&nbsp;</div>
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

