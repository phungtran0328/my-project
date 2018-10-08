<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 10/08/2018
 * Time: 2:07 PM
 */?>
@extends('admin.master')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Quyền</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="row">
                <div class="col-md-8">
                    <a class="btn btn-success" style="width: 200px" href="{{url('/admin/role')}}">
                        <span class="glyphicon glyphicon-arrow-left"></span></a>
                    <br><br>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5>Thêm mới quyền</h5>
                        </div>
                        <div class="panel-body">
                            <form action="{{url('admin/role/create')}}" method="POST">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="row">
                                    <div class="col-md-8 form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label class="control-label">Tên quyền (*)</label>
                                        <input type="text" class="form-control"
                                               name="name" value="{{old('name')}}">
                                        <strong style="color: red">{{$errors->first('name') }}</strong>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('roles') ? ' has-error' : '' }}">
                                    <label class="control-label">Danh sách quyền (*)</label><br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label"><input type="radio" name="roles" value="1"> Order</label><br>
                                            {{--<label><input type="checkbox" name="roles[]" value="order.create"><span>order.create</span></label><br>
                                            <label><input type="checkbox" name="roles[]" value="order.update"><span>order.update</span></label><br>
                                            <label><input type="checkbox" name="roles[]" value="order.delete"><span>order.delete</span></label><br>--}}
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label"><input type="radio" name="roles" value="2"> Employee</label>
                                            {{--<label><input type="checkbox" name="roles[]" value="employee.create"><span>employee.create</span></label><br>
                                            <label><input type="checkbox" name="roles[]" value="employee.update"><span>employee.update</span></label><br>
                                            <label><input type="checkbox" name="roles[]" value="employee.delete"><span>employee.delete</span></label><br>--}}
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label"><input type="radio" name="roles" value="3"> Customer</label>
                                            {{--<label><input type="checkbox" name="roles[]" value="customer.create"><span>customer.create</span></label><br>
                                            <label><input type="checkbox" name="roles[]" value="customer.update"><span>customer.update</span></label><br>
                                            <label><input type="checkbox" name="roles[]" value="customer.delete"><span>customer.delete</span></label><br>--}}
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label"><input type="radio" name="roles" value="4"> Invoice-In</label>
                                            {{--<label><input type="checkbox" name="roles[]" value="invoice-in.create"><span>invoice-in.create</span></label><br>
                                            <label><input type="checkbox" name="roles[]" value="invoice-in.update"><span>invoice-in.update</span></label><br>
                                            <label><input type="checkbox" name="roles[]" value="invoice-in.delete"><span>invoice-in.delete</span></label><br>--}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label"><input type="radio" name="roles" value="5"> Invoice</label>
                                            {{--<label><input type="checkbox" name="roles[]" value="invoice.create"><span>invoice.create</span></label><br>
                                            <label><input type="checkbox" name="roles[]" value="invoice.update"><span>invoice.update</span></label><br>
                                            <label><input type="checkbox" name="roles[]" value="invoice.delete"><span>invoice.delete</span></label><br>--}}
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label"><input type="radio" name="roles" value="6"> Book</label><br>
                                            {{--<label><input type="checkbox" name="roles[]" value="book.create"><span>book.create</span></label><br>
                                            <label><input type="checkbox" name="roles[]" value="book.update"><span>book.update</span></label><br>
                                            <label><input type="checkbox" name="roles[]" value="book.delete"><span>book.delete</span></label><br>--}}
                                        </div>
                                    </div>
                                    <strong style="color: red">{{$errors->first('roles') }}</strong>
                                </div>
                                <br>
                                <div class="form-group">
                                    <button class="btn btn-primary" style="width: 300px">Thêm quyền</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
