<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 09/27/2018
 * Time: 11:52 AM
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
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Thêm hình ảnh cho sách</h5>
                    </div>
                    <div class="panel-body">
                        <a class="btn btn-success btn-block" style="width: 150px" href="{{url('/admin/book')}}">
                            <span class="glyphicon glyphicon-arrow-left"></span>
                        </a>
                        <br>
                        <form action="{{url('/admin/book/image')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group {{$errors->has('book') ? 'has-error' : ''}}">
                                <label class="control-label">Sách</label>
                                <select class="form-control" name="book">
                                    <option value="">---Chọn sách--</option>
                                    @foreach($books as $book)
                                        <option value="{{$book->S_MA}}">{{$book->S_TEN}}</option>
                                    @endforeach
                                </select>
                                <strong style="color: red">{{$errors->first('book')}}</strong>
                            </div>
                            <div class="form-group {{$errors->has('images') ? 'has-error' : ''}}">
                                <label class="control-label">Hình ảnh</label>
                                {{--name="images[]" lưu nhiều record cùng lúc--}}
                                <input required type="file" class="form-control" name="images[]" placeholder="image" multiple>
                                <strong style="color: red">{{$errors->first('images')}}</strong>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-primary btn-block">Thêm hình ảnh</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
