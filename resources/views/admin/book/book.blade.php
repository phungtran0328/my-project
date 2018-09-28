<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 09/16/2018
 * Time: 1:20 PM
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
                        <h5>Quản lý sách</h5>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2">
                                <a href="{{url('/admin/book/create')}}" class="btn btn-primary btn-block">
                                    <span class="glyphicon glyphicon-plus"> Sách</span>
                                </a>
                            </div>
                            <div class="col-md-2">
                                <a href="{{url('admin/book/image/create')}}" class="btn btn-primary btn-block">
                                    <span class="glyphicon glyphicon-plus"> Hình ảnh</span>
                                </a>
                            </div>
                            <div class="col-md-2">
                                <a href="{{url('admin/book/author/create')}}" class="btn btn-primary btn-block">
                                    <span class="glyphicon glyphicon-plus"> Tác giả</span>
                                </a>
                            </div>
                        </div>
                        <hr>
                        @if(Session::has('messAddBook'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messAddBook')}}
                            </div>
                        @endif
                        @if(Session::has('messAddImage'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messAddImage')}}
                            </div>
                        @endif
                        @if(Session::has('messBookAuthor'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messBookAuthor')}}
                            </div>
                        @endif
                        @if(Session::has('messBookTranslator'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messBookTranslator')}}
                            </div>
                        @endif
                        {{--@if(Session::has('messageUpdate'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messageUpdate')}}
                            </div>
                        @endif--}}
                        {{--@if(Session::has('messageRemove'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messageRemove')}}
                            </div>
                        @endif--}}
                        <div class="table-responsive ">
                            <table class="table table-striped table-bordered table-hover" style="width: 2000px">
                                <thead >
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Tác giả</th>
                                    <th>SL Tồn</th>
                                    <th>Kích thước</th>
                                    <th>Số trang</th>
                                    <th>Ngày XB</th>
                                    <th>Tái bản</th>
                                    <th>View</th>
                                    <th style="width: 30%">Giới thiệu</th>
                                    <th>Giá</th>
                                    <th>Khuyến mãi</th>
                                    <th>Nhà xuất bản</th>
                                    <th>Loại bìa</th>
                                    <th>Loại sách</th>
                                    <th>Hình ảnh</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($books as $index=>$book)
                                    <?php
                                        $temp = \App\Book::where('S_MA',$book->S_MA)->first();
                                        $publisher = $temp->publisher()->first();
                                        $authors = $temp->author()->get();
                                        $translators = $temp->translator()->get();
                                        $promotion = $temp->promotion()->first();
                                        $kind_of_book = $temp->kind_of_book()->first();
                                        $cover_type = $temp->cover_type()->first();
                                        $image = $temp->image()->first();
                                    ?>
                                    <tr style="text-align: justify">
                                        {{--increment not reset in second page--}}
                                        <td>{{$index + $books->firstItem()}}</td>
                                        <td>{{$book->S_TEN}}</td>
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
                                        <td>{{$book->S_SLTON}}</td>
                                        <td>{{$book->S_KICHTHUOC}}</td>
                                        <td>{{$book->S_SOTRANG}}</td>
                                        <td>{{$book->S_NGAYXB }}</td>
                                        <td>{{$book->S_TAIBAN}}</td>
                                        <td>{{$book->S_LUOTXEM}}</td>
                                        <td >{{$book->S_GIOITHIEU}}</td>
                                        <td>{{$book->S_GIA}}</td>
                                        @if(isset($promotion))
                                            <td>{{$promotion->KM_GIAM}}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>{{$publisher->NXB_TEN}}</td>
                                        <td>{{$cover_type->LB_TEN}}</td>
                                        <td>{{$kind_of_book->LS_TEN}}</td>
                                        @if(isset($image))
                                            <td><img src="images/{{$image->HA_URL}}" width="50px" height="50px"></td>
                                        @else
                                            <td>Chưa có hình ảnh</td>
                                        @endif
                                        <td class="text-center">
                                            <a class="btn btn-default" href="">
                                                <span class="glyphicon glyphicon-pencil"></span></a>
                                            <a class="btn btn-default" href="">
                                                <span class="glyphicon glyphicon-remove"></span></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{--{{$authors->render()}}--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
