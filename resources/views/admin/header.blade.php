<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 08/29/2018
 * Time: 1:39 PM
 */
?>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{url('/admin/index')}}">Bookstore Admin</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            @if (Auth::check())
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="{{url('/admin/profile',Auth::user()->NV_MA)}}"><i class="fa fa-user fa-fw"></i> {{Auth::user()->NV_TEN}}</a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="{{url('/admin/logout')}}"><i class="fa fa-sign-out fa-fw"></i> Đăng xuất</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
            @endif
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                    <!-- /input-group -->
                </li>
                <li>
                    <a href="{{url('admin/index')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-book fa-fw"></i> Quản lý sách<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{url('/admin/book')}}">Sách</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/author')}}">Tác giả</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/publisher')}}">Nhà xuất bản</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/kind-of-book')}}">Thể loại</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/cover-type')}}">Bìa</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/promotion')}}">Khuyến mãi</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>

                <li>
                    <a href="#"><i class="fa fa-edit fa-fw"></i> Quản lý <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{url('admin/customer')}}">Khách hàng </a>
                        </li>
                        <li>
                            <a href="{{url('admin/user')}}">Nhân viên </a>
                        </li>
                        <li>
                            <a href="{{url('admin/role')}}">Quyền </a>
                        </li>
                        <li>
                            <a href="{{url('admin/slider')}}">Sliders</a>
                        </li>
                        <li>
                            <a href="#">Quản lý xuất <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="{{url('admin/order')}}">Đơn hàng</a>
                                </li>
                                <li>
                                    <a href="{{url('admin/invoice')}}">Hóa đơn xuất</a>
                                </li>
                            </ul>
                            <!-- /.nav-third-level -->
                        </li>
                        <li>
                            <a href="#">Quản lý nhập <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="{{url('admin/company')}}">Công ty phát hành</a>
                                </li>
                                <li>
                                    <a href="{{url('admin/invoice-in')}}">Hóa đơn nhập</a>
                                </li>
                            </ul>
                            <!-- /.nav-third-level -->
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="{{url('admin/backup')}}"><i class="fa fa-files-o fa-fw"></i> Sao lưu dữ liệu</a>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i> Cài đặt<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="panels-wells.html">Panels and Wells</a>
                        </li>
                        <li>
                            <a href="buttons.html">Buttons</a>
                        </li>
                        <li>
                            <a href="notifications.html">Notifications</a>
                        </li>
                        <li>
                            <a href="typography.html">Typography</a>
                        </li>
                        <li>
                            <a href="icons.html"> Icons</a>
                        </li>
                        <li>
                            <a href="grid.html">Grid</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>


{{--<div id="header">
    <div class="header-top">
        <div class="container" >
            <div class="pull-left auto-width-left">
                <ul class="top-menu menu-beta l-inline">
                    <li><a href="{{ url('/admin') }}" id="logo"><img src="images/bookstore-logo.jpg" width="50px" height="50px" alt=""></a></li>
                    <li><a href=""><i class="fa fa-mail-forward"></i>info@gmail.com</a></li>
                    <li><a href=""><i class="fa fa-phone"></i>1900121212</a></li>
                </ul>
            </div>
            <div class="pull-right auto-width-right">
                <div class="top-menu menu-beta">
                    @if (Auth::check())
                        <div class="dropdown">
                            <a href="#" id="loginAdminDrop" class="dropdown-toggle btn btn-block" data-toggle="dropdown">
                                <i class="fa fa-user"></i>{{Auth::user()->NV_TEN}} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="adminDrop">
                                <li>
                                    <a tabindex="-1"
                                       href="">
                                        <i class="fa fa-info"></i>Thông tin tài khoản</a>
                                </li>

                                <li><a href="{{url('/admin/logout')}}" tabindex="-1">
                                        <i class="fa fa-sign-out"></i>Đăng xuất</a></li>
                            </ul>
                        </div>
                    @endif

                </div>
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
    </div> <!-- #header -->
    <div class="" >
        <nav class="navbar navbar-default">
            <div class="container">
                <ul class="nav navbar-nav" style="font-size: 15px; ">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Page 1-1</a></li>
                            <li><a href="#">Page 1-2</a></li>
                            <li><a href="#">Page 1-3</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Page 2</a></li>
                    <li><a href="#">Page 3</a></li>
                </ul>
            </div>
        </nav>
        --}}{{--<div class="container">
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
                        --}}{{----}}{{--<li><a onclick="return false;">QL sách</a></li>
                        <li><a onclick="return false;">QL đơn hàng</a></li>
                        <li><a onclick="return false;">QL hóa đơn</a></li>
                        <li><a onclick="return false;">QL nhập sách</a></li>
                        <li><a onclick="return false;">QL khách hàng</a></li>
                        <li><a onclick="return false;">Báo cáo - thống kê</a></li>--}}{{----}}{{--
                    @endif

                </ul>
                <div class="clearfix"></div>
            </nav>
        </div> <!-- .container -->--}}{{--
    </div> <!-- .header-bottom -->
</div>--}}
