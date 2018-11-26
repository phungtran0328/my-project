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
                        <h5>Danh sách khuyến mãi</h5>
                    </div>
                    <div class="panel-body">
                        @can('book.create')
                        <button style="width: 15%" class="btn btn-primary" data-toggle="modal" data-target="#promotionCreate">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                        @endcan
                        {{--create promotion--}}
                        <div class="modal fade" id="promotionCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="exampleModalLabel">Thêm mới khuyến mãi</h3>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{url('admin/promotion')}}" method="post">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Giảm giá</label>
                                                        <input class="form-control" name="promotion_create" pattern="[0]+(\.[0-9][0-9][0-9]?)?"
                                                               placeholder="0.000" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Áp dụng</label>
                                                    <input type="datetime" class="form-control" placeholder="yyyy-mm-dd H:i:s"
                                                           name="start_create" id="start_create" required>
                                                    <strong style="color: red"></strong>
                                                </div>
                                                <div class=" form-group col-md-6">
                                                    <label class="control-label">Hạn dùng</label>
                                                    <input type="number" min="1" class="form-control" placeholder="Số ngày áp dụng"
                                                           name="end_create" id="end_create" required>
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
                        @if(session('Add'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{session('Add')}}
                            </div>
                        @endif
                            @if(session('Update'))
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{session('Update')}}
                                </div>
                            @endif
                            @if(session('UpdateBook'))
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{session('UpdateBook')}}
                                </div>
                            @endif
                            @if(session('Remove'))
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{session('Remove')}}
                                </div>
                            @endif
                        @if(session('RemoveError'))
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{session('RemoveError')}}
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
                                    <th style="width: 25%"></th>
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
                                            @can('book.update')
                                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#promotionUpdateBook-{{$promotion->KM_MA}}">
                                                    <span class="glyphicon glyphicon-plus"></span> Thêm sách
                                                </a>
                                                <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#promotionUpdate-{{$promotion->KM_MA}}">
                                                    <span class="glyphicon glyphicon-pencil"></span> Sửa
                                                </a>
                                            @endcan
                                            @can('book.delete')
                                                <a class="btn btn-danger btn-sm" href="{{url('/admin/promotion/delete',$promotion->KM_MA)}}" onclick="return confirm('Bạn chắc chắn xóa ?')">
                                                    <span class="glyphicon glyphicon-remove"></span> Xóa
                                                </a>
                                            @endcan
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

    @foreach($promotions as $promotion)
        {{--update promotion book--}}
        <div class="modal fade" id="promotionUpdate-{{$promotion->KM_MA}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Chỉnh sửa khuyến mãi "{{$promotion->KM_GIAM}}"</h3>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('/admin/promotion', $promotion->KM_MA)}}" method="post" >
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            @method('PATCH')
                            <div class="form-group">
                                <label class="control-label">Giảm %</label>
                                <input pattern="[0]+(\.[0-9][0-9][0-9]?)?" class="form-control" value="{{$promotion->KM_GIAM}}" name="promotion_update" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Áp dụng</label>
                                <input type="datetime" class="form-control" value="{{$promotion->KM_APDUNG}}" name="start_update" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Hạn dùng</label>
                                <input type="number" min="1" class="form-control" value="{{$promotion->KM_HANDUNG}}" name="end_update" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Mô tả chi tiết</label>
                                <input type="text" class="form-control" value="{{$promotion->KM_CHITIET}}" name="description_update">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="promotionUpdateBook-{{$promotion->KM_MA}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Thêm sách cho khuyến mãi "{{$promotion->KM_CHITIET}}"</h3>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('admin/promotion/book',$promotion->KM_MA)}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label class="control-label">Sách</label>
                                <select name="book_id[]" class="form-control" multiple style="height: 200px">
                                    <option value="">---Chọn sách---</option>
                                    @php
                                        $books_in = $promotion->book()->get();
                                        $books = \App\Book::where('KM_MA','<>',$promotion->KM_MA)
                                                            ->orWhere('KM_MA', '=', null)
                                                            ->get();
                                    @endphp
                                    @foreach($books_in as $item)
                                        <option value="{{$item->S_MA}}" selected>{{$item->S_TEN}}</option>
                                    @endforeach
                                    @foreach($books as $book)
                                        <option value="{{$book->S_MA}}">{{$book->S_TEN}}</option>
                                    @endforeach
                                </select>

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
    @endforeach
    <script>
        /*var s, e, dateStart, dateEnd;

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
        }*/
    </script>
@endsection
