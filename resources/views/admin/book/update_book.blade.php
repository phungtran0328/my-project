<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 09/29/2018
 * Time: 9:50 AM
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
            <div class="col-md-12">
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
                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#bookAuthorUpdate">
                                    <span class="glyphicon glyphicon-pencil"> Tác giả</span>
                                </button>
                                {{--modal update book_author--}}
                                <div class="modal fade" id="bookAuthorUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel">Cập nhật tác giả cho sách: "{{$book->S_TEN}}"</h4>
                                            </div>
                                            <div class="modal-body">
                                                @if(!isset($temps_trans[0]->pivot->DICHGIA))
                                                    <form action="{{url('/admin/book/author',$book->S_MA)}}" method="post">
                                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                        <input type="hidden" name="id" value="{{$book->S_MA}}">
                                                        @method('PATCH')
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
                                                        <input type="hidden" name="id" value="{{$book->S_MA}}">
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
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--end model update book_author--}}
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#bookImageUpdate">
                                    <span class="glyphicon glyphicon-pencil"> Hình ảnh</span>
                                </button>
                                {{--modal update book_image--}}
                                <div class="modal fade" id="bookImageUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel">Cập nhật hình ảnh cho sách: "{{$book->S_TEN}}"</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{url('/admin/book/image',$book->S_MA)}}" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                    <input type="hidden" name="id" value="{{$book->S_MA}}">
                                                    @method('PATCH')
                                                    <div class="form-group">
                                                        <label class="control-label">Hình hiện tại:  </label>
                                                        <?php
                                                        $temp_book_image = \App\Book::where('S_MA', $book->S_MA)->first();
                                                        $images = $temp_book_image->image()->get();
                                                        ?>
                                                        @if(isset($images))
                                                            @foreach($images as $image)
                                                                <img src="images/{{$image->HA_URL}}" height="50px" width="50px">
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="form-group {{$errors->has('images') ? 'has-error' : ''}}">
                                                        <label class="control-label">Hình ảnh</label>
                                                        {{--name="images[]" lưu nhiều record cùng lúc--}}
                                                        <input required type="file" class="form-control" name="images[]" multiple>
                                                        <strong style="color: red">{{$errors->first('images')}}</strong>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <button class="btn btn-primary btn-block">Cập nhật hình ảnh</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--end modal update book_image--}}
                            </div>
                        </div>
                        <br>
                        @if(Session::has('messUpdateBookError'))
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messUpdateBookError')}}
                            </div>
                        @endif
                        @if(Session::has('messUpdateAuthor'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messUpdateAuthor')}}
                            </div>
                        @endif
                        @if(Session::has('messUpdateTranslator'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messUpdateTranslator')}}
                            </div>
                        @endif
                        @if(Session::has('messUpdateImage'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Session::get('messUpdateImage')}}
                            </div>
                        @endif
                        <form action="{{url('/admin/book',$book->S_MA)}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            @method('PATCH')
                            <div class="row">
                                <div class="col-md-4 form-group {{$errors->has('name') ? 'has-error' : ''}}" >
                                    <label class="control-label">Tên sách</label>
                                    <input type="text" class="form-control" name="name" value="{{$book->S_TEN}}">
                                    <strong style="color: red">{{$errors->first('name')}}</strong>
                                </div>
                                <div class="col-md-3 form-group {{$errors->has('kindOfBook') ? 'has-error' : ''}}">
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
                                <div class="col-md-3 form-group {{$errors->has('coverType') ? 'has-error' : ''}}">
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
                                <div class="form-group col-md-2" >
                                    <label class="control-label">Số trang</label>
                                    <input type="number" min="0" class="form-control" value="{{$book->S_SOTRANG}}" name="page_num" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group {{$errors->has('publisher') ? 'has-error' : ''}}">
                                    <label class="control-label">Nhà xuất bản</label>
                                    <select class="form-control" name="publisher">
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
                                <div class="col-md-3 form-group {{$errors->has('publish_date') ? 'has-error' : ''}}">
                                    <label class="control-label" >Ngày xuất bản</label>
                                    <input type="date" class="form-control" value="{{$book->S_NGAYXB}}" name="publish_date" >
                                    <strong style="color: red">{{$errors->first('publish_date')}}</strong>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label" >Kích thước</label>
                                    <input type="text" class="form-control" value="{{$book->S_KICHTHUOC}}" name="size" >
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="control-label" >Tái bản</label>
                                    <input type="text" class="form-control" value="{{$book->S_TAIBAN}}" name="republish" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="control-label">Khuyến mãi</label>
                                    <select class="form-control" name="promotion">
                                        <option value="">---Chọn khuyến mãi---</option>
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
                                <div class="form-group col-md-4">
                                    <label class="control-label">Avatar</label>
                                    <input type="file" name="avatar" class="form-control">
                                </div>
                            </div>
                            <div class="form-group" >
                                <label class="control-label">Giới thiệu sách</label>
                                <textarea class="form-control" name="description" rows="10">{{$book->S_GIOITHIEU}}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
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
