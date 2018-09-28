<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 09/16/2018
 * Time: 4:50 PM
 */?>
@extends('admin.master')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thể loại sách</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Chỉnh sửa loại sách</h5>
                    </div>
                    <div class="panel-body">
                        <form class="" action="{{url('/admin/kind-of-book/update', $kindOfBook->LS_MA)}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                            <fieldset>
                                <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                                    <label class="control-label">Tên loại sách</label>
                                    <input type="text" class="form-control" value="{{$kindOfBook->LS_TEN}}" name="name">
                                    <strong style="color: red">{{$errors->first('name')}}</strong>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Mô tả</label>
                                    <input type="text" class="form-control" value="{{$kindOfBook->LS_MOTA}}" name="description" style="height: 80px">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block">Cập nhật</button>
                                </div>
                            </fieldset>
                        </form>
                        <a class="btn btn-success btn-block" href="{{url('/admin/kind-of-book')}}"><span class="glyphicon glyphicon-arrow-left"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
