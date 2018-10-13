<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 09/17/2018
 * Time: 1:09 PM
 */
?>
@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Khuyến mãi</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5>Chỉnh sửa khuyến mãi</h5>
                </div>
                <div class="panel-body">
                    @if(Session::has('messDate'))
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{Session::get('messDate')}}
                        </div>
                    @endif
                    <form class="" action="{{url('/admin/promotion', $promotion->KM_MA)}}" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        @method('PATCH')
                        <fieldset>
                            <div class="form-group {{$errors->has('promotion') ? 'has-error' : ''}}">
                                <label class="control-label">Giảm %</label>
                                <input pattern="[0]+(\.[0-9][0-9][0-9]?)?" class="form-control" value="{{$promotion->KM_GIAM}}" name="promotion">
                                <strong style="color: red">{{$errors->first('promotion')}}</strong>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Áp dụng</label>
                                <input type="date" class="form-control" value="{{$promotion->KM_APDUNG}}" name="start" style="width: 200px">
                                <strong style="color: red">{{$errors->first('start')}}</strong>
                                <label class="control-label">Hạn dùng</label>
                                <input type="date" class="form-control" value="{{$promotion->KM_HANDUNG}}" name="end" style="width: 200px">
                                <strong style="color: red">{{$errors->first('end')}}</strong>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Mô tả chi tiết</label>
                                <input type="text" class="form-control" value="{{$promotion->KM_CHITIET}}" name="description">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block">Cập nhật</button>
                            </div>
                        </fieldset>
                    </form>
                    <a class="btn btn-success btn-block" href="{{url('/admin/promotion')}}"><span class="glyphicon glyphicon-arrow-left"></span></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
