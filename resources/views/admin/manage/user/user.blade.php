<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 10/07/2018
 * Time: 8:32 AM
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
                        <h5>Danh sách nhân viên</h5>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            @can('user.create')
                                <div class="col-md-2">
                                    <a href="{{url('admin/user/create')}}" class="btn btn-primary btn-block">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </a>
                                </div>
                                <div class="col-md-9"></div>
                                <div class="col-md-1">
                                    <button class="btn btn-success btn-block" onclick="printDiv('printUser')">
                                        <span class="glyphicon glyphicon-print"></span>
                                    </button>
                                </div>
                            @endcan
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
                        @if(Session::has('messUpdateRole'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messUpdateRole')}}
                            </div>
                        @endif
                        @if(Session::has('messageRemove'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messageRemove')}}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    @can('user.update')
                                    <th style="width: 8%" colspan="2">Hành động</th>
                                    @endcan
                                    <th style="width: 15%">Tên</th>
                                    <th style="width: 10%">Giới tính</th>
                                    <th style="width: 4%">Ngày sinh</th>
                                    <th>Địa chỉ</th>
                                    <th style="width: 4%">SĐT</th>
                                    <th style="width: 7%">Quyền</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $index=>$user)
                                    <tr>
                                        @can('user.update')
                                            <td class="text-center" colspan="1">
                                                <a class="btn btn-default btn-sm" href="{{url('admin/user/update',$user->NV_MA)}}">
                                                <span class="glyphicon glyphicon-pencil"></span></a>
                                            </td>
                                        @endcan
                                        @can('user.delete')
                                            <td class="text-center" colspan="1">
                                                <a class="btn btn-default btn-sm" href="">
                                                    <span class="glyphicon glyphicon-remove"></span></a>
                                            </td>
                                        @endcan
                                        <td>{{$user->NV_TEN}}</td>
                                        <td>{{$user->NV_GIOITINH}}</td>
                                        <?php
                                            $date=date_create($user->NV_NGAYSINH);
                                            $temp=\App\User::where('NV_MA',$user->NV_MA)->first();
                                            $roles=$temp->roles()->get();
                                        ?>
                                        <td>{{date_format($date,"d/m/Y")}}</td>
                                        <td>{{$user->NV_DIACHI}}</td>
                                        <td>{{$user->NV_SDT}}</td>
                                        <td>
                                            @foreach($roles as $role)
                                                {{$role->Q_MA}}
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$users->render()}}
                        </div>

                        {{--in danh sách nhân viên--}}
                        <div class="table-responsive " id="printUser" style="display: none">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 15%">Tên</th>
                                    <th style="width: 10%">Giới tính</th>
                                    <th style="width: 4%">Ngày sinh</th>
                                    <th>Địa chỉ</th>
                                    <th style="width: 4%">SĐT</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th style="width: 7%">Quyền</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $index=>$user)
                                    <tr>
                                        <td>{{$user->NV_TEN}}</td>
                                        <td>{{$user->NV_GIOITINH}}</td>
                                        <?php
                                        $date=date_create($user->NV_NGAYSINH);
                                        $temp=\App\User::where('NV_MA',$user->NV_MA)->first();
                                        $roles=$temp->roles()->get();
                                        ?>
                                        <td>{{date_format($date,"d/m/Y")}}</td>
                                        <td>{{$user->NV_DIACHI}}</td>
                                        <td>{{$user->NV_SDT}}</td>
                                        <td>{{$user->NV_TENDANGNHAP}}</td>
                                        <td>{{$user->NV_MATKHAU}}</td>
                                        <td>
                                            @foreach($roles as $role)
                                                {{$role->Q_MA}}
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML; //Lấy thẻ div
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents; //trả về nguyên vẹn trước khi in
        }
    </script>
@endsection
