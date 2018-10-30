<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 09/17/2018
 * Time: 1:09 PM
 */?>
@extends('admin.master')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Khuyến mãi</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Danh sách các loại sách</h5>
                    </div>
                    <div class="panel-body">
                        <button style="width: 15%" class="btn btn-primary" data-toggle="modal" data-target="#promotionCreate">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                        <div class="modal fade" id="promotionCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="exampleModalLabel">Thêm mới loại sách</h3>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{url('admin/promotion')}}" method="post" onsubmit="return validate()">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Giảm giá</label>
                                                        <input class="form-control" name="promotion_create" pattern="[0]+(\.[0-9][0-9][0-9]?)?"
                                                               placeholder="0.000" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Áp dụng</label>
                                                        <input type="date" class="form-control" placeholder="Ngày áp dụng"
                                                               name="start_create" id="start_create" required>
                                                        <strong style="color: red"></strong>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class=" form-group">
                                                        <label class="control-label">Hạn dùng</label>
                                                        <input type="date" class="form-control" placeholder="Ngày hết hạn"
                                                               name="end_create" id="end_create" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4"></div>
                                                <div class="col-md-8">
                                                    <strong style="color: red" id="end_error"></strong>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Mô tả chi tiết</label>
                                                <input type="text" class="form-control" placeholder="Mô tả chi tiết" name="description_create">
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary">Thêm mới</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
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
                        @if(Session::has('messageRemoveError'))
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messageRemoveError')}}
                            </div>
                        @endif
                        <div class="table-responsive ">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 5%">STT</th>
                                    <th>Giảm giá %</th>
                                    <th>Ngày áp dụng</th>
                                    <th>Ngày hết hạn</th>
                                    <th>Chi tiết</th>
                                    <th style="width: 18%">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($promotions as $index=>$promotion)
                                    <tr>
                                        <td>{{$index + $promotions->firstItem()}}</td>
                                        <td>{{$promotion->KM_GIAM}}</td>
                                        <td>{{$promotion->KM_APDUNG}}</td>
                                        <td>{{$promotion->KM_HANDUNG}}</td>
                                        <td>{{$promotion->KM_CHITIET}}</td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-sm" href="{{url('/admin/promotion',$promotion->KM_MA)}}">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </a>
                                            <a class="btn btn-default btn-sm" href="{{url('/admin/promotion/delete',$promotion->KM_MA)}}">
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$promotions->render()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var s, e, dateStart, dateEnd;

        document.getElementById("start_create").addEventListener("change", function() {
            dateStart = new Date(this.value);
            s = dateStart.setHours(0,0,0,0);
//            console.log(s);
        });
        document.getElementById("end_create").addEventListener("change", function() {
            dateEnd = new Date(this.value);
            e = dateEnd.setHours(0,0,0,0);
//            console.log(e);
        });

        function validate() {
            if (e<=s){
                document.getElementById('end_error').innerHTML = 'Hạn dùng không được nhỏ hơn hoặc bằng áp dụng';
                return false;
            }else {
                document.getElementById('end_error').innerHTML = '';
            }
        }
    </script>
@endsection
