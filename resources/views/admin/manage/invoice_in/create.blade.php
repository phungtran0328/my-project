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
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Thêm mới phiếu nhập</h5>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <button class="btn btn-danger btn-block" onclick="addBook()">Thêm sách mới</button>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-info btn-block" onclick="CloneForm()">Thêm phiếu nhập chi tiết</button>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-default btn-block" onclick="RemoveForm()">Xóa phiếu nhập chi tiết</button><br>
                            </div>
                            <div class="col-md-3">

                            </div>
                        </div>
                        <form action="{{url('/admin/invoice-in/create')}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label class="control-label">Nhân viên lập phiếu nhập</label>
                                    @if(\Illuminate\Support\Facades\Auth::check())
                                        <input type="hidden" name="user"  value="{{\Illuminate\Support\Facades\Auth::user()->NV_MA}}">
                                        <input class="form-control" value="{{\Illuminate\Support\Facades\Auth::user()->NV_TEN}}" readonly>
                                    @endif

                                </div>
                                <div class="col-md-3 form-group">
                                    <label class="control-label">Công ty phát hành *</label>
                                    <select class="form-control" name="company" required>
                                        <option value="">---Chọn công ty phát hành---</option>
                                        @foreach($companies as $company)
                                            <option value="{{$company->CTPH_MA}}">{{$company->CTPH_TEN}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 form-group {{$errors->has('date-in') ? 'has-error' : ''}}">
                                    <label class="control-label">Ngày nhập *</label>
                                    <input type="datetime" class="form-control" name="date-in" value="{{date("Y-m-d H:i:s")}}" required>
                                    <strong style="color: red">{{$errors->first('date-in')}}</strong>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label class="control-label">Ghi chú</label>
                                    <input type="text" class="form-control" placeholder="Ghi chú" name="note">
                                </div>
                            </div>
                            <div id="myForm">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="control-label">Sách *</label>
                                        <select class="form-control" name="book[]" required>
                                            <option value="">---Chọn sách---</option>
                                            @foreach($books as $book)
                                                <option value="{{$book->S_MA}}">{{$book->S_TEN}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group" >
                                        <label class="control-label">Số lượng *</label>
                                        <input type="number" min="1" class="form-control" name="qty[]" required>
                                    </div>
                                    <div class="col-md-3 form-group" >
                                        <label class="control-label">Giá *</label>
                                        <input type="number" min="1" step=".01" class="form-control" name="price[]" required>
                                    </div>
                                </div>
                            </div>
                            <div id="showInvoice"></div>
                            <div class="form-group">
                                <button class="btn btn-primary">Thêm phiếu nhập</button>
                                <a class="btn btn-success" href="{{url('/admin/invoice-in')}}">Hủy</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function addBook() {
            window.open("{{url('/admin/book/create')}}");
        }
        function CloneForm() {
            var html = document.getElementById('myForm');
            var cln = html.cloneNode(true);
            document.getElementById('showInvoice').appendChild(cln);
        }
        function RemoveForm() {
            var html = document.getElementById('showInvoice');
            html.removeChild(html.lastChild);
        }
    </script>
@endsection
