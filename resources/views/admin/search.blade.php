<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 12/03/2018
 * Time: 11:11 AM
 */?>
@extends('admin/master')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3>Kết quả tìm kiếm gần giống với "{{$search}}"</h3>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <h4>Sách</h4>
                <ul class="list-group">
                    @if(count($books)>1)
                        @foreach($books as $book)
                            <li class="list-group-item">
                                <a href="{{url('admin/book')}}">{{$book->S_TEN}}</a>
                            </li>
                        @endforeach
                    @else
                        <li class="list-group-item">
                            <p>Không có kết quả phù hợp</p>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <h4>Tác giả</h4>
                <ul class="list-group">
                    @if(count($authors)>1)
                        @foreach($authors as $author)
                            <li class="list-group-item">
                                <a href="{{url('admin/author')}}">{{$author->TG_TEN}}</a>
                            </li>
                        @endforeach
                    @else
                        <li class="list-group-item">
                            <p>Không có kết quả phù hợp</p>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <h4>Nhân viên</h4>
                <ul class="list-group">
                    @if(count($employees)>1)
                        @foreach($employees as $employee)
                            <li class="list-group-item">
                                <a href="{{url('admin/user')}}">{{$employee->NV_TEN}}</a>
                            </li>
                        @endforeach
                    @else
                        <li class="list-group-item">
                            <p>Không có kết quả phù hợp</p>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endsection
