<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 08/29/2018
 * Time: 1:39 PM
 */
?>
<div id="header">
    <div class="header-top">
        <div class="container">
            <div class="pull-left auto-width-left">
                <ul class="top-menu menu-beta l-inline">
                    <li><a href=""><i class="fa fa-home"></i> 90-92 Lê Thị Riêng, Bến Thành, Quận 1</a></li>
                    <li><a href=""><i class="fa fa-phone"></i> 0163 296 7751</a></li>
                </ul>
            </div>
            <div class="pull-right auto-width-right">
                <ul class="top-details menu-beta l-inline">
                    @if (Auth::check())

                        <li><a href=""><i class="fa fa-user"></i>{{Auth::user()->NV_TEN}}</a></li>
                        <li><a href="{{url('/admin/logout')}}"><i class="fa fa-sign-out"></i>Đăng xuất</a></li>
                    @endif
                </ul>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-top -->
    <div class="header-body">
        <div class="container beta-relative">
            <div class="pull-left">
                <a href="{{ url('/admin') }}" id="logo"><img src="images/bookstore-logo.jpg" width="200px" alt=""></a>
            </div>
            <div class="pull-right beta-components space-left ov">
                <div class="space10">&nbsp;</div>
                <div class="beta-comp">
                    <form role="search" method="get" id="searchform" action="">
                        <input type="text" value="" name="key" id="s" placeholder="Nhập từ khóa..." />
                        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
                    </form>
                </div>
                <div class="clearfix"></div>
            </div> <!-- .container -->
        </div> <!-- .header-body -->

        <div class="header-bottom" style="background-color: #0277b8;">
            <div class="container">
                <a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
                <div class="visible-xs clearfix"></div>
                <nav class="main-menu">
                    <ul class="l-inline ov">
                        @if(Auth::check() && Auth::user())
                            <li><a href="#">QL sách</a></li>
                            <li><a href="">QL đơn hàng</a></li>
                            <li><a href="">QL hóa đơn</a></li>
                            <li><a href="#">QL nhập sách</a></li>

                        @elseif (Auth::check() && Auth::user()->LTK_MA ==2)
                            <li><a href="#">QL sách</a></li>
                            <li><a href="">QL đơn hàng</a></li>
                            <li><a href="">QL hóa đơn</a></li>
                            <li><a href="#">QL nhập sách</a></li>
                            <li><a href="">QL khách hàng</a></li>
                            <li><a href="">Báo cáo - thống kê</a></li>
                        @else
                            {{--<li><a onclick="return false;">QL sách</a></li>
                            <li><a onclick="return false;">QL đơn hàng</a></li>
                            <li><a onclick="return false;">QL hóa đơn</a></li>
                            <li><a onclick="return false;">QL nhập sách</a></li>
                            <li><a onclick="return false;">QL khách hàng</a></li>
                            <li><a onclick="return false;">Báo cáo - thống kê</a></li>--}}
                        @endif

                    </ul>
                    <div class="clearfix"></div>
                </nav>
            </div> <!-- .container -->
        </div> <!-- .header-bottom -->
    </div> <!-- #header -->
</div>
