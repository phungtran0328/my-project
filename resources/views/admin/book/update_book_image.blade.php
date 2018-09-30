<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 09/30/2018
 * Time: 10:20 AM
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
                        <h5>Cập nhật hình ảnh cho sách</h5>
                    </div>
                    <div class="panel-body">
                        <a class="btn btn-success btn-block" style="width: 150px" href="{{url('/admin/book/edit',$book->S_MA)}}">
                            <span class="glyphicon glyphicon-arrow-left"></span>
                        </a>
                        <br>
                        <form action="{{url('/admin/book/image',$book->S_MA)}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            @method('PATCH')
                            <div class="form-group">
                                <label class="control-label">Sách</label>
                                <input class="form-control" value="{{$book->S_TEN}}" readonly>
                                <input type="hidden" name="id" value="{{$book->S_MA}}">
                            </div>
                            <div class="form-group {{$errors->has('images') ? 'has-error' : ''}}">
                                <label class="control-label">Hình ảnh</label>
                                {{--name="images[]" lưu nhiều record cùng lúc--}}
                                <input required type="file" class="form-control" name="images[]" multiple>
                                {{--@if(isset($images))
                                    @foreach($images as $image)
                                        <img src="images/{{$image->HA_URL}}" height="50px" width="50px">
                                    @endforeach
                                @endif--}}
                                <strong style="color: red">{{$errors->first('images')}}</strong>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-primary btn-block">Cập nhật hình ảnh</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
