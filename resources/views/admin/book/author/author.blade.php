<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 09/16/2018
 * Time: 1:20 PM
 */?>
@extends('admin.master')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tác giả</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Danh sách tác giả</h5>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2">
                                <a href="{{url('/admin/author/create')}}" class="btn btn-primary btn-block">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </a>
                            </div>
                            @if(isset($search))
                                <div class="col-md-4"></div>
                                <div class="col-md-2">
                                    <a href="{{url('/admin/author')}}" class="btn btn-primary btn-block">
                                        <span class="glyphicon glyphicon-arrow-left"> Trở lại</span>
                                    </a>
                                </div>
                                @else
                                <div class="col-md-6"></div>
                            @endif
                            <div class="col-md-4">
                                <form role="search" class="input-group" action="{{url('admin/author')}}" method="get">
                                    <input type="text" class="form-control" name="search" placeholder="Tìm tác giả theo tên" value="{{$search}}">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default-sm" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </form>
                            </div>

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
                        @if(Session::has('messageRemove'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messageRemove')}}
                            </div>
                        @endif
                        <div class="table-responsive " id="mySearch">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 5%">STT</th>
                                    <th>Tên</th>
                                    <th>Mô tả</th>
                                    <th>Ghi chú</th>
                                    <th style="width: 15%">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($authors as $index=>$author)
                                    <tr>
                                        {{--increment not reset in second page--}}
                                        <td>{{$index + $authors->firstItem()}}</td>
                                        <td>{{$author->TG_TEN}}</td>
                                        <td>{{$author->TG_MOTA}}</td>
                                        <td>{{$author->TG_GHICHU}}</td>
                                        <td class="text-center">
                                            <a class="btn btn-default" href="{{url('admin/author/update',$author->TG_MA)}}">
                                                <span class="glyphicon glyphicon-pencil"></span></a>
                                            <a class="btn btn-default" href="{{url('admin/author/delete',$author->TG_MA)}}">
                                                <span class="glyphicon glyphicon-remove"></span></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$authors->render()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
