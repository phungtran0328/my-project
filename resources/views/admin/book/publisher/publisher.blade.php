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
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Nhà xuất bản</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Danh sách nhà xuất bản</h5>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2">
                                @can('book.create')
                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#publisherCreate">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </button>
                                @endcan
                                {{--modal create author--}}
                                <div class="modal fade" id="publisherCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel">Thêm nhà xuất bản</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{url('/admin/publisher')}}" method="post">
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                    <div class="form-group">
                                                        <label class="control-label">Tên nhà xuất bản</label>
                                                        <input type="text" class="form-control" placeholder="Tên nhà xuất bản" name="name_create" required>
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
                        </div>
                        <hr>
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
                        @if(Session::has('messageRemoveError'))
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messageRemoveError')}}
                            </div>
                        @endif
                        <div class="table-responsive ">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 5%">STT</th>
                                    <th>Tên</th>
                                    <th>Ghi chú</th>
                                    <th style="width: 15%">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($publishers as $index=>$publisher)
                                    <tr>
                                        {{--increment not reset in second page--}}
                                        <td>{{$index + $publishers->firstItem()}}</td>
                                        <td>{{$publisher->NXB_TEN}}</td>
                                        <td>{{$publisher->NXB_GHICHU}}</td>
                                        <td class="text-center">
                                            @can('book.update')
                                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#publisherUpdate-{{$publisher->NXB_MA}}">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </button>
                                            @endcan
                                            @can('book.delete')
                                            <a class="btn btn-danger btn-sm" href="{{url('admin/publisher/delete',$publisher->NXB_MA)}}" onclick="return confirm('Bạn chắn chắn xóa ? ')">
                                                <span class="glyphicon glyphicon-remove"></span></a>
                                                @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$publishers->render()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($publishers as $publisher)
        <div class="modal fade" id="publisherUpdate-{{$publisher->NXB_MA}}" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="updateModal">Cập nhật: "{{$publisher->NXB_TEN}}"</h3>
                    </div>
                    <div class="modal-body">
                        <form class="" action="{{url('/admin/publisher/update', $publisher->NXB_MA)}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <fieldset>
                                <div class="form-group ">
                                    <label class="control-label">Tên nhà xuất bản</label>
                                    <input class="form-control" value="{{$publisher->NXB_TEN}}" name="name_update" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Ghi chú</label>
                                    <input type="text" class="form-control" value="{{$publisher->NXB_GHICHU}}" name="note_update">
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
