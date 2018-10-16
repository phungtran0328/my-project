<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 10/07/2018
 * Time: 12:46 PM
 */?>
@extends('admin.master')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Hóa đơn nhập</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Thêm mới hóa đơn nhập</h5>
                    </div>
                    <div class="panel-body">
                        <form action="{{url('/admin/invoice-in/create')}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label class="control-label">Nhân viên lập hóa đơn nhập</label>
                                @if(\Illuminate\Support\Facades\Auth::check())
                                    <input type="hidden" name="user"  value="{{\Illuminate\Support\Facades\Auth::user()->NV_MA}}">
                                    <input class="form-control" value="{{\Illuminate\Support\Facades\Auth::user()->NV_TEN}}" readonly>
                                @endif

                            </div>
                            <div class="form-group {{$errors->has('company') ? 'has-error' : ''}}">
                                <label class="control-label">Công ty phát hành</label>
                                <select class="form-control" name="company">
                                    <option value="">---Chọn công ty phát hành---</option>
                                    @foreach($companies as $company)
                                        <option value="{{$company->CTPH_MA}}">{{$company->CTPH_TEN}}</option>
                                    @endforeach
                                </select>
                                <strong style="color: red">{{$errors->first('company')}}</strong>
                            </div>
                            <div class="form-group {{$errors->has('date-in') ? 'has-error' : ''}}" style="width: 200px">
                                <label class="control-label">Ngày nhập</label>
                                <input type="datetime" class="form-control" name="date-in" value="{{date("Y-m-d H:i:s")}}">
                                <strong style="color: red">{{$errors->first('date-in')}}</strong>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Ghi chú</label>
                                <input type="text" class="form-control" placeholder="Ghi chú" name="note">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block">Thêm hóa đơn</button>
                            </div>
                        </form>
                        <a class="btn btn-success btn-block" href="{{url('/admin/invoice-in')}}"><span class="glyphicon glyphicon-arrow-left"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
