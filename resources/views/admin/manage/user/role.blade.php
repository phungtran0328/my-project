<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 10/08/2018
 * Time: 11:13 AM
 */?>
@extends('admin.master')
@section('content')
    <div id="page-wrapper">
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Danh sách quyền</h5>
                    </div>
                    <div class="panel-body">
                        @can('user.create')
                        <a href="{{url('admin/role/create')}}" class="btn btn-primary" style="width: 150px;">
                            <span class="glyphicon glyphicon-plus"></span>
                        </a>
                        @endcan
                        <hr>
                        @if(Session::has('messAdd'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messAdd')}}
                            </div>
                        @endif
                        @if(Session::has('messUpdate'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messUpdate')}}
                            </div>
                        @endif
                        @if(Session::has('updateUser'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('updateUser')}}
                            </div>
                        @endif
                        @if(Session::has('delete'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('delete')}}
                            </div>
                        @endif
                        <div class="table-responsive ">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 3%">STT</th>
                                    <th style="width: 15%">Tên</th>
                                    <th>Quyền</th>
                                    <th>Nhân viên</th>
                                    <th style="width: 25%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $index=>$role)
                                    <tr>
                                        {{--increment not reset in second page--}}
                                        <td>{{$index + $roles->firstItem()}}</td>
                                        <td>{{$role->Q_TEN}}</td>
                                        @php
                                            $users=$role->users()->get();
                                            $results = $role->Q_QUYEN;
                                            $key=array_keys($results);
                                            $create=$results[$key[0]];
                                            $update=$results[$key[1]];
                                            $delete=$results[$key[2]];
                                        @endphp
                                        <td>
                                            {{$create=="true" ? 'Thêm' : ''}}
                                            {{$update=="true" ? 'Sửa' : ''}}
                                            {{$delete=="true" ? 'Xóa' : ''}}
                                        </td>
                                        <td>
                                            @foreach($users as $user)
                                                {{$user->NV_TEN}}
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            @can('user.update')
                                            <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#roleUpdate-{{$role->Q_MA}}">
                                                <span class="glyphicon glyphicon-plus"></span> Thêm NV</a>
                                            <a class="btn btn-info btn-sm" href="{{url('admin/role/update',$role->Q_MA)}}">
                                                <span class="glyphicon glyphicon-pencil"></span> Sửa</a>
                                            @endcan
                                            @can('user.delete')
                                            <a class="btn btn-danger btn-sm" href="{{url('admin/role/delete',$role->Q_MA)}}">
                                                <span class="glyphicon glyphicon-remove"></span> Xóa</a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$roles->render()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--modal update slider--}}
    @foreach($roles as $role)
        <div class="modal fade" id="roleUpdate-{{$role->Q_MA}}" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="updateModal">Cập nhật nhân viên sử dụng</h3>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('admin/role/update/user',$role->Q_MA)}}" method="post" >
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label class="control-label">Nhân viên</label>
                                <select name="users[]" class="form-control" multiple>
                                    @php
                                        $users=$role->users()->get();
                                        $results = array();
                                        $i=0;
                                        foreach ($users as $user){
                                            $results[$i] = $user->NV_MA;
                                            $i++;
                                        }
                                        $temps = \App\User::whereNotIn('NV_MA', $results)->get();
                                    @endphp
                                    @foreach($users as $user)
                                        <option value="{{$user->NV_MA}}" selected>{{$user->NV_TEN}}</option>
                                    @endforeach
                                    @foreach($temps as $temp)
                                        <option value="{{$temp->NV_MA}}">{{$temp->NV_TEN}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Cập nhật</button>
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
@endsection
