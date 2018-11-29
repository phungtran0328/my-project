<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 09/26/2018
 * Time: 12:12 PM
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
            <div class="col-md-12 ">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Thêm sách</h5>
                    </div>
                    <div class="panel-body">
                        <a class="btn btn-success btn-block" style="width: 150px" href="{{url('/admin/book')}}">
                            <span class="glyphicon glyphicon-arrow-left"></span>
                        </a>
                        <br>
                        <form action="{{url('/admin/book')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="row">
                                <div class="col-md-4 form-group {{$errors->has('name') ? 'has-error' : ''}}" >
                                    <label class="control-label">Tên sách *</label>
                                    <input type="text" class="form-control" placeholder="Nhập tên sách" name="name" value="{{old('name')}}">
                                    <strong style="color: red">{{$errors->first('name')}}</strong>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Khuyến mãi</label>
                                    <select class="form-control" name="promotion">
                                        <option value="">---Chọn giá khuyến mãi---</option>
                                        @foreach($promotions as $promotion)
                                            <option value="{{$promotion->KM_MA}}">{{$promotion->KM_GIAM}} - {{$promotion->KM_CHITIET}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Avatar *</label>
                                    {{--name="images[]" lưu nhiều record cùng lúc--}}
                                    <input required type="file" class="form-control" name="avatar">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 form-group {{$errors->has('publisher') ? 'has-error' : ''}}">
                                    <label class="control-label">Nhà xuất bản *</label>
                                    <select class="form-control" name="publisher">
                                        <option value="">---Chọn nhà xuất bản---</option>
                                        @foreach($publishers as $publisher)
                                            <option value="{{$publisher->NXB_MA}}">{{$publisher->NXB_TEN}}</option>
                                        @endforeach
                                    </select>
                                    <strong style="color: red">{{$errors->first('publisher')}}</strong>
                                </div>
                                <div class="col-md-3 form-group {{$errors->has('publish_date') ? 'has-error' : ''}}">
                                    <label class="control-label" >Ngày xuất bản</label>
                                    <input type="date" class="form-control" placeholder="Ngày xuất bản" name="publish_date" >
                                    <strong style="color: red">{{$errors->first('publish_date')}}</strong>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label" >Tái bản</label>
                                    <input type="text" class="form-control" placeholder="Năm tái bản" name="republish" value="{{old('republish')}}">
                                </div>
                                <div class="form-group col-md-2" >
                                    <label class="control-label">Số trang</label>
                                    <input type="number" min="0" class="form-control" placeholder="Số trang" name="page_num" value="{{old('page_num')}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Tập hình ảnh *</label>
                                    {{--name="images[]" lưu nhiều record cùng lúc--}}
                                    <input required type="file" class="form-control" name="images[]" placeholder="image" multiple>
                                </div>
                                <div class="col-md-3 form-group {{$errors->has('kindOfBook') ? 'has-error' : ''}}">
                                    <label class="control-label">Loại sách *</label>
                                    <select class="form-control" name="kindOfBook">
                                        <option value="">---Chọn loại sách---</option>
                                        @foreach($kindOfBooks as $kindOfBook)
                                            <option value="{{$kindOfBook->LS_MA}}">{{$kindOfBook->LS_TEN}}</option>
                                        @endforeach
                                    </select>
                                    <strong style="color: red">{{$errors->first('kindOfBook')}}</strong>
                                </div>
                                <div class="col-md-3 form-group {{$errors->has('coverType') ? 'has-error' : ''}}">
                                    <label class="control-label">Loại bìa *</label>
                                    <select class="form-control" name="coverType">
                                        <option value="">---Chọn loại bìa---</option>
                                        @foreach($coverTypes as $coverType)
                                            <option value="{{$coverType->LB_MA}}">{{$coverType->LB_TEN}}</option>
                                        @endforeach
                                    </select>
                                    <strong style="color: red">{{$errors->first('coverType')}}</strong>
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="control-label" >Kích thước</label>
                                    <input type="text" class="form-control" placeholder="Kích thước" name="size" value="{{old('size')}}">
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label><input type="checkbox" id="myCheck" onclick="myFunction()"> Sách ngoại văn có người dịch</label>
                                    <div class="form-group {{$errors->has('author') ? 'has-error' : ''}}">
                                        <label class="control-label">Tác giả</label>
                                        <select class="form-control" multiple name="author[]" style="height: 200px">
                                            <option value="" disabled selected>---Chọn tác giả--</option>
                                            @foreach($authors as $author)
                                                <option value="{{$author->TG_MA}}">{{$author->TG_TEN}}</option>
                                            @endforeach
                                        </select>
                                        <strong style="color: red">{{$errors->first('author')}}</strong>
                                    </div>
                                    <div id="translatorList" style="display: none">
                                        <div class="form-group">
                                            <label class="control-label">Người dịch</label>
                                            <input class="form-control" placeholder="Người dịch" name="translator" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 form-group" >
                                    <label class="control-label">Giới thiệu sách</label>
                                    <textarea rows="16" class="form-control" placeholder="Giới thiệu sách" name="description">{{old('description')}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-primary btn-block">Thêm mới</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function myFunction() {
            var check = document.getElementById('myCheck');
            var translator = document.getElementById('translatorList');
            if (check.checked==true){
                translator.style.display='block';
            }else {
                translator.style.display='none';
            }
        }
    </script>
@endsection
