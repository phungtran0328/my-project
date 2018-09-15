<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 09/15/2018
 * Time: 1:22 PM
 */?>
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
                            <img src="images/{{$images[0]->HA_URL1}}" class="float-left" alt="" width="350px" height="300px">

                            @foreach($images as $image)
                                <img src="images/{{$image->HA_URL1}}" width="70px" height="70px">
                            @endforeach

                        </div>
                        <div class="col-md-8">
                            <h3>{{$book->S_TEN}}</h3>
                            <p>Tác giả: {{$author[0]->TG_TEN}}</p>
                            <p>Nhà xuất bản: {{$publisher->NXB_TEN}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <h5>Thông tin chi tiết</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

