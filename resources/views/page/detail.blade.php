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
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="float-left" id="myImg" style="margin-bottom: 10px">
                                <img src="images/{{$images[0]->HA_URL1}}" class="img-rounded zoom" alt="" width="350px" height="300px">
                            </div>
                            @foreach($images as $image)
                                <a id="myImgSmall" class="btn-default">
                                    <img src="images/{{$image->HA_URL1}}" width="70px" height="70px" onclick="clickImg(this)">
                                </a>
                            @endforeach

                        </div>
                        <div class="col-md-8">
                            <div>
                                <h3>{{$book->S_TEN}}</h3>
                                <p style="margin-bottom: 10px; margin-top: 10px;">Tác giả: {{$author[0]->TG_TEN}}</p>
                            </div>
                            <hr>
                            <div>
                                <p style="margin-bottom: 20px;">
                                    <strong style="color: #9f191f; font-size: 18px;">{{number_format($book->S_GIA)}} đ</strong>
                                </p>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-8">
                                    <form class="form-inline ">
                                        <p style="margin-bottom: 10px">Số lượng:</p>
                                        <span class="btn btn-default btn-group"> - </span>
                                        <input type="text" class="btn-group" style="width: 45px" value="1">
                                        <span class="btn btn-default btn-group"> + </span>
                                        <button class="btn btn-primary" style="margin-left: 50px">
                                            <span class="fa fa-shopping-cart" style="font-size: 20px"></span> Thêm vào giỏ hàng</button>
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
                        <table class="table table-striped table-bordered table-hover">
                            <colgroup style="width: 25%; "></colgroup>
                            <tbody>
                            @if(isset($publisher))
                            <tr>
                                <th>Nhà xuất bản</th>
                                <td>{{$publisher->NXB_TEN}}</td>
                            </tr>
                            @endif
                            @if(isset($author[0]))
                            <tr>
                                <th scope="row">Tác giả</th>
                                <td>{{$author[0]->TG_TEN}}</td>
                            </tr>
                            @endif
                            @if(isset($book->S_NGAYXB))
                            <tr>
                                <th>Ngày xuất bản</th>
                                <td>{{$book->S_NGAYXB}}</td>
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
                    <p>{{$book->S_GIOITHIEU}}</p>
                </div>
            </div>
        </div>

        {{--Giới thiệu sách cùng tác giả--}}
        <div class="col-md-9">
            <h5>Sách cùng tác giả</h5>
            <div class="panel panel-default">
                <div class="panel-body"></div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function clickImg(img) {
        var src = img.src;
        var html = "<img src='"+src+"' class='img-rounded zoom' width='350px' height='300px'>";
        document.getElementById('myImg').innerHTML = html;
    }
</script>
