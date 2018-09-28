<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 09/16/2018
 * Time: 1:19 PM
 */
?>
@extends('admin.master')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Bìa sách</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Danh sách các loại bìa</h5>
                    </div>
                    <div class="panel-body">
                        <div class="row" >
                            <div class="col-md-2" id="myAdd" style="display: {{$errors->has('name') ? 'none' : 'block'}};">
                                <button class="btn btn-primary btn-block" onclick="asd(1)"><span class="glyphicon glyphicon-plus"></span></button>
                            </div>
                            <div id="myHide" style="display: {{$errors->has('name') ? 'block' : 'none'}};" class="col-md-2">
                                <button class="btn btn-success btn-block" onclick="asd(0)"><span class="glyphicon glyphicon-minus"></span></button>
                            </div>
                        </div>
                        <hr>

                        <form id="asd" action="{{url('/admin/cover-type')}}" method="post" style="display: {{$errors->has('name') ? 'block' : 'none'}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group ">
                                <label class="control-label">Tên bìa sách</label>
                                <input type="text" class="form-control" placeholder="Tên bìa sách" name="name" style="width: 200px">
                                <strong style="color: red">{{$errors->first('name')}}</strong>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Thêm mới</button>
                            </div>
                        </form>

                        <div class="table-responsive ">
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
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 10%">STT</th>
                                    <th>Tên</th>
                                    <th style="width: 15%">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @for($i=0; $i<count($cover_type); $i++)
                                <tr>
                                    <td>{{$i+1}}</td>
                                    <td>{{$cover_type[$i]->LB_TEN}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-default" href="{{url('/admin/cover-type',$cover_type[$i]->LB_MA)}}"><span class="glyphicon glyphicon-pencil"></span></a>
                                        <a class="btn btn-default" href=""><span class="glyphicon glyphicon-remove"></span></a>
                                    </td>
                                </tr>
                                @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script type="text/javascript">

//    window.onload = function() {
//        document.getElementById("asd").style.display = "none";
//    };

    function asd(a) {
        if (a == 1) {
            document.getElementById("asd").style.display = "block";
            document.getElementById("myHide").style.display = "block";
            document.getElementById("myAdd").style.display="none";
        } else {
            document.getElementById("asd").style.display = "none";
            document.getElementById("myHide").style.display = "none";
            document.getElementById("myAdd").style.display="block";
        }
    }
</script>
