<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 11/11/2018
 * Time: 2:48 PM
 */
function humanFilesize($size, $precision = 2) {
    $units = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
    $step = 1024;
    $i = 0;

    while (($size / $step) > 0.9) {
        $size = $size / $step;
        $i++;
    }

    return round($size, $precision).$units[$i];
}

?>
@extends('admin.master')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <br><br>
                <a class="btn btn-primary" href="{{url('admin/backup/create')}}">Sao lưu dữ liệu</a>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Danh sách sao lưu</h5>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            @if(Session::has('messCreate'))
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{Session::get('messCreate')}}
                                </div>
                            @endif
                            @if(Session::has('delete'))
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{Session::get('delete')}}
                                </div>
                            @endif
                            @if(Session::has('messError'))
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{Session::get('messError')}}
                                </div>
                            @endif
                            @if(Session::has('deleteError'))
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{Session::get('deleteError')}}
                                </div>
                            @endif
                            @if (count($backups))
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>File</th>
                                        <th>Size</th>
                                        <th>Date</th>
                                        <th>Age</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($backups as $backup)
                                        <tr>
                                            <td>{{ $backup['file_name'] }}</td>
                                            <td>
                                                {{ humanFilesize($backup['file_size']) }}
                                            </td>
                                            <td>
                                                {{ $backup['last_modified'] }}
                                            </td>
                                            <td>
                                                {{ $backup['last_modified'] }}
                                            </td>
                                            <td class="text-right">
                                                <a class="btn btn-xs btn-default"
                                                   href="{{ url('admin/backup/download/'.$backup['file_name']) }}"><i
                                                            class="fa fa-cloud-download"></i> Download</a>
                                                <a class="btn btn-xs btn-danger" data-button-type="delete"
                                                   href="{{ url('admin/backup/delete/'.$backup['file_name']) }}"><i class="fa fa-trash-o"></i>
                                                    Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="well">
                                    <h4>There are no backups</h4>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
