<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 11/14/2018
 * Time: 8:56 AM
 */?>
@extends('admin.master')
@section('content')
    <div id="page-wrapper">
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Danh sách sliders</h5>
                    </div>
                    <div class="panel-body">
                        @can('book.create')
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sliderCreate" style="width: 15%">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                        @endcan
                        <hr>
                        {{--modal create author--}}
                        <div class="modal fade" id="sliderCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel">Thêm slider</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{url('admin/slider/create')}}" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="form-group">
                                                <label class="control-label">Sliders</label>
                                                <input type="file" class="form-control" name="sliders[]" multiple>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary">Thêm</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(Session::has('add'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('add')}}
                            </div>
                        @endif
                        @if(Session::has('update'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('update')}}
                            </div>
                        @endif
                        @if(Session::has('delete'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('delete')}}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Hình ảnh</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $i=1; @endphp
                                @foreach($sliders as $slider)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$slider->name}}</td>
                                        <td id="myTooltipSlider">
                                            <a data-toggle="tooltip" title="<img src='images/slider/{{$slider->slider}}' width='500px' height='300px'>">
                                                <img src="images/slider/{{$slider->slider}}" width="100px" height="50px">
                                            </a>
                                        </td>
                                        <td class="text-right">
                                            @can('book.update')
                                            <a class="btn btn-sm btn-info"
                                               data-toggle="modal" data-target="#sliderUpdate-{{$slider->id}}">
                                                <i class="fa fa-pencil"></i> Sửa</a>
                                            @endcan
                                            @can('book.delete')
                                            <a class="btn btn-sm btn-danger" data-button-type="delete"
                                               href="{{url('admin/slider/delete',$slider->id)}}" onclick="return confirm('Bạn có chắc chắn xóa slider? ');">
                                                <i class="fa fa-trash-o"></i> Xóa</a>
                                                @endcan
                                        </td>
                                    </tr>
                                    @php $i++; @endphp
                                @endforeach
                                </tbody>
                            </table>
                            {{$sliders->render()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--modal update slider--}}
    @foreach($sliders as $slider)
        <div class="modal fade" id="sliderUpdate-{{$slider->id}}" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="updateModal">Cập nhật slider</h3>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('admin/slider/update',$slider->id)}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <fieldset>
                                <div class="form-group">
                                    <label class="control-label">Tên slider</label>
                                    <input class="form-control" value="{{$slider->name}}" name="name_update" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Slider</label>
                                    <input type="file" class="form-control" name="slider">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary">Cập nhật</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
