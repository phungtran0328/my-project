<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 09/15/2018
 * Time: 1:22 PM
 */


?>
{{--<style>
    /*.zoom {*/
        /*-webkit-transition: all 0.35s ease-in-out;*/
        /*-moz-transition: all 0.35s ease-in-out;*/
        /*transition: all 0.35s ease-in-out;*/
        /*cursor: -webkit-zoom-in;*/
        /*cursor: -moz-zoom-in;*/
        /*cursor: zoom-in;*/
    /*}*/

    /*.zoom:hover,*/
    /*.zoom:active,*/
    /*.zoom:focus {*/
        /*!**adjust scale to desired size,*/
        /*add browser prefixes**!*/
        /*-ms-transform: scale(2.5);*/
        /*-moz-transform: scale(2.5);*/
        /*-webkit-transform: scale(2.5);*/
        /*-o-transform: scale(2.5);*/
        /*transform: scale(2.5);*/
        /*position:relative;*/
        /*z-index:100;*/
    /*}*/
</style>--}}
@extends('master')
@section('content')
<div class="container">
    <ul class="breadcrumb">
        <li><a href="{{url('/index')}}">Trang chủ</a></li>
        <li><a href="{{url('/category',$kind_of_book->LS_MA)}}">{{$kind_of_book->LS_TEN}}</a></li>
        <li class="active">{{$book->S_TEN}}</li>
    </ul>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(Session::has('messAdd'))
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{Session::get('messAdd')}}
                </div>
            @endif
                @if(Session::has('message'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{Session::get('message')}}
                    </div>
                @endif

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if(!empty($images[0]))
                                <div class="float-left" id="myImg" style="margin-bottom: 10px">
                                    <img src="images/{{$images[0]->HA_URL}}" class="img-rounded zoom" alt="" width="350px" height="350px">
                                </div>
                                @foreach($images as $image)
                                    <a id="myImgSmall" class="btn-default">
                                        <img src="images/{{$image->HA_URL}}" width="70px" height="70px" onclick="clickImg(this)">
                                    </a>
                                @endforeach
                            @else
                                <div class="float-left" id="myImg" style="margin-bottom: 10px">
                                    <img src="images/sorry-image-not-available.jpg" class="img-rounded zoom" alt="" width="350px" height="300px">
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div>
                                <h3>{{$book->S_TEN}}</h3>
                                @if(isset($authors) or isset($translators))
                                    <p style="margin-bottom: 10px; margin-top: 10px;">Tác giả:
                                        @foreach($authors as $author)
                                            {{$author->TG_TEN}} <br>
                                        @endforeach
                                        @foreach($translators as $translator)
                                            {{$translator->TG_TEN}} <br>
                                        @endforeach
                                    </p>
                                @else
                                    <p style="margin-bottom: 10px; margin-top: 10px;">Chưa cập nhật tác giả</p>
                                @endif
                            </div>
                            <hr>
                            <div>
                                <div style="margin-bottom: 20px;">
                                    @if(isset($temps['sale']))
                                        <span class="flash-del" style="font-size: 18px">{{number_format($temps['price'])}} đ</span>
                                        <span class="flash-sale" style="font-size: 18px">{{number_format($temps['sale'])}} đ</span>
                                    @else
                                        <span style="color: #9f191f; font-size: 18px;">{{number_format($temps['price'])}} đ</span>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-8">
                                    <form class="form-inline " action="{{url('/cart')}}" method="post">
                                        <p style="margin-bottom: 10px">Số lượng:</p>
                                        @if($book->S_SLTON>0)
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input type="hidden" name="id" value="{{ $book->S_MA }}">
                                            <input type="hidden" name="name" value="{{ $book->S_TEN}}">
                                            @if(isset($temps['sale']))
                                                <input value="{{$temps['sale']}}" type="hidden" name="price">
                                            @else
                                                <input value="{{$temps['price']}}" type="hidden" name="price">
                                            @endif
                                            <input type="number" min="1" class="form-control" style="width: 70px" value="1" name="qty">
                                            <button class="btn btn-primary" style="margin-left: 50px">
                                                <span class="fa fa-shopping-cart" style="font-size: 20px"></span> Thêm vào giỏ hàng</button>
                                        @else
                                            <button class="btn btn-default btn-group" style="width: 40px" disabled>
                                                <span> - </span>
                                            </button>
                                            <input type="text" class="btn-group" style="width: 45px" value="0" disabled>
                                            <button class="btn btn-default btn-group" style="width: 40px" disabled>
                                                <span> + </span>
                                            </button>
                                            <button class="btn btn-success" style="margin-left: 50px" disabled>
                                                <span class="" style="font-size: 20px"></span> Đã hết hàng</button>
                                        @endif
                                    </form>
                                </div>
                                <div class="col-md-4">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--Thông tin chi tiết sách--}}
        <div class="col-md-9">
            <h5>Thông tin chi tiết</h5>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive ">
                        <table class="table table-bordered table-hover">
                            <colgroup style="width: 25%; "></colgroup>
                            <tbody>
                            @if(isset($company))
                                <tr>
                                    <th>Công ty phát hành</th>
                                    <td>{{$company->CTPH_TEN}}</td>
                                </tr>
                            @endif
                            @if(isset($publisher))
                            <tr>
                                <th>Nhà xuất bản</th>
                                <td>{{$publisher->NXB_TEN}}</td>
                            </tr>
                            @endif
                            @if(isset($authors) or isset($translators))
                            <tr>
                                <th>Tác giả</th>
                                <td>
                                    @foreach($authors as $author)
                                        {{$author->TG_TEN}} <br>
                                    @endforeach
                                    @foreach($translators as $translator)
                                        {{$translator->TG_TEN}} <br>
                                    @endforeach
                                </td>
                            </tr>
                            @if(isset($translators[0]->pivot->DICHGIA))
                                <tr>
                                    <th>Người dịch</th>
                                    <td>{{$translators[0]->pivot->DICHGIA}}</td>
                                </tr>
                            @endif
                            @endif
                            @if(isset($book->S_NGAYXB))
                            <tr>
                                <th>Ngày xuất bản</th>
                                <td><?php $date=date_create($book->S_NGAYXB); ?>
                                    {{date_format($date,"m/Y") }}</td>
                            </tr>
                            @endif
                            @if(isset($cover_type))
                            <tr>
                                <th>Loại bìa</th>
                                <td>{{$cover_type->LB_TEN}}</td>
                            </tr>
                            @endif
                            @if(isset($book->S_KICHTHUOC))
                            <tr>
                                <th>Kích thước</th>
                                <td>{{$book->S_KICHTHUOC}}</td>
                            </tr>
                            @endif
                            @if(isset($book->S_SOTRANG))
                            <tr>
                                <th>Số trang</th>
                                <td>{{$book->S_SOTRANG}}</td>
                            </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{--Giới thiệu sách--}}
        <div class="col-md-9">
            <h5>Giới thiệu sách</h5>
            <div class="panel panel-default">
                <div class="panel-body">
                    <p style="margin-bottom: 10px"><b>{{$book->S_TEN}}</b></p>
                    <textarea style="text-align: justify; border:none">{{$book->S_GIOITHIEU}}</textarea>
                </div>
            </div>
        </div>

        {{--Giới thiệu sách cùng tác giả--}}
        <div class="col-md-12">
            <h5>Sách cùng tác giả</h5>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        @if(isset($authors))
                            @foreach($authors as $author)
                                <?php
                                $temps=App\Author::where('TG_MA',$author->TG_MA)->first();
                                //Lấy tập hợp book có cùng tác giả
                                $temp_author=$temps->book()->get();
                                $temp_author_book_promotion = array();
                                $i = 0;
                                foreach ($temp_author as $item){
                                    //Lấy mảng book với điều kiện book khác book đang xem chi tiết
                                    if ($item->S_MA <> $book->S_MA){
                                        $temp_author_book = new \App\Book();
                                        $temp_author_book_promotion[$i] = $temp_author_book->getBookPromotion($item->S_MA);
                                        $i++;
                                    }
                                }
                                ?>
                                @for($j=0; $j<count($temp_author_book_promotion); $j++)
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                        <div style="margin-bottom: 20px; border: 1px solid #dddddd">
                                            <a href="{{url('/detail',$temp_author_book_promotion[$j]['id'])}}">
                                                <div class="">
                                                    <div class=" text-center">
                                                        <img class=""  src="images/{{$temp_author_book_promotion[$j]['image']}}" width="120px" height="130px"><br>
                                                        <p style="font-size: 14px; margin-bottom: 5px; margin-top: 5px">
                                                            {{ str_limit($temp_author_book_promotion[$j]['name'], $limit = 20, $end = '...') }}</p>
                                                        <p style="font-size: 14px; margin-bottom: 5px">
                                                            @if(isset($temp_author_book_promotion[$j]['sale']))
                                                                <span class="flash-del">{{number_format($temp_author_book_promotion[$j]['price'])}} đ</span>
                                                                <span class="flash-sale">{{number_format($temp_author_book_promotion[$j]['sale'])}} đ</span>
                                                            @else
                                                                <span>{{number_format($temp_author_book_promotion[$j]['price'])}} đ</span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endfor
                            @endforeach
                        @endif
                        @if(isset($translators[0]->pivot->DICHGIA))
                            @foreach($translators as $translator)
                                    <?php
                                    $temps=App\Author::where('TG_MA',$translator->TG_MA)->first();
                                    //Lấy tập hợp book có cùng tác giả
                                    $temp_translator = $temps->translate_book()->get();
                                    $temp_translator_book_promotion = array();
                                    $i = 0;
                                    foreach ($temp_translator as $item){
                                        //Lấy mảng book với điều kiện book khác book đang xem chi tiết
                                        if ($item->S_MA <> $book->S_MA){
                                            $temp_translator_book = new \App\Book();
                                            $temp_translator_book_promotion[$i] = $temp_translator_book->getBookPromotion($item->S_MA);
                                            $i++;
                                        }
                                    }
                                    ?>
                                    @for($j=0; $j<count($temp_translator_book_promotion); $j++)
                                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                            <div style="margin-bottom: 20px; border: 1px solid #dddddd">
                                                <a href="{{url('/detail',$temp_translator_book_promotion[$j]['id'])}}">
                                                    <div class="">
                                                        <div class=" text-center">
                                                            <img class=""  src="images/{{$temp_translator_book_promotion[$j]['image']}}" width="120px" height="130px"><br>
                                                            <p style="font-size: 14px; margin-bottom: 5px; margin-top: 5px">
                                                                {{ str_limit($temp_translator_book_promotion[$j]['name'], $limit = 20, $end = '...') }}</p>
                                                            <p style="font-size: 14px; margin-bottom: 5px">
                                                                @if(isset($temp_translator_book_promotion[$j]['sale']))
                                                                    <span class="flash-del">{{number_format($temp_translator_book_promotion[$j]['price'])}} đ</span>
                                                                    <span class="flash-sale">{{number_format($temp_translator_book_promotion[$j]['sale'])}} đ</span>
                                                                @else
                                                                    <span>{{number_format($temp_translator_book_promotion[$j]['price'])}} đ</span>
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endfor
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function clickImg(img) {
        var src = img.src;
        var html = "<img src='"+src+"' class='img-rounded zoom' width='350px' height='350px'>";
        document.getElementById('myImg').innerHTML = html;
    }
</script>
