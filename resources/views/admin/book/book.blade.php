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
                        @if(Session::has('messUpdateBook'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messUpdateBook')}}
                            </div>
                        @endif
                        {{--@if(Session::has('messageRemove'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messageRemove')}}
                            </div>
                        @endif--}}
                        <div class="table-responsive ">
                            <table class="table table-striped table-bordered table-hover">
                                <thead >
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Tác giả</th>
                                    <th>SL Tồn</th>
                                    <th>Giá</th>
                                    <th>Nhà xuất bản</th>
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
                                        <td>{{$book->S_GIA}}</td>
                                        <td>{{$publisher->NXB_TEN}}</td>
                                        @if(isset($image))
                                            <td><img src="images/{{$image->HA_URL}}" width="50px" height="50px"></td>
                                        @else
                                            <td>Chưa có hình ảnh</td>
                                        @endif
                                        <td class="text-center">
                                            <a class="btn btn-default" href="{{url('/admin/book',$book->S_MA)}}">
                                                <span class="glyphicon glyphicon-check"></span></a>
                                            <a class="btn btn-default" href="{{url('/admin/book/edit',$book->S_MA)}}">
                                                <span class="glyphicon glyphicon-pencil"></span></a>
                                            <a class="btn btn-default" href="">
                                                <span class="glyphicon glyphicon-remove"></span></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$books->render()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
