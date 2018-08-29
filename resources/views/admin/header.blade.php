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
                    {{--@if (Auth::guard('admin')->check())--}}
                    {{----}}
                        {{--<li><a href=""><i class="fa fa-user">{{Auth::guard('admin')->user()->NV_TEN}}</i></a></li>-->--}}
                        {{--<li><a href="{{url('/admin/logout')}}">Đăng xuất</a></li>-->--}}
                    {{--@endif--}}
                </ul>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
            </div> <!-- .header-top -->
            <div class="header-body">
                <div class="container beta-relative">
                    <div class="pull-left">
                        <a href="{{ url('/admin') }}" id="logo"><img src="source/assets/dest/images/bookstore-logo.jpg" width="200px" alt=""></a>
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
                                <li><a href="{{ url('/admin')}}">Trang chủ</a></li>
                                <li><a href="#">Quản lý sách</a></li>
                                <li><a href="">Quản lý đơn hàng</a></li>

                                <li><a href="#">Quản lý nhập sách</a></li>

                                <li><a href="">Quản lý góp ý - liên hệ</a></li>
                                <li><a href="">Báo cáo - thống kê</a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </nav>
                    </div> <!-- .container -->
                </div> <!-- .header-bottom -->
            </div> <!-- #header -->

