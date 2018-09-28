<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 09/26/2018
 * Time: 9:11 AM
 */?>
@extends('admin.master')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Nhà xuất bản</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Thêm mới nhà xuất bản</h5>
                    </div>
                    <div class="panel-body">
                        <form action="{{url('/admin/publisher')}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                                <label class="control-label">Tên nhà xuất bản</label>
                                <input type="text" class="form-control" placeholder="Tên nhà xuất bản" name="name">
                                <strong style="color: red">{{$errors->first('name')}}</strong>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Ghi chú</label>
                                <input type="text" class="form-control" placeholder="Ghi chú" name="note">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block">Thêm mới</button>
                            </div>
                        </form>
                        <a class="btn btn-success btn-block" href="{{url('/admin/publisher')}}"><span class="glyphicon glyphicon-arrow-left"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
