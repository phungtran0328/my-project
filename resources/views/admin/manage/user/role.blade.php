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
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Nhân viên</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Danh sách quyền</h5>
                    </div>
                    <div class="panel-body">
                        <a href="{{url('admin/role/create')}}" class="btn btn-primary" style="width: 150px;">
                            <span class="glyphicon glyphicon-plus"></span>
                        </a>
                        <hr>
                        @if(Session::has('messAdd'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messAdd')}}
                            </div>
                        @endif
                        {{--@if(Session::has('messageUpdate'))
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
                        @endif--}}
                        <div class="table-responsive ">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 3%">STT</th>
                                    <th style="width: 15%">Tên</th>
                                    <th>Quyền</th>
                                    <th>Nhân viên</th>
                                    <th style="width: 12%">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $index=>$role)
                                    <tr>
                                        {{--increment not reset in second page--}}
                                        <td>{{$index + $roles->firstItem()}}</td>
                                        <td>{{$role->Q_TEN}}</td>
                                        <td>

                                        </td>
                                        <?php
                                            $temp=\App\Role::where('Q_MA',$role->Q_MA)->first();
                                            $users=$temp->users()->get();
                                        ?>
                                        <td>
                                            @foreach($users as $user)
                                                {{$user->NV_TEN}}
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-default" href="">
                                                <span class="glyphicon glyphicon-pencil"></span></a>
                                            <a class="btn btn-default" href="">
                                                <span class="glyphicon glyphicon-remove"></span></a>
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
@endsection
