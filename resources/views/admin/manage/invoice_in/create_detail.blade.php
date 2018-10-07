<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 10/07/2018
 * Time: 1:33 PM
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
            <div class="col-md-10">
                <a class="btn btn-success" style="width: 200px" href="{{url('/admin/invoice-in')}}">
                    <span class="glyphicon glyphicon-arrow-left"></span></a><br><br>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Thêm mới hóa đơn nhập</h5>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <button class="btn btn-success btn-block" onclick="addBook()">Thêm sách mới</button>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-info btn-block" onclick="CloneForm()">Thêm hóa đơn chi tiết</button><br>
                            </div>
                        </div>
                        <form action="{{url('/admin/invoice-in/create-detail',$invoice->PN_MA)}}" method="post" >
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group" style="width: 200px">
                                <label class="control-label">Mã HĐ</label>
                                <input type="text" class="form-control" name="id" value="{{$invoice->PN_MA}}" readonly>
                            </div>
                            <div id="myForm">
                                <div class="row">
                                    <div class="col-md-6 form-group {{$errors->has('book') ? 'has-error' : ''}}">
                                        <label class="control-label">Sách</label>
                                        <select class="form-control" name="book[]">
                                            <option value="">---Chọn sách---</option>
                                            @foreach($books as $book)
                                                <option value="{{$book->S_MA}}">{{$book->S_TEN}}</option>
                                            @endforeach
                                        </select>
                                        <strong style="color: red">{{$errors->first('book')}}</strong>
                                    </div>
                                    <div class="col-md-3 form-group {{$errors->has('qty') ? 'has-error' : ''}}" >
                                        <label class="control-label">Số lượng</label>
                                        <input type="number" min="1" class="form-control" name="qty[]">
                                        <strong style="color: red">{{$errors->first('qty')}}</strong>
                                    </div>
                                    <div class="col-md-3 form-group {{$errors->has('price') ? 'has-error' : ''}}" >
                                        <label class="control-label">Giá</label>
                                        <input type="number" min="0" step=".01" class="form-control" name="price[]" >
                                        <strong style="color: red">{{$errors->first('price')}}</strong>
                                    </div>
                                </div>
                            </div>
                            <div id="showInvoice"></div>
                            <div class="form-group">
                                <button class="btn btn-primary" style="width: 200px">Thêm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function addBook() {
        window.open("{{url('/admin/book/create')}}");
    }
    function CloneForm() {
       /* var formCount = document.forms.length;
        var oForm = document.forms[formName];
        var clone = oForm.cloneNode(true);
        clone.name += "_" + formCount;
//        document.body.appendChild(clone);
        document.getElementById('showInvoice').appendChild(clone);*/
        var html = document.getElementById('myForm');
        var cln = html.cloneNode(true);
        document.getElementById('showInvoice').appendChild(cln);
    }

</script>