<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 09/16/2018
 * Time: 1:20 PM
 */?>
@extends('admin.master')
@section('content')
    <div id="page-wrapper">
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{url('/admin/author')}}">Quản lý tác giả</a>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2">
                                @can('book.create')
                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#authorCreate">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </button>
                                @endcan
                                {{--modal create author--}}
                                <div class="modal fade" id="authorCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel">Thêm tác giả</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{url('/admin/author')}}" method="post">
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                    <div class="form-group">
                                                        <label class="control-label">Tên tác giả</label>
                                                        <input type="text" class="form-control" placeholder="Tên tác giả" name="name_create" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Mô tả</label>
                                                        <input type="text" class="form-control" placeholder="Mô tả" name="description_create">
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
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-4">
                                <form role="search" class="input-group" action="{{url('admin/author')}}" method="get">
                                    <input type="text" class="form-control" name="search" placeholder="Tìm tác giả theo tên" value="{{$search}}">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default-sm" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </form>
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
                        <div class="table-responsive " id="mySearch">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 5%">STT</th>
                                    <th>Tên</th>
                                    <th>Mô tả</th>
                                    <th>Ghi chú</th>
                                    <th style="width: 15%">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($authors as $index=>$author)
                                    <tr>
                                        {{--increment not reset in second page--}}
                                        <td>{{$index + $authors->firstItem()}}</td>
                                        <td>{{$author->TG_TEN}}</td>
                                        <td>{{$author->TG_MOTA}}</td>
                                        <td>{{$author->TG_GHICHU}}</td>
                                        <td class="text-center">
                                            @can('book.update')
                                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#authorUpdate-{{$author->TG_MA}}">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </button>
                                            @endcan
                                            @can('book.delete')
                                            <a class="btn btn-danger btn-sm" href="{{url('admin/author/delete',$author->TG_MA)}}" onclick="return confirm('Bạn chắn chắn xóa ? ')">
                                                <span class="glyphicon glyphicon-remove"></span></a>
                                                @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$authors->render()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--modal update author--}}
    @foreach($authors as $author)
        <div class="modal fade" id="authorUpdate-{{$author->TG_MA}}" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="updateModal">Cập nhật tác giả: "{{$author->TG_TEN}}"</h3>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('/admin/author/update', $author->TG_MA)}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            {{--@method('PATCH')--}}
                            <fieldset>
                                <div class="form-group">
                                    <label class="control-label">Tên tác giả</label>
                                    <input class="form-control" value="{{$author->TG_TEN}}" name="name_update" required>

                                </div>
                                <div class="form-group">
                                    <label class="control-label">Mô tả</label>
                                    <input type="text" class="form-control" value="{{$author->TG_MOTA}}" name="description_update">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Ghi chú</label>
                                    <input type="text" class="form-control" value="{{$author->TG_GHICHU}}" name="note_update">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary">Cập nhật</button>
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
