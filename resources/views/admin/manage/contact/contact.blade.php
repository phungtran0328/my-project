<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 12/02/2018
 * Time: 10:41 AM
 */?>
@extends('admin.master')
@section('content')
    <div id="page-wrapper">
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Danh sách yêu cầu</h5>
                    </div>
                    <div class="panel-body">
                        @if(session('remove'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{session('remove')}}
                            </div>
                        @endif
                        <div class="table-responsive ">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 3%">STT</th>
                                    <th style="width: 15%">Email</th>
                                    <th style="width: 15%">Tiêu đề</th>
                                    <th style="width: 30%">Nội dung</th>
                                    <th>Mã ĐH</th>
                                    <th>Thời gian</th>
                                    <th style="width: 6%">Xóa</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($contacts as $index=>$contact)
                                    <tr>
                                        {{--increment not reset in second page--}}
                                        <td>{{$index + $contacts->firstItem()}}</td>
                                        <td>{{$contact->email}}</td>
                                        <td>{{$contact->title}}</td>
                                        <td>{{$contact->content}}</td>
                                        <td>{{$contact->order_id}}</td>
                                        <td>{{$contact->time}}</td>
                                        <td class="text-center">
                                            @can('book.delete')
                                                <a class="btn btn-danger btn-sm" href="{{url('admin/contact/delete',$contact->id)}}" onclick="return confirm('Bạn chắc chắn xóa ?')">
                                                    <span class="glyphicon glyphicon-remove"></span></a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$contacts->render()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
