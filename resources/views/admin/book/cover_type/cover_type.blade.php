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
                        <a href="{{url('admin/cover-type')}}">Danh sách các loại bìa</a>
                    </div>
                    <div class="panel-body">
                        <div class="row" >
                            <div class="col-md-2">
                                @can('book.create')
                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#coverTypeCreate">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </button>
                                @endcan
                                {{--modal create author--}}
                                <div class="modal fade" id="coverTypeCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel">Thêm bìa sách</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{url('/admin/cover-type')}}" method="post">
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                    <div class="form-group ">
                                                        <label class="control-label">Tên bìa sách</label>
                                                        <input type="text" class="form-control" placeholder="Tên bìa sách" name="name_create" required>
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
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-4">
                                <form role="search" class="input-group" action="{{url('admin/cover-type')}}" method="get">
                                    <input type="text" class="form-control" name="q" placeholder="Tìm bìa..." value="{{$search}}">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default-sm" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </form>
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive ">
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
                                @if(session('messDeleteError'))
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        {{session('messDeleteError')}}
                                    </div>
                                @endif
                                @if(session('messDelete'))
                                    <div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        {{session('messDelete')}}
                                    </div>
                                @endif
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 10%">STT</th>
                                    <th>Tên</th>
                                    <th style="width: 15%">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cover_type as $index=>$cover)
                                <tr>
                                    <td>{{$index + $cover_type->firstItem()}}</td>
                                    <td>{{$cover->LB_TEN}}</td>
                                    <td class="text-center">
                                        @can('book.update')
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#coverUpdate-{{$cover->LB_MA}}">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </button>
                                        @endcan
                                        @can('book.delete')
                                        <a class="btn btn-danger btn-sm" href="{{url('admin/cover-type/delete',$cover->LB_MA)}}" onclick="return confirm('Bạn chắc chắn xóa ?')">
                                            <span class="glyphicon glyphicon-remove"></span></a>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$cover_type->render()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($cover_type as $item)
        <div class="modal fade" id="coverUpdate-{{$item->LB_MA}}" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="updateModal">Cập nhật loại bìa: "{{$item->LB_TEN}}"</h3>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('/admin/cover-type/update', $item->LB_MA)}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <fieldset>
                                <div class="form-group">
                                    <label class="control-label">Tên loại bìa</label>
                                    <input type="text" class="form-control" value="{{$item->LB_TEN}}" name="name_update" required>

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
@endsection

