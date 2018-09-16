<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 09/16/2018
 * Time: 1:19 PM
 */
?>
@extends('admin/master')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thể loại sách</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Thêm loại sách mới</h5>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="" method="post">
                            <label class="control-label">Tên loại sách</label>
                            <input type="text" class="form-control" placeholder="Tên loại sách" name="name">
                            <label class="control-label">Mô tả</label>
                            <input type="text" class="form-control" placeholder="Mô tả" name="description">
                            <button class="btn btn-primary">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5>Danh sách các loại sách</h5>
                </div>
                <div class="panel-body">
                    <div class="table-responsive ">
                        <table class="table table-striped table-bordered table-hover">
                            <colgroup style="width: 25%; "></colgroup>
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Mô tả</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
