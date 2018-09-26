<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 09/16/2018
 * Time: 1:20 PM
 */?>
@extends('admin/master')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Nhà xuất bản</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Danh sách nhà xuất bản</h5>
                    </div>
                    <div class="panel-body">
                        <a href="{{url('/admin/publisher/create')}}" class="btn btn-primary" style="width: 100px;"> + </a>

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
                        @if(Session::has('messageRemove'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messageRemove')}}
                            </div>
                        @endif
                        <div class="table-responsive ">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 5%">STT</th>
                                    <th>Tên</th>
                                    <th>Ghi chú</th>
                                    <th style="width: 15%">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($publishers as $index=>$publisher)
                                    <tr>
                                        {{--increment not reset in second page--}}
                                        <td>{{$index + $publishers->firstItem()}}</td>
                                        <td>{{$publisher->NXB_TEN}}</td>
                                        <td>{{$publisher->NXB_GHICHU}}</td>
                                        <td class="text-center">
                                            <a class="btn btn-default" href="{{url('admin/publisher',$publisher->NXB_MA)}}">
                                                <span class="glyphicon glyphicon-pencil"></span></a>
                                            <a class="btn btn-default" href="{{url('admin/publisher/delete',$publisher->NXB_MA)}}">
                                                <span class="glyphicon glyphicon-remove"></span></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$publishers->render()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
