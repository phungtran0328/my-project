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
        <br>
        <div class="row">
            <div class="col-md-12">
                {{--<nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin/index')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Quán lý danh mục</li>
                        <li class="breadcrumb-item active">Sách</li>
                    </ol>
                </nav>--}}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Quản lý sách</h5>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                @can('book.create')
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a href="{{url('/admin/book/create')}}" class="btn btn-primary btn-block">
                                                <span class="glyphicon glyphicon-plus"></span> Sách
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{{url('/admin/book/export')}}" class="btn btn-success btn-block">
                                                <span class="glyphicon glyphicon-download"></span> Download
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <a class="btn btn-success btn-block" data-toggle="modal" data-target="#bookImport">
                                                Import
                                            </a>
                                        </div>
                                        <div class="modal fade" id="bookImport" tabindex="-1" role="dialog" aria-labelledby="checkModal" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content" >
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="checkModal">Nhập file</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="table-responsive ">
                                                            <form action="{{url('admin/book/import')}}" method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                                <div class="form-group">
                                                                    <input type="file" name="f" class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-primary">Thêm</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endcan
                            </div>
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>
                        <hr>
                        {{--session thông báo--}}
                        <div>
                            @if(session('messAddBook'))
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{session('messAddBook')}}
                                </div>
                            @endif
                            @if(session('messUpdateBook'))
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{session('messUpdateBook')}}
                                </div>
                            @endif
                            @if(session('messDelete'))
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{session('messDelete')}}
                                </div>
                            @endif
                            @if(session('messDeleteError'))
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{session('messDeleteError')}}
                                </div>
                            @endif
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{session('success')}}
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{session('error')}}
                                </div>
                            @endif
                        </div>
                        <div class="table-responsive ">
                            <table id="book" class="table table-bordered table-hover">
                                <thead >
                                <tr>
                                    <th></th>
                                    <th>Tên</th>
                                    <th style="width: 15%">Tác giả</th>
                                    <th style="width: 10%">Dịch giả</th>
                                    <th>SLT</th>
                                    <th>Giá</th>
                                    <th>V</th>
                                    <th>NXB</th>
                                    <th>HA</th>
                                    <th style="width: 14%">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($books as $index=>$book)
                                    <?php
                                        $publisher = $book->publisher()->first();
                                        $authors = $book->author()->get();
                                        $translators = $book->translator()->get();
                                        $book_qty = $book->S_SLTON;
                                    ?>
                                    <tr style="text-align: justify">
                                        {{--increment not reset in second page--}}
                                        <td>{{$index+1}}</td>
                                        <td>{{$book->S_TEN}}</td>
                                        <td>
                                        @if((count($authors)>0) or (count($translators)>0))
                                                @foreach($authors as $author)
                                                    {{$author->TG_TEN}} <br><br>
                                                @endforeach
                                                @foreach($translators as $translator)
                                                    {{$translator->TG_TEN}} <br><br>
                                                @endforeach
                                        @else
                                            Chưa cập nhật <br><br>
                                        @endif
                                        </td>
                                        @if(isset($translators[0]))
                                            <td>{{$translators[0]->pivot->DICHGIA}}</td>
                                            @else
                                            <td>Không có</td>
                                            @endif
                                        <td style="{{($book_qty<11) ? 'color: red' : ''}}">{{$book->S_SLTON}}</td>
                                        <td>{{number_format($book->S_GIA)}}</td>
                                        <td>{{$book->S_LUOTXEM}}</td>
                                        <td>{{$publisher->NXB_TEN}}</td>
                                        <td id="myTooltipBook">
                                            <a data-toggle="tooltip" title="<img src='images/avatar/{{$book->S_AVATAR}}' width='100%' height='100%' class='thumbnail'>">
                                                <img src="images/avatar/{{$book->S_AVATAR}}" width="50px" height="70px">
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#bookDetail-{{$book->S_MA}}">
                                                <span class="glyphicon glyphicon-check"></span>
                                            </button>
                                            @can('book.update')
                                                <a class="btn btn-info btn-sm" href="{{url('/admin/book/edit',$book->S_MA)}}" >
                                                    <span class="glyphicon glyphicon-pencil"></span></a>
                                            @endcan
                                            @can('book.delete')
                                                <a class="btn btn-danger btn-sm" href="{{url('admin/book/delete',$book->S_MA)}}"
                                                    onclick="return confirm('Bạn chắc chắn xóa chứ? ')">
                                                    <span class="glyphicon glyphicon-remove"></span></a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--mở modal để xem chi tiết sách--}}
    @foreach($books as $book)
        @php
            $publisher = $book->publisher()->first();
            $authors = $book->author()->get();
            $translators = $book->translator()->get();
            $promotion = $book->promotion()->first();
            $kind_of_book = $book->kind_of_book()->first();
            $cover_type = $book->cover_type()->first();
            $images = $book->image()->get();
        @endphp
        <div class="modal fade" id="bookDetail-{{$book->S_MA}}" tabindex="-1" role="dialog" aria-labelledby="checkModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" >
                    <div class="modal-header">
                        <h3 class="modal-title" id="checkModal">Chi tiết sách: "{{$book->S_TEN}}"</h3>
                    </div>
                    <div class="modal-body" style="height: 400px; overflow-y: auto;">
                        <div class="table-responsive ">
                            <table class="table table-bordered table-hover">
                                <colgroup style="width: 20%"></colgroup>
                                <tbody>
                                <tr>
                                    <th>Tác giả</th>
                                    @if(isset($authors) or isset($translators))
                                        <td>
                                            @foreach($authors as $author)
                                                {{$author->TG_TEN}} <br>
                                            @endforeach
                                            @foreach($translators as $translator)
                                                {{$translator->TG_TEN}} <br>
                                            @endforeach
                                        </td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>Người dịch</th>
                                    @if(isset($translators[0]))
                                        <td>{{$translators[0]->pivot->DICHGIA}}</td>
                                    @else
                                        <td>Không có</td>
                                    @endif
                                </tr>
                                @if(isset($book->S_SLTON))
                                    <tr>
                                        <th>SL tồn</th>
                                        <td>{{$book->S_SLTON}}</td>
                                    </tr>
                                @endif
                                @if(isset($book->S_KICHTHUOC))
                                    <tr>
                                        <th>Kích thước</th>
                                        <td>{{$book->S_KICHTHUOC}}</td>
                                    </tr>
                                @endif
                                @if(isset($book->S_SOTRANG))
                                    <tr>
                                        <th>Số trang</th>
                                        <td>{{$book->S_SOTRANG}}</td>
                                    </tr>
                                @endif
                                @if(isset($book->S_NGAYXB))
                                    <tr>
                                        <th>Ngày XB</th>
                                        <td><?php $date=date_create($book->S_NGAYXB); ?>
                                            {{date_format($date,"d/m/Y") }}
                                        </td>
                                    </tr>
                                @endif
                                @if(isset($book->S_TAIBAN))
                                    <tr>
                                        <th>Tái bản</th>
                                        <td>{{$book->S_TAIBAN}}</td>
                                    </tr>
                                @endif
                                @if(isset($book->S_LUOTXEM))
                                    <tr>
                                        <th>Lượt xem</th>
                                        <td>{{$book->S_LUOTXEM}}</td>
                                    </tr>
                                @endif
                                @if(isset($book->S_GIOITHIEU))
                                    <tr>
                                        <th>Giới thiệu</th>
                                        <td style="text-align: justify">{{$book->S_GIOITHIEU}}</td>
                                    </tr>
                                @endif
                                @if(isset($book->S_GIA))
                                    <tr>
                                        <th>Giá</th>
                                        <td>{{number_format($book->S_GIA)}}</td>
                                    </tr>
                                @endif
                                @if(isset($promotion))
                                    <tr>
                                        <th>Khuyến mãi</th>
                                        <td>{{$promotion->KM_GIAM}} - {{$promotion->KM_CHITIET}}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>NXB</th>
                                    <td>{{$publisher->NXB_TEN}}</td>
                                </tr>
                                <tr>
                                    <th>Loại bìa</th>
                                    <td>{{$cover_type->LB_TEN}}</td>
                                </tr>
                                <tr>
                                    <th>Loại sách</th>
                                    <td>{{$kind_of_book->LS_TEN}}</td>
                                </tr>
                                <tr>
                                    <th>Hình ảnh</th>
                                    <td>
                                        <img src="images/avatar/{{$book->S_AVATAR}}" width="20%" height="30%">
                                        @if(isset($images))
                                            @foreach($images as $image)
                                                <img src="images/{{$image->HA_URL}}" width="30%" height="30%">
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <script>

    </script>
@endsection
