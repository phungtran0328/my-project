<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 09/15/2018
 * Time: 1:22 PM
 */
?>
@extends('master')
@section('content')
<div class="container">
    <ul class="breadcrumb">
        <li><a href="{{url('/index')}}">Trang chủ</a></li>
        <li><a href="{{url('/category',$kind_of_book->LS_MA)}}">{{$kind_of_book->LS_TEN}}</a></li>
        <li class="active">{{$book->S_TEN}}</li>
    </ul>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(session('messAdd'))
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{session('messAdd')}}
                </div>
            @endif
                @if(session('message'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{session('message')}}
                    </div>
                @endif

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-sm-2">
                            <a id="myImgSmall">
                                <img src="images/avatar/{{$book->S_AVATAR}}" class="thumbnail" onclick="clickImg(this)">
                                @if(count($images)>0)
                                    @foreach($images as $image)
                                        <img src="images/{{$image->HA_URL}}" onclick="clickImg(this)" class="thumbnail">
                                    @endforeach
                                @endif
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="text-center" id="myImg" style="margin-bottom: 10px; height: 65%">
                                <img src="images/avatar/{{$book->S_AVATAR}}" class="img-rounded zoom" alt="" width="auto" height="auto">
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-6">
                            <div>
                                <h3>{{$book->S_TEN}}</h3>
                                @if((count($authors)>0) or (count($translators)>0))
                                    <p style="margin-bottom: 10px; margin-top: 10px;">Tác giả:
                                        @foreach($authors as $author)
                                            {{$author->TG_TEN}} <br>
                                        @endforeach
                                        @foreach($translators as $translator)
                                            {{$translator->TG_TEN}} <br>
                                        @endforeach
                                    </p>
                                @else
                                    <p style="margin-bottom: 10px; margin-top: 10px;">Chưa cập nhật tác giả</p>
                                @endif
                            </div>
                            <hr>
                            <div>
                                <div style="margin-bottom: 20px;">
                                    @if(isset($temps['sale']))
                                        <span class="flash-del" style="font-size: 18px">{{number_format($temps['price'])}} đ</span>
                                        <span class="flash-sale" style="font-size: 18px">{{number_format($temps['sale'])}} đ</span>
                                    @else
                                        <span style="color: #9f191f; font-size: 18px;">{{number_format($temps['price'])}} đ</span>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-8">
                                    <form action="{{url('/cart')}}" method="post" onsubmit="return qtyValidate()">
                                        <p style="margin-bottom: 10px">Số lượng:</p>
                                        @if($book->S_SLTON>0)
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input type="hidden" name="id" value="{{ $book->S_MA }}">
                                            <input type="hidden" name="name" value="{{ $book->S_TEN}}">
                                            <input value="{{isset($temps['sale']) ? $temps['sale'] : $temps['price']}}" type="hidden" name="price">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <input class="btn btn-default btn-group" style="width: 30px; margin-right: -4px; border-radius: 0" onclick="qtyDecrement(this)"
                                                       value=" - " type="button">
                                                <input type="text" class="btn-group" style="width: 40px" value="1" id="qty" name="qty">
                                                <input class="btn btn-default btn-group" style="width: 30px;margin-left: -5px; border-radius: 0 " onclick="qtyIncrement(this)"
                                                       value=" + " type="button">
                                                <br>
                                                <strong style="color: red;">{{$errors->first('qty')}}</strong>
                                            </div>
                                            <div class="col-md-6">
                                                <button class="btn btn-primary" type="submit">
                                                    <span class="fa fa-shopping-cart" style="font-size: 20px"></span> Thêm vào giỏ hàng</button>
                                            </div>

                                        </div>
                                        @else
                                            <input class="btn btn-default btn-group" style="width: 30px; margin-right: -4px; border-radius: 0"
                                                   value=" - " type="button" disabled>
                                            <input type="text" class="btn-group" style="width: 40px" value="0" disabled>
                                            <input class="btn btn-default btn-group" style="width: 30px;margin-left: -5px; border-radius: 0 "
                                                   value=" + " type="button" disabled>
                                            <button class="btn btn-success" style="margin-left: 50px" disabled>
                                                <span class="" style="font-size: 20px"></span> Đã hết hàng</button>
                                        @endif
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--Thông tin chi tiết sách--}}
        <div class="col-md-9">
            <h5>Thông tin chi tiết</h5>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive ">
                        <table class="table table-bordered table-hover">
                            <colgroup style="width: 25%; "></colgroup>
                            <tbody>
                            @if(isset($company))
                                <tr>
                                    <th>Công ty phát hành</th>
                                    <td>{{$company->CTPH_TEN}}</td>
                                </tr>
                            @endif
                            @if(isset($publisher))
                            <tr>
                                <th>Nhà xuất bản</th>
                                <td>{{$publisher->NXB_TEN}}</td>
                            </tr>
                            @endif
                            @if(isset($authors) or isset($translators))
                            <tr>
                                <th>Tác giả</th>
                                <td>
                                    @foreach($authors as $author)
                                        {{$author->TG_TEN}} <br>
                                    @endforeach
                                    @foreach($translators as $translator)
                                        {{$translator->TG_TEN}} <br>
                                    @endforeach
                                </td>
                            </tr>
                            @if(isset($translators[0]->pivot->DICHGIA))
                                <tr>
                                    <th>Người dịch</th>
                                    <td>{{$translators[0]->pivot->DICHGIA}}</td>
                                </tr>
                            @endif
                            @endif
                            @if(isset($book->S_NGAYXB))
                            <tr>
                                <th>Ngày xuất bản</th>
                                <td><?php $date=date_create($book->S_NGAYXB); ?>
                                    {{date_format($date,"m/Y") }}</td>
                            </tr>
                            @endif
                            @if(isset($cover_type))
                            <tr>
                                <th>Loại bìa</th>
                                <td>{{$cover_type->LB_TEN}}</td>
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{--Giới thiệu sách--}}
        <div class="col-md-9">
            <h5>Giới thiệu sách</h5>
            <div class="panel panel-default">
                <div class="panel-body">
                    <p style="margin-bottom: 10px"><b>{{$book->S_TEN}}</b></p>
                    <textarea style="text-align: justify; border:none">{{$book->S_GIOITHIEU}}</textarea>
                </div>
            </div>
        </div>

        {{--Giới thiệu sách cùng tác giả--}}
        <div class="col-md-12">
            <h5>Sách cùng tác giả</h5>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        @if(count($authors)>0)
                            <?php
                            $temps=App\Author::where('TG_MA',$authors[0]->TG_MA)->first();
                            //Lấy tập hợp book có cùng tác giả
                            $temp_author=$temps->book()->get();
                            $temp_author_book_promotion = array();
                            $i = 0;
                            if ($i<6){
                                foreach ($temp_author as $item){
                                    //Lấy mảng book với điều kiện book khác book đang xem chi tiết
                                    if ($item->S_MA <> $book->S_MA){
                                        $temp_author_book = new \App\Book();
                                        $temp_author_book_promotion[$i] = $temp_author_book->getBookPromotion($item->S_MA);
                                        $i++;
                                    }
                                }
                            }
                            ?>
                            @for($j=0; $j<count($temp_author_book_promotion); $j++)
                                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                    <div style="margin-bottom: 20px; border: 1px solid #dddddd">
                                        <div class="single-item">
                                            <div class="single-item-header text-center">
                                                <a href="{{url('/chi-tiet-sach',$temp_author_book_promotion[$j]['id'])}}">
                                                    <img src="images/avatar/{{$temp_author_book_promotion[$j]['image']}}" width="90%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="single-item-body text-center">
                                            <a href="{{url('/chi-tiet-sach',$temp_author_book_promotion[$j]['id'])}}" class="single-item-title" >
                                                {{ str_limit($temp_author_book_promotion[$j]['name'], $limit = 18, $end = '...') }}
                                            </a>
                                            <p class="single-item-price" >
                                                @if(isset($temp_author_book_promotion[$j]['sale']))
                                                    <span class="flash-del">{{number_format($temp_author_book_promotion[$j]['price'])}} đ</span>
                                                    <span class="flash-sale">{{number_format($temp_author_book_promotion[$j]['sale'])}} đ</span>
                                                @else
                                                    <span>{{number_format($temp_author_book_promotion[$j]['price'])}} đ</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        @endif
                        @if(count($translators)>0)
                            <?php
                                $temps=App\Author::where('TG_MA',$translators[0]->TG_MA)->first();
                                //Lấy tập hợp book có cùng tác giả
                                $temp_translator = $temps->translate_book()->get();
                                $temp_translator_book_promotion = array();
                                $i = 0;
                                if ($i<6){
                                    foreach ($temp_translator as $item){
                                        //Lấy mảng book với điều kiện book khác book đang xem chi tiết
                                        if ($item->S_MA <> $book->S_MA){
                                            $temp_translator_book = new \App\Book();
                                            $temp_translator_book_promotion[$i] = $temp_translator_book->getBookPromotion($item->S_MA);
                                            $i++;
                                        }
                                    }
                                }
                            ?>
                            @for($j=0; $j<count($temp_translator_book_promotion); $j++)
                                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                    <div style="margin-bottom: 20px; border: 1px solid #dddddd">
                                        <div class="single-item">
                                            <div class="single-item-header text-center">
                                                <a href="{{url('/chi-tiet-sach',$temp_translator_book_promotion[$j]['id'])}}">
                                                    <img src="images/avatar/{{$temp_translator_book_promotion[$j]['image']}}" width="90%">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="single-item-body text-center">
                                            <a href="{{url('/chi-tiet-sach',$temp_translator_book_promotion[$j]['id'])}}" class="single-item-title" >
                                                {{ str_limit($temp_translator_book_promotion[$j]['name'], $limit = 18, $end = '...') }}
                                            </a>
                                            <p class="single-item-price" >
                                                @if(isset($temp_translator_book_promotion[$j]['sale']))
                                                    <span class="flash-del">{{number_format($temp_translator_book_promotion[$j]['price'])}} đ</span>
                                                    <span class="flash-sale">{{number_format($temp_translator_book_promotion[$j]['sale'])}} đ</span>
                                                @else
                                                    <span>{{number_format($temp_translator_book_promotion[$j]['price'])}} đ</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function clickImg(img) {
        var src = img.src;
        var html = "<img src='"+src+"' class='img-rounded zoom' width='auto' height='auto'>";
        document.getElementById('myImg').innerHTML = html;
    }

    var y = '<?php echo $book->S_SLTON; ?>';
    parseInt(y);
//    console.log(y);

    function qtyValidate() {
        var x = document.getElementById('qty');
//        console.log(x.value);
        if (parseInt(x.value,10)<=0){
            alert('Số lượng mua không nhỏ hơn hoặc bằng 0 !');
            document.getElementById('qty').value = 1;
            return false;
        }
        if (parseInt(x.value,10)>y){
            alert('Không đủ số lượng cung ứng !');
            document.getElementById('qty').value = 1;
            return false;
        }
    }

    function qtyIncrement() {
        var x = parseInt(document.getElementById('qty').value, 10);
        x = isNaN(x) ? 0 : x;
        x++;
        if (x>y){
            alert('Không đủ số lượng cung ứng !');
            x--;
        }
//        console.log(x);
        document.getElementById('qty').value = x;
    }
    function qtyDecrement() {
        var x = parseInt(document.getElementById('qty').value, 10);
        x = isNaN(x) ? 0 : x;
        x--;
        if (x<=0){
            alert('Số lượng mua không nhỏ hơn hoặc bằng 0 !');
            x++;
        }
//        console.log(x);
        document.getElementById('qty').value = x;
    }
</script>
