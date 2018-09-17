<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 09/17/2018
 * Time: 12:38 PM
 */
?>
@extends('admin/master')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Bìa sách</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Chỉnh sửa bìa sách</h5>
                    </div>
                    <div class="panel-body">
                        <form class="" action="{{url('/admin/cover-type', $cover->LB_MA)}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            @method('PATCH')
                            <fieldset>
                                <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                                    <label class="control-label">Tên loại sách</label>
                                    <input type="text" class="form-control" value="{{$cover->LB_TEN}}" name="name">
                                    <strong style="color: red">{{$errors->first('name')}}</strong>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block">Cập nhật</button>
                                </div>
                            </fieldset>
                        </form>
                        <a class="btn btn-success btn-block" href="{{url('/admin/cover-type')}}"><span class="glyphicon glyphicon-arrow-left"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
