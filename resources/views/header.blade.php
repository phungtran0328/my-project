<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 08/29/2018
 * Time: 10:14 AM
 */
?>
<div id="header">
    <div class="myNav">
        <nav class="navbar-default" style="margin-bottom: 15px">
            <div class=" container">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="navbar-header">
                            <a class="navbar-brand" style="" href="{{url('/index')}}">Bookstore</a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        {{--<form class="col-md-4 navbar-form navbar-left" role="search" method="get" id="searchform" action="" style="width: 98%">
                            <input class="form-control" type="text" value="" name="key" id="s" placeholder="Tìm sách..." style="width: 100%"/>
                            <button class="btn btn-default" type="submit" id="searchsubmit"><i class="glyphicon glyphicon-search"></i></button>
                        </form>--}}
                        <form class="navbar-form navbar-left typeahead"  method="get" action="{{url('/search_book')}}">
                            <input type="search" class="form-control search-input" name="q" placeholder="Tìm sách theo tên" style="width: 160%">
                            {{--<button class="btn btn-default" type="submit" id="searchsubmit"><i class="glyphicon glyphicon-search"></i></button>--}}
                            <span class="input-group-btn" style="display: none">
                                <button class="btn btn-default-sm" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <ul class="nav navbar-nav navbar-right">
                            @if (Auth::guard('customer')->check())
                                <li class="dropdown">
                                    <a href="#" id="loginDrop" class="dropdown-toggle btn btn-block" data-toggle="dropdown">
                                        <i class="fa fa-user"></i>{{Auth::guard('customer')->user()->KH_TEN}} <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropEdit">
                                        <li>
                                            <a tabindex="-1"
                                               href="{{url('/edit',Auth::guard('customer')->user()->KH_MA)}}">
                                                <i class="fa fa-info"></i> Thông tin tài khoản</a>
                                        </li>

                                        <li><a href="{{url('/logout')}}" tabindex="-1">
                                                <i class="fa fa-sign-out"></i> Đăng xuất</a></li>
                                    </ul>
                                </li>
                            @else
                                <li><a href="{{url('/register')}}" ><span class="glyphicon glyphicon-user"></span> Tạo tài khoản</a></li>
                                <li><a href="{{url('/login')}}" ><span class="glyphicon glyphicon-log-in"></span> Đăng nhập</a></li>
                            @endif
                            <li><a href="{{url('/cart')}}" ><span class="glyphicon glyphicon-shopping-cart"></span>
                                    Giỏ hàng <span class="badge">{{Cart::instance('default')->count(false)}}</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="dropdown" style="">
                        <a href="#" id="myDrop" class="dropdown-toggle list-group-item"
                           style="font-size: medium; text-align: center; background-color: gray; color: white; "
                           data-toggle="dropdown">Danh mục sách</a>
                        <ul class="dropdown-menu" id="menuDrop" style=" width: 100%" role="menu" aria-labelledby="drop3">
                            @foreach($categories as $category)
                                <li><a tabindex="-1" href="{{url('/category',$category->LS_MA)}}" class="list-group-item" style="font-size: 17px; color: black; border: none; margin-bottom: 5px"
                                       onmouseover="tagActive(this)" onmouseout="tagDisable(this)">{{$category->LS_TEN}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dropdown" style="">
                        <a href="#" id="myDrop" class="dropdown-toggle list-group-item"
                           style="font-size: medium; text-align: center; background-color: gray; color: white; "
                           data-toggle="dropdown">Top sách nổi bật <span class="caret"></span></a>
                        <ul class="dropdown-menu" id="menuDrop" style=" width: 100%" role="menu" aria-labelledby="drop3">
                            <li><a tabindex="-1" href="{{route('sell')}}" class="">Top 10 sách bán chạy nhất</a></li>
                            <li><a tabindex="-1" href="{{route('sell/kindOfBook')}}" class="">Top 10 sách văn học bán chạy</a></li>
                            <li><a tabindex="-1" href="{{route('sell/kindOfBookEconomic')}}" class="">Top 10 sách kinh tế bán chạy</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<br>


<script>
    function tagActive(x) {
        x.style.background='#0277b8';
        x.style.color='#fff';
    }
    function tagDisable(x) {
        x.style.background='white';
        x.style.color='black';
    }
</script>




