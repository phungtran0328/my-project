<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 10/06/2018
 * Time: 11:05 AM
 */?>
@extends('admin.master')
@section('content')
    <div id="page-wrapper">
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{url('admin/company')}}">Danh sách công ty phát hành</a>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2">
                                @can('invoice-in.create')
                                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#companyCreate">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                @endcan
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-4">
                                <form role="search" class="input-group" action="{{url('admin/company')}}" method="get">
                                    <input type="text" class="form-control" name="q" placeholder="Tìm công ty phát hành..." value="{{$search}}">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default-sm" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </form>
                            </div>
                        </div>
                        <div class="modal fade" id="companyCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="exampleModalLabel">Thêm công ty phát hành</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{url('admin/company')}}" method="post" name="companyForm" onsubmit="return validateCompany()">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                                                    <label class="control-label">Tên công ty phát hành</label>
                                                    <input type="text" class="form-control" placeholder="Tên công ty phát hành" name="name_create">
                                                    <strong style="color: red">{{$errors->first('name')}}</strong>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Địa chỉ</label>
                                                    <input type="text" class="form-control" placeholder="Địa chỉ" name="address_create">
                                                </div>
                                                <div class="form-group {{$errors->has('phone') ? 'has-error' : ''}}">
                                                    <label class="control-label">Số điện thoại</label>
                                                    <input type="tel" class="form-control" placeholder="Số điện thoại" name="phone_create">
                                                    <strong style="color: red">{{$errors->first('phone')}}</strong>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Ghi chú</label>
                                                    <input type="text" class="form-control" placeholder="Ghi chú" name="note_create">
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-primary">Thêm mới</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <hr>
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
                        @if(session('messageRemove'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{session('messageRemove')}}
                            </div>
                        @endif
                            @if(session('messageRemoveError'))
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{session('messageRemoveError')}}
                                </div>
                            @endif
                        <div class="table-responsive ">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 5%">STT</th>
                                    <th>Tên</th>
                                    <th>Địa chỉ</th>
                                    <th>Số điện thoại</th>
                                    <th>Ghi chú</th>
                                    <th style="width: 15%">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($companies as $index=>$company)
                                    <tr>
                                        {{--increment not reset in second page--}}
                                        <td>{{$index + $companies->firstItem()}}</td>
                                        <td>{{$company->CTPH_TEN}}</td>
                                        <td>{{$company->CTPH_DIACHI}}</td>
                                        <td>{{$company->CTPH_SDT}}</td>
                                        <td>{{$company->CTPH_GHICHU}}</td>
                                        <td class="text-center">
                                            @can('invoice-in.update')
                                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#companyUpdate-{{$company->CTPH_MA}}">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </button>
                                            @endcan
                                            @can('invoice-in.delete')
                                            <a class="btn btn-danger btn-sm" href="{{url('admin/company/delete',$company->CTPH_MA)}}" onclick="return confirm('Bạn chắn chắn xóa ? ')">
                                                <span class="glyphicon glyphicon-remove"></span></a>
                                                @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$companies->render()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach($companies as $company)
        <div class="modal fade" id="companyUpdate-{{$company->CTPH_MA}}" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="updateModal">Cập nhật tác giả: "{{$company->CTPH_TEN}}"</h3>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('/admin/company/update',$company->CTPH_MA)}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label class="control-label">Tên công ty phát hành</label>
                                <input type="text" class="form-control" value="{{$company->CTPH_TEN}}" name="name_update" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Địa chỉ</label>
                                <input type="text" class="form-control" value="{{$company->CTPH_DIACHI}}" name="address_update">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Số điện thoại</label>
                                <input type="tel" class="form-control" value="{{$company->CTPH_SDT}}"
                                       name="phone_update" pattern="[0-9]{10}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Ghi chú</label>
                                <input type="text" class="form-control" value="{{$company->CTPH_GHICHU}}" name="note_update">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block">Cập nhật</button>
                            </div>
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
        function validateCompany()
        {
            var y = document.forms["companyForm"]["name_create"].value;
            var x = document.forms["companyForm"]["phone_create"].value;
//            console.log(x);
            var phone_no = /^\d{10}$/;
            if (y.trim()==''){
                alert("Vui lòng nhập tên công ty phát hành !");
                return false;
            }
            if(!x.match(phone_no))
            {
                alert("Số điện thoại gồm 10 số. Vui lòng nhập lại !");
                return false;
            }

        }
    </script>
@endsection
