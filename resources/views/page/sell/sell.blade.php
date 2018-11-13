<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 11/09/2018
 * Time: 10:15 AM
 */
?>
@extends('master')
@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/index')}}">Trang chủ</a></li>
            <li class="active">Sách bán chạy</li>
        </ul>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive ">
                    <table class="table table-hover">
                        <tbody>
                        @php $i = 1; @endphp

                        @foreach($dataSum as $item)
                            @if($i<11)
                                @php
                                    $temp = new \App\Book();
                                    $book = $temp->getBookPromotion($item['id']);
                                @endphp
                            <tr>
                                <td style="font-size: large; width: 10%" class="text-center"> #{{$i}}</td>
                                <td style="width: 30%" class="text-center">
                                    <a href="{{url('/detail',$book['id'])}}">
                                        <img src="images/avatar/{{$book['image']}}" width="110px" height="150px">
                                    </a>
                                </td>
                                <td class="">
                                    <a href="{{url('/detail',$book['id'])}}" style="font-size: medium; color: #0a263c">{{$book['name']}}</a> <br><br>
                                    @if(isset($book['sale']))
                                        <strong>Giá: </strong><strong style="color: darkblue; margin-left: 20px; font-size: 14px;" class="flash-del">
                                            {{number_format($book['price'])}} đ</strong><br><br>
                                        <strong>Giảm còn: </strong><strong class="flash-sale" style="margin-left: 20px">
                                            {{number_format($book['sale'])}} đ</strong>
                                        @else
                                        <strong>Giá :</strong><strong style="color: darkblue; margin-left: 20px; font-size: 14px">
                                            {{number_format($book['price'])}} đ</strong><br>
                                    @endif
                                </td>
                                <td></td>
                            </tr>
                                @else @break;
                            @endif
                            @php $i++; @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
