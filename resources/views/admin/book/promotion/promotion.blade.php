<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 09/17/2018
 * Time: 1:09 PM
 */?>
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
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Thêm chương trình khuyến mãi</h5>
                    </div>
                    <div class="panel-body">
                        <form class="" action="{{url('admin/promotion')}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            @if(Session::has('message'))
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{Session::get('message')}}
                                </div>
                            @endif
                            <fieldset>
                                <div class="form-group {{$errors->has('promotion') ? 'has-error' : ''}}">
                                    <label class="control-label">Giảm giá</label>
                                    <input class="form-control" name="promotion" pattern="[0]+(\.[0-9][0-9][0-9]?)?"
                                           placeholder="0.000" style="width: 200px">
                                    <strong style="color: red">{{$errors->first('promotion')}}</strong>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Áp dụng</label>
                                    <input type="date" class="form-control" placeholder="Ngày áp dụng" name="start" style="width: 200px">
                                    <strong style="color: red">{{$errors->first('start')}}</strong>
                                    <label class="control-label">Hạn dùng</label>
                                    <input type="date" class="form-control" placeholder="Ngày hết hạn" name="end" style="width: 200px">
                                    <strong style="color: red">{{$errors->first('end')}}</strong>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Mô tả chi tiết</label>
                                    <input type="text" class="form-control" placeholder="Mô tả chi tiết" name="description">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary">Thêm mới</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Danh sách các loại sách</h5>
                    </div>
                    <div class="panel-body">
                        @if(Session::has('messageAdd'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messageAdd')}}
                            </div>
                        @endif
                            @if(Session::has('messageUpdate'))
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{Session::get('messageUpdate')}}
                                </div>
                            @endif
                            @if(Session::has('messageRemove'))
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{Session::get('messageRemove')}}
                                </div>
                            @endif
                        <div class="table-responsive ">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 5%">STT</th>
                                    <th>Giảm giá %</th>
                                    <th>Ngày áp dụng</th>
                                    <th>Ngày hết hạn</th>
                                    <th>Chi tiết</th>
                                    <th style="width: 18%">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @for($i=0;$i<count($promotions);$i++)
                                    <tr>
                                        <td>{{$i+1}}</td>
                                        <td>{{$promotions[$i]->KM_GIAM}}</td>
                                        <td>{{$promotions[$i]->KM_APDUNG}}</td>
                                        <td>{{$promotions[$i]->KM_HANDUNG}}</td>
                                        <td>{{$promotions[$i]->KM_CHITIET}}</td>
                                        <td class="text-center">
                                            <a class="btn btn-default" href="{{url('/admin/promotion',$promotions[$i]->KM_MA)}}">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </a>
                                            <a class="btn btn-default" href="{{url('/admin/promotion/delete',$promotions[$i]->KM_MA)}}">
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </a>
                                        </td>
                                    </tr>
                                @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
