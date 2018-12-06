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
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{url('/admin/book')}}">Quản lý sách</a>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2">
                                @can('book.create')
                                    <a href="{{url('/admin/book/create')}}" class="btn btn-primary btn-block">
                                        <span class="glyphicon glyphicon-plus"> Sách</span>
                                    </a>
                                @endcan
                            </div>
                            <div class="col-md-2">
                                <a href="{{url('/admin/book/export')}}" class="btn btn-info btn-block">
                                    <span> Export</span>
                                </a>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-2">
                                <form action="{{url('admin/book')}}" method="get" class="input-group">
                                    <select name="qty" class="form-control">
                                        <option value="">--SLT--</option>
                                        <option value="asc" {{$qty=='asc' ? 'selected' : ''}}> Tăng </option>
                                        <option value="desc" {{$qty=='desc' ? 'selected' : ''}}> Giảm </option>
                                    </select>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default-sm" type="submit">
                                            <i class="fa fa-filter"></i>
                                        </button>
                                    </span>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <form role="search" class="input-group" action="{{url('admin/book')}}" method="get">
                                    <input type="text" class="form-control" name="search" placeholder="Tìm sách theo tên" value="{{$search}}" id="dummy">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default-sm" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </form>
                            </div>
                        </div>
                        <hr>
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
                        <div class="table-responsive ">
                            <table class="table table-bordered table-hover">
                                <thead >
                                <tr>
                                    <th></th>
                                    <th>Tên</th>
                                    <th style="width: 15%">Tác giả</th>
                                    <th style="width: 10%">Người dịch</th>
                                    <th>SLT</th>
                                    <th>Giá</th>
                                    <th>V</th>
                                    <th>Nhà xuất bản</th>
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
                                        <td>{{$index + $books->firstItem()}}</td>
                                        <td>{{$book->S_TEN}}</td>
                                        @if((count($authors)>0) or (count($translators)>0))
                                            <td>
                                                @foreach($authors as $author)
                                                    {{$author->TG_TEN}} <br><br>
                                                @endforeach
                                                @foreach($translators as $translator)
                                                    {{$translator->TG_TEN}} <br><br>
                                                @endforeach
                                            </td>
                                        @endif
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
                                               onclick="return confirm('Hành động này sẽ xóa các dữ liệu liên quan như: tác giả, hình ảnh,... Bạn chắc chắn xóa chứ? ')">
                                                <span class="glyphicon glyphicon-remove"></span></a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$books->render()}}
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
