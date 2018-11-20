<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 11/20/2018
 * Time: 10:23 AM
 */?>
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
                        Không có sách nào
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
