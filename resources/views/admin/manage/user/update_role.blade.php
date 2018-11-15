<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 10/08/2018
 * Time: 1:56 PM
 */?>
@extends('admin.master')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Quyền</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="row">
                <div class="col-md-8">
                    <a class="btn btn-success" style="width: 200px" href="{{url('/admin/role')}}">
                        <span class="glyphicon glyphicon-arrow-left"></span></a>
                    <br><br>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5>Cập nhật thông tin quyền</h5>
                        </div>
                        <div class="panel-body">
                            <form action="{{url('admin/role/update',$role->Q_MA)}}" method="POST">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="row">
                                    <div class="col-md-8 form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label class="control-label">Tên quyền (*)</label>
                                        <input type="text" class="form-control"
                                               name="name" value="{{$role->Q_TEN}}">
                                        <strong style="color: red">{{$errors->first('name') }}</strong>
                                    </div>
                                </div>
                                <?php
                                    $results=$role->Q_QUYEN;
                                    $key=array_keys($results);
                                    $create=$results[$key[0]];
                                    $update=$results[$key[1]];
                                    $delete=$results[$key[2]];
                                ?>
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label class="control-label">Create (*)</label>
                                        <select class="form-control" name="create">
                                            <option value="true" {{$create=="true" ? 'selected' : ''}}> True</option>
                                            <option value="false" {{$create=="false" ? 'selected' : ''}}> False</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="control-label">Update (*)</label>
                                        <select class="form-control" name="update">
                                            <option value="true" {{$update=="true" ? 'selected' : ''}}> True</option>
                                            <option value="false" {{$update=="false" ? 'selected' : ''}}> False</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="control-label">Delete (*)</label>
                                        <select class="form-control" name="delete">
                                            <option value="true" {{$delete=="true" ? 'selected' : ''}}> True</option>
                                            <option value="false" {{$delete=="false" ? 'selected' : ''}}> False</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <button class="btn btn-primary" style="width: 300px">Cập nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
