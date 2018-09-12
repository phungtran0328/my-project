<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 08/29/2018
 * Time: 10:14 AM
 */
?>
<div id="header">
    <div class="header-top">
        <div class="container">
            <div class="pull-left auto-width-left">
                <ul class="top-menu menu-beta l-inline">
                    <li><a href=""><i class="fa fa-mail-forward"></i> info@gmail.com </a></li>
                    <li><a href=""><i class="fa fa-phone"></i> 1900121212 </a></li>
                </ul>
            </div>
            <div class="pull-right auto-width-right">
                <ul class="top-details menu-beta l-inline">
                    @if (Auth::guard('customer')->check())
                        <li><a href=""><i class="fa fa-user"></i>{{Auth::guard('customer')->user()->KH_TEN}}</a></li>
                        <li><a href="{{url('/logout')}}">
                                {{ csrf_field() }}
                                <i class="fa fa-sign-out"></i>Đăng xuất</a></li>
                    @else

                    <li>
                        {{--<a href="#" data-toggle="modal" data-target="#login-modal" id="open">--}}
                            {{--<i class="fa fa fa-user" aria-hidden="true"></i>Tài khoản</a>--}}
                        <a href="{{url('/login')}}"><i class="fa fa-sign-in"></i>Đăng nhập</a>

                    </li>
                    <li><a href="{{url('/register')}}"><i class="fa fa-user"></i>Tạo tài khoản</a></li>
                    {{--@include('page.login_popup')--}}
                    @endif
                </ul>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-top -->
    <div class="header-body">
        <div class="container beta-relative" >
            <div class="pull-left">
                <a href="{{url('/index')}}" id="logo"><img src="images/bookstore-logo.jpg" width="200px" alt=""></a>
            </div>
            <div class="pull-right beta-components space-left ov">
                <div class="space10">&nbsp;</div>
                <div class="beta-comp">
                    <form role="search" method="get" id="searchform" action="/">
                        <input class="form-control" type="text" value="" name="key" id="s" placeholder="Tìm sách..." />
                        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
                    </form>
                </div>

                <div class="beta-comp">
                    <div class="cart">
                        <div class="beta-select"><i class="fa fa-shopping-cart"></i> Giỏ hàng (Trống) <i class="fa fa-chevron-down"></i></div>
                        <div class="beta-dropdown cart-body">
                            <div class="cart-item">
                                <div class="media">
                                    <a class="pull-left" href="#"><img src="source/assets/dest/images/products/cart/1.png" alt=""></a>
                                    <div class="media-body">
                                        <span class="cart-item-title">Sample Woman Top</span>
                                        <span class="cart-item-options">Size: XS; Colar: Navy</span>
                                        <span class="cart-item-amount">1*<span>$49.50</span></span>
                                    </div>
                                </div>
                            </div>

                            <div class="cart-item">
                                <div class="media">
                                    <a class="pull-left" href="#"><img src="source/assets/dest/images/products/cart/2.png" alt=""></a>
                                    <div class="media-body">
                                        <span class="cart-item-title">Sample Woman Top</span>
                                        <span class="cart-item-options">Size: XS; Colar: Navy</span>
                                        <span class="cart-item-amount">1*<span>$49.50</span></span>
                                    </div>
                                </div>
                            </div>

                            <div class="cart-item">
                                <div class="media">
                                    <a class="pull-left" href="#"><img src="source/assets/dest/images/products/cart/3.png" alt=""></a>
                                    <div class="media-body">
                                        <span class="cart-item-title">Sample Woman Top</span>
                                        <span class="cart-item-options">Size: XS; Colar: Navy</span>
                                        <span class="cart-item-amount">1*<span>$49.50</span></span>
                                    </div>
                                </div>
                            </div>

                            <div class="cart-caption">
                                <div class="cart-total text-right">Tổng tiền: <span class="cart-total-value">$34.55</span></div>
                                <div class="clearfix"></div>

                                <div class="center">
                                    <div class="space10">&nbsp;</div>
                                    <a href="checkout.html" class="beta-btn primary text-center">Đặt hàng <i class="fa fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div> <!-- .cart -->
                </div>
            </div>

        </div> <!-- .container -->
    </div> <!-- .header-body -->
</div> <!-- #header -->
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <div class="dropdown">
                <a href="#" id="myDrop" class="dropdown-toggle btn btn-block"
                   style="font-size: medium; text-align: center; background: gray; color: white; "
                   data-toggle="dropdown">Danh mục sách</a>
                <ul class="dropdown-menu" style="width: 360px;" role="menu" aria-labelledby="drop3">
                    @foreach($categories as $category)
                        <li><a tabindex="-1" href="{{url('/category',$category->LS_MA)}}" class="" style="font-size: 17px; color: black; border: none"
                           onmouseover="tagActive(this)" onmouseout="tagDisable(this)">{{$category->LS_TEN}}</a></li>
                    @endforeach
                </ul>

                {{--<a class="list-group-item" style="font-size: medium; text-align: center; background: gray; color: white; border: none">Danh mục sách</a>--}}

            </div>
        </div>
        <div class="col-sm-8">
            <div class="list-group">
                <a class="list-group-item" style="border: none">Daily Deals</a>
            </div>
        </div>
    </div>
    <hr>
</div>
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


