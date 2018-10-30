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
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Bìa sách</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Danh sách các loại bìa</h5>
                    </div>
                    <div class="panel-body">
                        <div class="row" >
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#coverTypeCreate">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </button>
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
                        </div>
                        <hr>

                        <div class="table-responsive ">
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
                                @if(Session::has('messDeleteError'))
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        {{Session::get('messDeleteError')}}
                                    </div>
                                @endif
                                @if(Session::has('messDelete'))
                                    <div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        {{Session::get('messDelete')}}
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
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#coverUpdate-{{$cover->LB_MA}}">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </button>
                                        <a class="btn btn-default btn-sm" href="{{url('admin/cover-type/delete',$cover->LB_MA)}}"><span class="glyphicon glyphicon-remove"></span></a>
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

