<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 08/29/2018
 * Time: 10:07 AM
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

$sum=0;
for($j=0;$j<count($book_item);$j++){
    //Số phần tử $book_item của $invoiceIns
    for ($i=0;$i<count($book_item[$j]);$i++){
        //Từng phần từ trong 1 phần tử $book_item
        if ($sum<4){
            $temp = \App\Book::where('S_MA', $book_item[$j][$i]->S_MA)->first();
            $image_new=$temp->image()->first();
            if (isset($image_new)){
                $image_temp = $image_new->HA_URL;
            }else{
                $image_temp = 'sorry-image-not-available.jpg';
            }

            $promotion_new=$temp->promotion()->first();
            if (isset($promotion_new)){
                $start=strtotime($promotion_new->KM_APDUNG);
                $end=strtotime($promotion_new->KM_HANDUNG);
                if (($start<=$date)and($end>=$date)){
                    $sales_new=($book_item[$j][$i]->S_GIA)-($book_item[$j][$i]->S_GIA)*($promotion_new->KM_GIAM);
                    //Có khuyến mãi và đang trong thời gian có hiệu lực
                }else{
                    $sales_new=$book_item[$j][$i]->S_GIA;
                    //Có khuyến mãi nhưng chưa tới thời gian
                }
            }else{
                $sales_new=$book_item[$j][$i]->S_GIA; //Không có khuyến mãi
            }
            $data_new[$sum]= [
                'id'=>$temp->S_MA,
                'name'=>$temp->S_TEN,
                'price'=>$temp->S_GIA,
                'sale'=>$sales_new,
                'image'=>$image_temp,
            ];
            $sum+=1;
        }
        else{
            //Chỉ lấy 4 phần tử sách/tất cả $book_item
            break;
        }
    }
}

/*foreach ($books as $book){
    $id=\App\InvoiceDetails::where('S_MA',$book->S_MA)->count()->groupBy('S_MA')
        ->orderBy('HDCT_SOLUONG','desc')->take(4)->get();

}*/
?>
@extends('master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <div class="list-group">
                {{--<a class="list-group-item" style="font-size: medium; text-align: center; background: gray; color: white; border: none">Danh mục sách</a>--}}
                @foreach($categories as $category)
                <a href="{{url('/category',$category->LS_MA)}}" class="list-group-item" style="font-size: 15px; color: black; border: none"
                   onmouseover="tagActive(this)" onmouseout="tagDisable(this)">{{$category->LS_TEN}}</a>
                @endforeach
            </div>
        </div>
        <div class="col-sm-8">
            <div class="list-group">
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
                                    <div class="col-sm-3">
                                        <div class="single-item">
                                            <div class="single-item-header">
                                                @if(isset($images[$i]))
                                                    <a href="{{url('/detail',$books[$i]->S_MA)}}" style="" class="text-center">
                                                        <img src="images/{{$images[$i]->HA_URL}}" alt="" height="270px">
                                                    </a>
                                                @else
                                                    <a href="{{url('/detail',$books[$i]->S_MA)}}">
                                                        <img src="images/sorry-image-not-available.jpg" alt="" height="270px">
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

                    <div class="space50">&nbsp;</div>

                    <div class="beta-products-list">
                        <h4>Sách mới</h4>
                        <div class="beta-products-details">
                            {{--<p class="pull-left">Sách mới</p>--}}
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            @for($sum=0;$sum<4;$sum++)
                                <div class="col-sm-3">
                                    <div class="single-item">
                                        <div class="single-item-header">
                                            <a href="{{url('/detail',$data_new[$sum]['id'])}}" style="" class="text-center">
                                                <img src="images/{{$data_new[$sum]['image']}}" alt="" height="270px">
                                            </a>
                                        </div>
                                        <div class="single-item-body text-center">
                                            <a href="{{url('/detail',$data_new[$sum]['id'])}}" class="single-item-title" style="font-size: 16px">{{$data_new[$sum]['name']}}</a>
                                            <p class="single-item-price" style="font-size: 15px">
                                                @if($data_new[$sum]['price']<$data_new[$sum]['sale'])
                                                    <span class="flash-del">{{number_format($data_new[$sum]['price'])}} đ</span>
                                                    <span class="flash-sale">{{number_format($data_new[$sum]['sale'])}} đ</span>
                                                @else
                                                    <span>{{number_format($data_new[$sum]['sale'])}} đ</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="single-item-caption">
                                           {{-- <a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
                                            <a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
                                            <div class="clearfix"></div>--}}
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                        <div class="space40">&nbsp;</div>
                    </div> <!-- .beta-products-list -->

                    <div class="space50">&nbsp;</div>

                    <div class="beta-products-list">
                        <h4>Sách nổi bật</h4>
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
                                $view_temp=\App\Book::where('S_MA',$view->S_MA)->first();
                                $image_view=$view_temp->image()->first();
                                $promotions_view = $view_temp->promotion()->first();
                                if (isset($promotions_view)){
                                    $start=strtotime($promotions_view->KM_APDUNG);
                                    $end=strtotime($promotions_view->KM_HANDUNG);
                                    if (($start<=$date)and($end>=$date)){
                                        $sales_view=($view->S_GIA)-($view->S_GIA)*($promotions_view->KM_GIAM);
                                        //Có khuyến mãi và đang trong thời gian có hiệu lực
                                    }else{
                                        $sales_view=$view->S_GIA;
                                        //Có khuyến mãi nhưng chưa tới thời gian
                                    }
                                }else{
                                    $sales_view=$view->S_GIA; //Không có khuyến mãi
                                }
                                ?>
                                <div class="col-sm-3">
                                    <div class="single-item">
                                        <div class="single-item-header">
                                            @if(isset($image_view))
                                                <a href="{{url('/detail',$view->S_MA)}}" style="" class="text-center">
                                                    <img src="images/{{$image_view->HA_URL}}" alt="" height="270px">
                                                </a>
                                            @else
                                                <a href="{{url('/detail',$view->S_MA)}}">
                                                    <img src="images/sorry-image-not-available.jpg" alt="" height="270px">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="single-item-body text-center">
                                            <a href="{{url('/detail',$view->S_MA)}}" class="single-item-title" style="font-size: 16px">
                                                {{$view->S_TEN}}</a>
                                            <p class="single-item-price" style="font-size: 15px">
                                                @if($sales_view < $view->S_GIA)
                                                    <span class="flash-del">{{number_format($view->S_GIA)}} đ</span>
                                                    <span class="flash-sale">{{number_format($sales_view)}} đ</span>
                                                @else
                                                    <span>{{number_format($sales_view)}} đ</span>
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
                            @endforeach
                        </div>
                    </div>

                    <div class="space50">&nbsp;</div>
                </div>
            </div> <!-- end section with sidebar and main content -->


        </div> <!-- .main-content -->
    </div> <!-- #content -->

</div> <!-- .container -->
@endsection

