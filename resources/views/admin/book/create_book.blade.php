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
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Thêm sách</h5>
                    </div>
                    <div class="panel-body">
                        <form action="{{url('/admin/book')}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group {{$errors->has('publisher') ? 'has-error' : ''}}">
                                <label class="control-label">Tên nhà xuất bản</label>
                                <select>
                                    <option value=""></option>
                                    <option value="">ABc</option>
                                </select>
                                <strong style="color: red">{{$errors->first('publisher')}}</strong>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Kích thước</label>
                                <input type="text" class="form-control" placeholder="Kích thước" name="size">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Số lượng tồn</label>
                                <input type="text" class="form-control" placeholder="Số lượng tồn" name="inventory_num">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block">Thêm mới</button>
                            </div>
                        </form>
                        <a class="btn btn-success btn-block" href="{{url('/admin/book')}}"><span class="glyphicon glyphicon-arrow-left"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
