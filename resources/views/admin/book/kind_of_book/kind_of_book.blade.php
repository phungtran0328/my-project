<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 09/16/2018
 * Time: 1:19 PM
 */
?>
@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{url('admin/kind-of-book')}}">Danh sách các loại sách</a>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-2">
                            @can('book.create')
                                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </button>
                            @endcan
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-4">
                            <form role="search" class="input-group" action="{{url('admin/kind-of-book')}}" method="get">
                                <input type="text" class="form-control" name="q" placeholder="Tìm thể loại..." value="{{$search}}">
                                <span class="input-group-btn">
                                    <button class="btn btn-default-sm" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </form>
                        </div>
                    </div>

                    <hr>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLabel">Thêm mới loại sách</h3>
                                </div>
                                <div class="modal-body">
                                    <form class="" action="{{url('admin/kind-of-book')}}" method="post" onsubmit="return validateForm()">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <fieldset>
                                            <div class="form-group">
                                                <label class="control-label">Tên loại sách</label>
                                                <input type="text" class="form-control" placeholder="Tên loại sách" name="name_create" id="name_create">
                                                <strong id="error_create_name" style="color: red"></strong>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Chiết khấu</label>
                                                <input pattern="[0-9]+(\.[0-9][0-9][0-9]?)?" class="form-control"
                                                       placeholder="Chiết khấu giá sách theo loại dạng 0.00" name="discount_create" id="discount_create">
                                                <strong id="error_create_discount" style="color: red"></strong>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Mô tả</label>
                                                <textarea rows="3" class="form-control" placeholder="Mô tả" name="description_create"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary">Thêm mới</button>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(session('messageAdd'))
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{session('messageAdd')}}
                        </div>
                    @endif
                    @if(session('messageUpdate'))
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{session('messageUpdate')}}
                        </div>
                    @endif
                    @if(session('messageDelete'))
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{session('messageDelete')}}
                        </div>
                    @endif
                    @if(session('messageDeleteError'))
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{session('messageDeleteError')}}
                        </div>
                    @endif
                    <div class="table-responsive ">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th style="width: 5%">STT</th>
                                <th>Tên</th>
                                <th>Chiết khấu</th>
                                <th>Mô tả</th>
                                <th style="width: 15%">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($kob_sort as $index=>$kob)
                            <tr>
                                <td>{{$index + $kob_sort->firstItem()}}</td>
                                <td>{{$kob->LS_TEN}}</td>
                                <td>{{$kob->LS_CHIETKHAU}}</td>
                                <td>{{$kob->LS_MOTA}}</td>
                                <td class="text-center">
                                    @can('book.update')
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updateKOB-{{$kob->LS_MA}}">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </button>
                                    @endcan
                                    @can('book.delete')
                                    <a class="btn btn-danger btn-sm" href="{{url('/admin/kind-of-book/delete',$kob->LS_MA)}}" onclick="return confirm('Bạn chắn chắn xóa ? ')">
                                        <span class="glyphicon glyphicon-remove"></span></a>
                                        @endcan
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$kob_sort->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach($kob_sort as $item)
    <div class="modal fade" id="updateKOB-{{$item->LS_MA}}" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="updateModal">Cập nhật loại sách: "{{$item->LS_TEN}}"</h3>
                </div>
                <div class="modal-body">
                    <form action="{{url('/admin/kind-of-book/update', $item->LS_MA)}}" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <fieldset>
                            <div class="form-group">
                                <label class="control-label">Tên loại sách</label>
                                <input type="text" required class="form-control" value="{{$item->LS_TEN}}" name="name_update" >
                            </div>
                            <div class="form-group">
                                <label class="control-label">Chiết khấu</label>
                                <input pattern="[0-9]+(\.[0-9][0-9][0-9]?)?" class="form-control" required
                                       name="discount_update" value="{{$item->LS_CHIETKHAU}}" id="discount_update">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Mô tả</label>
                                <textarea rows="3" class="form-control" name="description_update">{{$item->LS_MOTA}}</textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block">Cập nhật</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

<script>
    function validateForm() {
        var name = document.getElementById('name_create').value.trim();
        var discount = document.getElementById('discount_create').value.trim();
        if (name==""){
            document.getElementById('error_create_name').innerHTML= 'Vui lòng nhập tên loại sách';
            return false;
        }else {document.getElementById('error_create_name').innerHTML= '';}
        if (discount==""){
            document.getElementById('error_create_discount').innerHTML= 'Vui lòng nhập chiết khấu';
            return false;
        }else {document.getElementById('error_create_discount').innerHTML= '';}
    }
</script>
@endsection
