<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 10/12/2018
 * Time: 10:17 AM
 */?>
@extends('admin.master')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Đơn hàng</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="row">
                <div class="col-md-2">
                    <a class="btn btn-success btn-block" href="{{url('/admin/order')}}">
                        <span class="glyphicon glyphicon-arrow-left"></span></a>
                    <br>
                </div>
                <div class="col-md-2">
                    <a class="btn btn-danger btn-block" href="{{url('/admin/order/invoice',$order->DH_MA)}}">
                        Lập hóa đơn</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5>Cập nhật trạng thái đơn hàng</h5>
                        </div>
                        <div class="panel-body">
                            <form action="{{url('admin/order/update',$order->DH_MA)}}" method="POST">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="control-label">Mã ĐH</label>
                                        <input type="text" class="form-control "
                                               name="id" value="{{$order->DH_MA}}" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label class="control-label">Khách hàng</label>
                                        <input type="text" class="form-control "
                                               name="customer" value="{{$customer->KH_TEN}}" readonly>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="control-label">Nhân viên</label>
                                        <input type="text" class="form-control "
                                               name="user" value="{{Auth::user()->NV_TEN}}" readonly>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="control-label">Tổng tiền</label>
                                        <input type="text" class="form-control "
                                               name="customer" value="{{number_format($order->DH_TONGTIEN)}}" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="control-label">Ngày đặt</label>
                                        <input type="datetime" class="form-control "
                                               name="date" value="{{$order->DH_NGAYDAT}}" readonly>
                                    </div>
                                    <div class="col-md-6 form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                        <label class="control-label">Trạng thái đơn hàng (*)</label>
                                        <select class="form-control" name="status">
                                            <option value="">---Chọn trạng thái---</option>
                                            <option value="0">Đang xử lí</option>
                                            <option value="1">Đang vận chuyển</option>
                                            <option value="2">Giao hàng thành công</option>
                                        </select>
                                        <strong style="color: red">{{$errors->first('status') }}</strong>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label class="control-label">Địa chỉ giao hàng</label>
                                        <input type="text" class="form-control "
                                               name="id" value="{{$order->DH_DCGIAOHANG}}" readonly>
                                    </div>
                                </div>
                                <div class="row">

                                </div>
                                <div class="row">
                                    <div class="col-md-8 form-group">
                                        <label class="control-label">Hình thức thanh toán</label>
                                        <input type="text" class="form-control "
                                               name="id" value="{{$order->DH_GHICHU}}" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" style="width: 300px">Cập nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
