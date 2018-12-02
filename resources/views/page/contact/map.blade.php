<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 12/02/2018
 * Time: 11:19 AM
 */?>
@extends('master')
@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/index')}}">Trang chủ</a></li>
            <li class="active">Bản đồ</li>
        </ul>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1964.42966067623!2d105.7795290278709!3d10.028465653310052!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a088213c21d881%3A0xd1eebccba5997de1!2zTmjDoCBzw6FjaCBGQUhBU0EgQ-G6p24gVGjGoQ!5e0!3m2!1svi!2s!4v1543724333116"
                        width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
    <br>
@endsection