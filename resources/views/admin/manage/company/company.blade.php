<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 10/06/2018
 * Time: 11:05 AM
 */?>
@extends('admin.master')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Công ty phát hành</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Danh sách công ty phát hành</h5>
                    </div>
                    <div class="panel-body">
                        <a href="{{url('admin/company/create')}}" class="btn btn-primary" style="width: 150px;">
                            <span class="glyphicon glyphicon-plus"></span>
                        </a>
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
                                    <th>Địa chỉ</th>
                                    <th>Số điện thoại</th>
                                    <th>Ghi chú</th>
                                    <th style="width: 15%">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($companies as $index=>$company)
                                    <tr>
                                        {{--increment not reset in second page--}}
                                        <td>{{$index + $companies->firstItem()}}</td>
                                        <td>{{$company->CTPH_TEN}}</td>
                                        <td>{{$company->CTPH_DIACHI}}</td>
                                        <td>{{$company->CTPH_SDT}}</td>
                                        <td>{{$company->CTPH_GHICHU}}</td>
                                        <td class="text-center">
                                            <a class="btn btn-default" href="{{url('admin/company/update',$company->CTPH_MA)}}">
                                                <span class="glyphicon glyphicon-pencil"></span></a>
                                            <a class="btn btn-default" href="{{url('admin/company/delete',$company->CTPH_MA)}}">
                                                <span class="glyphicon glyphicon-remove"></span></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$companies->render()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
