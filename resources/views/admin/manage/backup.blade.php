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
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Danh sách sao lưu</h5>
                    </div>
                    <div class="panel-body">
                        @can('backup.create')
                        <a class="btn btn-primary" href="{{url('admin/backup/create')}}">
                            <span class="glyphicon glyphicon-plus"></span> Sao lưu dữ liệu</a>
                        @endcan
                        <br><br>
                        <div class="table-responsive">
                            @if(session('messCreate'))
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{session('messCreate')}}
                                </div>
                            @endif
                            @if(session('delete'))
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{session('delete')}}
                                </div>
                            @endif
                            @if(session('messError'))
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{session('messError')}}
                                </div>
                            @endif
                            @if(session('deleteError'))
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{session('deleteError')}}
                                </div>
                            @endif
                            @if (count($backups))
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>File</th>
                                        <th>Kích thước</th>
                                        <th>Ngày chỉnh sửa</th>
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
                                                <?php
                                                    $date = new DateTime();
                                                    $date->setTimestamp($backup['last_modified']);
                                                ?>
                                                {{ $date->format('d/m/Y, g:i a') }}
                                            </td>
                                            <td class="text-right">
                                                @can('backup.download')
                                                <a class="btn btn-xs btn-default"
                                                   href="{{ url('admin/backup/download/'.$backup['file_name']) }}"><i
                                                            class="fa fa-cloud-download"></i> Download</a>
                                                @endcan
                                                @can('backup.delete')
                                                <a class="btn btn-xs btn-danger" data-button-type="delete"
                                                   href="{{ url('admin/backup/delete/'.$backup['file_name']) }}"><i class="fa fa-trash-o"></i>
                                                    Xóa</a>
                                                    @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                    {{$backups->render()}}
                            @else
                                <div class="well">
                                    <h4>Không có file backup !</h4>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
