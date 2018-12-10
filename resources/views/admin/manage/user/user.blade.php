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
        <br>
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
                                    <a class="btn btn-success btn-block" onclick="printDiv('printUser')" href="{{url('admin/user/print')}}">
                                        <span class="glyphicon glyphicon-print"></span>
                                    </a>
                                </div>
                            @endcan
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
                        @if(session('messUpdateRole'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{session('messUpdateRole')}}
                            </div>
                        @endif
                        @if(session('messageRemove'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{session('messageRemove')}}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 15%">Tên</th>
                                    <th style="width: 8%">Giới tính</th>
                                    <th style="width: 4%">Ngày sinh</th>
                                    <th>Địa chỉ</th>
                                    <th style="width: 4%">SĐT</th>
                                    <th style="width: 10%">Quyền</th>
                                    <th style="width: 7%"></th>
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
                                        <td>
                                            @foreach($roles as $role)
                                                {{$role->Q_MA}}
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            @can('user.update')
                                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#userUpdate-{{$user->NV_MA}}">
                                                    <span class="glyphicon glyphicon-pencil"></span> Sửa
                                                </button>
                                            @endcan
                                            @can('user.delete')
                                                {{--<a class="btn btn-danger btn-sm" href="">
                                                    <span class="glyphicon glyphicon-remove" onclick="return confirm('Bạn chắn chắn xóa ? ')"></span> Xóa
                                                </a>--}}
                                            @endcan
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
                                    <th style="width: 20%">Quyền</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $index=>$user)
                                    @if(strlen($user->NV_MATKHAU)<60)
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
                                                {{$role->Q_TEN}} <br>
                                            @endforeach
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach($users as $user)
        <?php
        $roles = $user->roles()->get();
        $results = array();
        $i = 0;
        foreach ($roles as $role){
            $results[$i]= $role->Q_MA;
            $i++;
        }
        $roles_user = \App\Role::whereNotIn('Q_MA',$results)->get();
        ?>
        <div class="modal fade" id="userUpdate-{{$user->NV_MA}}" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="updateModal">Cập nhật quyền cho nhân viên: "{{$user->NV_TEN}}"</h3>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('admin/user/update',$user->NV_MA)}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            {{--@method('PATCH')--}}
                            <div class="form-group {{ $errors->has('roles') ? ' has-error' : '' }}">
                                <label class="control-label">Quyền (*)</label>
                                <select class="form-control" name="roles[]" multiple style="height: 200px" required>
                                    @foreach($roles as $role)
                                        <option value="{{$role->Q_MA}}" selected>{{$role->Q_TEN}}</option>
                                    @endforeach
                                    @foreach($roles_user as $key=>$value)
                                        <option value="{{$value->Q_MA}}">{{$value->Q_TEN}}</option>
                                    @endforeach
                                </select>
                                <strong style="color: red">{{$errors->first('roles') }}</strong>
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
