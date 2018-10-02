<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 10/02/2018
 * Time: 9:05 AM
 */

$temps_author=$book->author()->get();
$results=array();
foreach ($temps_author as $temp){
    $results[]=$temp->TG_MA;
}
//lấy mảng không chứa temp
$authors=\App\Author::whereNotIn('TG_MA',$results)->get();

$temps_trans=$book->translator()->get();
$results=array();
foreach ($temps_trans as $temp){
    $results[]=$temp->TG_MA;
}
//lấy mảng không chứa temp
$translators=\App\Author::whereNotIn('TG_MA',$results)->get();
?>
@extends('admin.master')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sách</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Cập nhật hình ảnh cho sách</h5>
                    </div>
                    <div class="panel-body">
                        <a class="btn btn-success btn-block" style="width: 150px" href="{{url('/admin/book/edit',$book->S_MA)}}">
                            <span class="glyphicon glyphicon-arrow-left"></span>
                        </a>
                        <br>
                        @if(!isset($temps_trans[0]->pivot->DICHGIA))
                        <form action="{{url('/admin/book/author',$book->S_MA)}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            @method('PATCH')
                            <div class="form-group">
                                <label class="control-label">Sách</label>
                                <input class="form-control" value="{{$book->S_TEN}}" readonly>
                                <input type="hidden" name="id" value="{{$book->S_MA}}">
                            </div>
                            <div class="form-group {{$errors->has('author') ? 'has-error' : ''}}">
                                <label class="control-label">Tác giả</label>
                                <select class="form-control" name="author[]" multiple style="height: 300px">
                                    <option value="" disabled>--- Chọn tác giả ---</option>
                                    @foreach($temps_author as $temp)
                                        <option value="{{$temp->TG_MA}}" selected>{{$temp->TG_TEN}}</option>
                                    @endforeach
                                    @for($i=0;$i<count($authors);$i++)
                                        <option value="{{$authors[$i]['TG_MA']}}" >{{$authors[$i]['TG_TEN']}}</option>
                                    @endfor
                                </select>
                                <strong style="color: red">{{$errors->first('author')}}</strong>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-primary btn-block">Cập nhật tác giả</button>
                                </div>
                            </div>
                        </form>
                        @else
                        <form action="{{url('/admin/book/author/translator',$book->S_MA)}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                            <div class="form-group">
                                <label class="control-label">Sách</label>
                                <input class="form-control" value="{{$book->S_TEN}}" readonly>
                                <input type="hidden" name="id" value="{{$book->S_MA}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Dịch giả</label>
                                <input class="form-control" value="{{$temps_trans[0]->pivot->DICHGIA}}" name="translator">
                            </div>
                            <div class="form-group {{$errors->has('translator') ? 'has-error' : ''}}">
                                <label class="control-label">Tác giả</label>
                                <select class="form-control" name="author[]" multiple style="height: 300px">
                                    <option value="" disabled>--- Chọn tác giả ---</option>
                                    @foreach($temps_trans as $temp)
                                        <option value="{{$temp->TG_MA}}" selected>{{$temp->TG_TEN}}</option>
                                    @endforeach
                                    @for($i=0;$i<count($translators);$i++)
                                        <option value="{{$translators[$i]['TG_MA']}}" >{{$translators[$i]['TG_TEN']}}</option>
                                    @endfor
                                </select>
                                <strong style="color: red">{{$errors->first('author')}}</strong>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-primary btn-block">Cập nhật tác giả và dịch giả</button>
                                </div>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
