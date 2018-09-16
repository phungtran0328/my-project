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
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5>Thêm loại sách mới</h5>
                </div>
                <div class="panel-body">
                    <form class="" action="{{url('admin/kind-of-book')}}" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        @if(Session::has('message'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('message')}}
                            </div>
                        @endif
                        <fieldset>
                            <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                                <label class="control-label">Tên loại sách</label>
                                <input type="text" class="form-control" placeholder="Tên loại sách" name="name">
                                <strong style="color: red">{{$errors->first('name')}}</strong>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Mô tả</label>
                                <input type="text" class="form-control" placeholder="Mô tả" name="description" style="height: 80px">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Thêm mới</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5>Danh sách các loại sách</h5>
                </div>
                <div class="panel-body">
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
                        @if(Session::has('messageDelete'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messageDelete')}}
                            </div>
                        @endif
                    <div class="table-responsive ">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th style="width: 5%">STT</th>
                                <th>Tên</th>
                                <th>Mô tả</th>
                                <th style="width: 15%">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i=0;$i<count($kind_of_book);$i++)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$kind_of_book[$i]->LS_TEN}}</td>
                                <td>{{$kind_of_book[$i]->LS_MOTA}}</td>
                                <td class="text-center">
                                    <a href="{{url('/admin/kind-of-book/update',$kind_of_book[$i]->LS_MA)}}"><span class="glyphicon glyphicon-pencil"></span></a>
                                    | <a href="{{url('/admin/kind-of-book/delete',$kind_of_book[$i]->LS_MA)}}"><span class="glyphicon glyphicon-remove"></span></a>
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
<script>
    function editKindOfBook() {
        /*var html= "";
        html+= "<form action='' method=''>";
        html+= "<input type='hidden' name='_token' value='"+""+"'>";
        html += "<fieldset>";
        html += "<div class='form-group'>";
        html += "<input type='text' class='form-control' value='' name='name'>";
        html += "</div>";
        html += "<div class='form-group'>";
        html += "<input type='text' class='form-control' value='' name='description'>";
        html += "</div>";
        html += "<div class='form-group'>";
        html += "<button class='btn btn-primary'>Cập nhật</button>";
        html += "</div>";
        html += "</fieldset>";
        html+= "</form>";
        document.getElementById("myEdit").innerHTML=html;*/
    }
    function removeKindOfBook() {

    }
</script>