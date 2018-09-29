<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 09/29/2018
 * Time: 8:40 AM
 */?>
@extends('admin/master')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sách</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Xem chi tiết sách</h5>
                    </div>
                    <div class="panel-body">
                        <a class="btn btn-success btn-block" style="width: 150px" href="{{url('/admin/book')}}">
                            <span class="glyphicon glyphicon-arrow-left"></span>
                        </a>
                        <br>
                        <div class="table-responsive ">
                            <table class="table table-striped table-bordered table-hover">
                                <colgroup style="width: 20%;"></colgroup>
                                <tbody>
                                <tr>
                                    <th>Tên</th>
                                    <td>{{$book->S_TEN}}</td>
                                </tr>
                                <tr>
                                    <th>Tác giả</th>
                                    @if(isset($authors) or isset($translators))
                                        <td>
                                            @foreach($authors as $author)
                                                {{$author->TG_TEN}} <br><br>
                                            @endforeach
                                            @foreach($translators as $translator)
                                                {{$translator->TG_TEN}} <br><br>
                                                {{$translator->pivot->DICHGIA}} (Người dịch)
                                            @endforeach
                                        </td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>SL Tồn</th>
                                    <td>{{$book->S_SLTON}}</td>
                                </tr>
                                <tr>
                                    <th>Kích thước</th>
                                    <td>{{$book->S_KICHTHUOC}}</td>
                                </tr>
                                <tr>
                                    <th>Số trang</th>
                                    <td>{{$book->S_SOTRANG}}</td>
                                </tr>
                                <tr>
                                    <th>Ngày XB</th>
                                    <td>{{$book->S_NGAYXB }}</td>
                                </tr>
                                <tr>
                                    <th>Tái bản</th>
                                    <td>{{$book->S_TAIBAN}}</td>
                                </tr>
                                <tr>
                                    <th>View</th>
                                    <td>{{$book->S_LUOTXEM}}</td>
                                </tr>
                                <tr>
                                    <th>Giới thiệu</th>
                                    <td style="text-align: justify">{{$book->S_GIOITHIEU}}</td>
                                </tr>
                                <tr>
                                    <th>Giá</th>
                                    <td>{{$book->S_GIA}}</td>
                                </tr>
                                <tr>
                                    <th>Khuyến mãi</th>
                                    @if(isset($promotion))
                                        <td>{{$promotion->KM_GIAM}}</td>
                                    @else
                                        <td></td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>Nhà xuất bản</th>
                                    <td>{{$publisher->NXB_TEN}}</td>
                                </tr>
                                <tr>
                                    <th>Loại bìa</th>
                                    <td>{{$cover_type->LB_TEN}}</td>
                                </tr>
                                <tr>
                                    <th>Loại sách</th>
                                    <td>{{$kind_of_book->LS_TEN}}</td>
                                </tr>
                                <tr>
                                    <th>Hình ảnh</th>
                                    @if(isset($images))
                                        <td>
                                        @foreach($images as $image)
                                            <img src="images/{{$image->HA_URL}}" width="100px" height="100px">
                                        @endforeach
                                        </td>
                                    @else
                                        <td>Chưa có hình ảnh</td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
