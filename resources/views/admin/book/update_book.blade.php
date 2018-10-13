<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 09/29/2018
 * Time: 9:50 AM
 */?>
@extends('admin/master')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sách</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Cập nhật sách</h5>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <a class="btn btn-success btn-block" href="{{url('/admin/book')}}">
                                    <span class="glyphicon glyphicon-arrow-left"></span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a class="btn btn-success btn-block" href="{{url('/admin/book/author',$book->S_MA)}}">
                                    <span class="glyphicon glyphicon-pencil">  Tác giả</span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a class="btn btn-success btn-block" href="{{url('/admin/book/image',$book->S_MA)}}">
                                    <span class="glyphicon glyphicon-pencil">  Hình ảnh</span>
                                </a>
                            </div>
                        </div>
                        <br>
                        @if(Session::has('messUpdateBookError'))
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messUpdateBookError')}}
                            </div>
                        @endif
                        <form action="{{url('/admin/book',$book->S_MA)}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            @method('PATCH')
                            <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}" >
                                <label class="control-label">Tên sách</label>
                                <input type="text" class="form-control" name="name" value="{{$book->S_TEN}}">
                                <strong style="color: red">{{$errors->first('name')}}</strong>
                            </div>
                            <div class="form-group {{$errors->has('publisher') ? 'has-error' : ''}}">
                                <label class="control-label">Nhà xuất bản</label>
                                <select class="form-control" style="width: 400px" name="publisher">
                                    <option value="">---Chọn nhà xuất bản---</option>
                                    <?php
                                        $temp=$book->publisher()->first();
                                        $publishers=\App\Publisher::where('NXB_MA','!=',$temp->NXB_MA)->get();
                                    ?>
                                    <option value="{{$temp->NXB_MA}}" selected>{{$temp->NXB_TEN}}</option>
                                    @foreach($publishers as $publisher)
                                        <option value="{{$publisher->NXB_MA}}">{{$publisher->NXB_TEN}}</option>
                                    @endforeach
                                </select>
                                <strong style="color: red">{{$errors->first('publisher')}}</strong>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{$errors->has('kindOfBook') ? 'has-error' : ''}}">
                                        <label class="control-label">Loại sách</label>
                                        <select class="form-control" name="kindOfBook">
                                            <option value="">---Chọn loại sách---</option>
                                            <?php
                                                $temp=$book->kind_of_book()->first();
                                                $kindOfBooks=\App\KindOfBook::where('LS_MA','!=',$temp->LS_MA)->get();
                                            ?>
                                            <option value="{{$temp->LS_MA}}" selected>{{$temp->LS_TEN}}</option>
                                            @foreach($kindOfBooks as $kindOfBook)
                                                <option value="{{$kindOfBook->LS_MA}}">{{$kindOfBook->LS_TEN}}</option>
                                            @endforeach
                                        </select>
                                        <strong style="color: red">{{$errors->first('kindOfBook')}}</strong>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{$errors->has('coverType') ? 'has-error' : ''}}">
                                        <label class="control-label">Loại bìa</label>
                                        <select class="form-control" name="coverType">
                                            <option value="">---Chọn loại bìa---</option>
                                            <?php
                                            $temp=$book->cover_type()->first();
                                            $coverTypes=\App\CoverType::where('LB_MA','!=',$temp->LB_MA)->get();
                                            ?>
                                            <option value="{{$temp->LB_MA}}" selected>{{$temp->LB_TEN}}</option>
                                            @foreach($coverTypes as $coverType)
                                                <option value="{{$coverType->LB_MA}}">{{$coverType->LB_TEN}}</option>
                                            @endforeach
                                        </select>
                                        <strong style="color: red">{{$errors->first('coverType')}}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{$errors->has('price') ? 'has-error' : ''}}">
                                        <label class="control-label">Giá</label>
                                        <input type="number" min="0" step=".01" class="form-control" value="{{$book->S_GIA}}" name="price">
                                        <strong style="color: red">{{$errors->first('price')}}</strong>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Giá khuyến mãi</label>
                                        <select class="form-control" name="promotion">
                                            <option value="">---Chọn giá khuyến mãi---</option>
                                            <?php
                                            $temp=$book->promotion()->first();
                                            if (isset($temp)){
                                                $promotions=\App\Promotion::where('KM_MA','!=',$temp->KM_MA)->get();
                                            }
                                            else $promotions=App\Promotion::all();
                                            ?>
                                            @if(isset($temp))
                                                <option value="{{$temp->KM_MA}}" selected>{{$temp->KM_GIAM}} - {{$temp->KM_CHITIET}}</option>
                                            @endif
                                            @foreach($promotions as $promotion)
                                                <option value="{{$promotion->KM_MA}}">{{$promotion->KM_GIAM}} - {{$promotion->KM_CHITIET}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 {{$errors->has('publish_date') ? 'has-error' : ''}}">
                                    <label class="control-label" >Ngày xuất bản</label>
                                    <input type="date" class="form-control" value="{{$book->S_NGAYXB}}" name="publish_date" >
                                    <strong style="color: red">{{$errors->first('publish_date')}}</strong>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" >Tái bản</label>
                                    <input type="text" class="form-control" value="{{$book->S_TAIBAN}}" name="republish" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="control-label" >Kích thước</label>
                                    <input type="text" class="form-control" value="{{$book->S_KICHTHUOC}}" name="size" >
                                </div>
                                <div class="form-group col-md-4" >
                                    <label class="control-label">Số trang</label>
                                    <input type="number" min="0" class="form-control" value="{{$book->S_SOTRANG}}" name="page_num" >
                                </div>
                                <div class="form-group col-md-4 {{$errors->has('inventory_num') ? 'has-error' : ''}}" >
                                    <label class="control-label">Số lượng tồn</label>
                                    <input type="number" min="0" class="form-control" value="{{$book->S_SLTON}}" name="inventory_num" >
                                    <strong style="color: red">{{$errors->first('inventory_num')}}</strong>
                                </div>
                            </div>
                            <div class="form-group" >
                                <label class="control-label">Giới thiệu sách</label>
                                <textarea class="form-control" name="description" rows="10">{{$book->S_GIOITHIEU}}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-primary btn-block">Cập nhật</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
