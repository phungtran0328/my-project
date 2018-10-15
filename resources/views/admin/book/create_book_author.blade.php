<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 09/28/2018
 * Time: 9:26 AM
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
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Thêm tác giả cho sách</h5>
                    </div>
                    <div class="panel-body">
                        <a class="btn btn-success btn-block" style="width: 150px" href="{{url('/admin/book')}}">
                            <span class="glyphicon glyphicon-arrow-left"></span>
                        </a>
                        <br>
                        <label><input type="checkbox" id="myCheck" onclick="myFunction()"> Sách ngoại văn có người dịch</label>
                        <hr>
                        <div id="authorList">
                            <form action="{{url('/admin/book/author')}}" method="post">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                @if(Session::has('messErrorAuthor'))
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        {{Session::get('messErrorAuthor')}}
                                    </div>
                                @endif
                                @if(Session::has('messErrorTranslator'))
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        {{Session::get('messErrorTranslator')}}
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
                                <div class="row">
                                    <div class="col-md-6 form-group {{$errors->has('book') ? 'has-error' : ''}}">
                                        <label class="control-label">Sách</label>
                                        {{-- name=book[] => array() --}}
                                        <select class="form-control" name="book">
                                            <option value="" disabled selected>---Chọn sách--</option>
                                            @foreach($books as $book)
                                                <?php
                                                $temp=\App\Book::where('S_MA', $book->S_MA)->first();
                                                $temps_author=$temp->author()->first();
                                                $temps_trans=$temp->translator()->first();
                                                ?>
                                                @if(empty($temps_author) and empty($temps_trans))
                                                    <option value="{{$book->S_MA}}">{{$book->S_TEN}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <strong style="color: red">{{$errors->first('book')}}</strong>
                                    </div>
                                    <div class="col-md-6 form-group {{$errors->has('author') ? 'has-error' : ''}}">
                                        <label class="control-label">Tác giả</label>
                                        <select class="form-control" multiple name="author[]" style="height: 200px">
                                            <option value="" disabled selected>---Chọn tác giả--</option>
                                            @foreach($authors as $author)
                                                <option value="{{$author->TG_MA}}">{{$author->TG_TEN}}</option>
                                            @endforeach
                                        </select>
                                        <strong style="color: red">{{$errors->first('author')}}</strong>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button class="btn btn-primary btn-block">Thêm tác giả</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="translatorList" style="display: none">
                            <form action="{{url('/admin/book/author/translator')}}" method="post">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                @if(Session::has('messErrorTranslator'))
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        {{Session::get('messErrorTranslator')}}
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <div class="form-group {{$errors->has('book') ? 'has-error' : ''}}">
                                            <label class="control-label">Sách</label>

                                            <select class="form-control" name="book">
                                                <option value="" disabled selected>---Chọn sách--</option>
                                                @foreach($books as $book)
                                                    <?php
                                                    $temp=\App\Book::where('S_MA', $book->S_MA)->first();
                                                    $temps_author=$temp->author()->first();
                                                    $temps_trans=$temp->translator()->first();
                                                    ?>
                                                    @if(empty($temps_author) and empty($temps_trans))
                                                        <option value="{{$book->S_MA}}">{{$book->S_TEN}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <strong style="color: red">{{$errors->first('book')}}</strong>
                                        </div>
                                        <div class="form-group {{$errors->has('translator') ? 'has-error' : ''}}">
                                            <label class="control-label">Người dịch</label>
                                            <input class="form-control" placeholder="Người dịch" name="translator">
                                            <strong style="color: red">{{$errors->first('translator')}}</strong>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group {{$errors->has('author') ? 'has-error' : ''}}">
                                        <label class="control-label">Tác giả</label>
                                        <select class="form-control" multiple name="author[]" style="height: 200px">
                                            <option value="" disabled selected>---Chọn tác giả--</option>
                                            @foreach($authors as $author)
                                                <option value="{{$author->TG_MA}}">{{$author->TG_TEN}}</option>
                                            @endforeach
                                        </select>
                                        <strong style="color: red">{{$errors->first('author')}}</strong>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button class="btn btn-primary btn-block">Thêm tác giả và người dịch</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function myFunction() {
            var check=document.getElementById('myCheck');
            var author=document.getElementById('authorList');
            var translator=document.getElementById('translatorList');
            if (check.checked==true){
                author.style.display='none';
                translator.style.display='block';
            }else {
                author.style.display='block';
                translator.style.display='none';
            }
        }
    </script>
@endsection
