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
                <li><a href="{{url('/admin/setting',Auth::user()->NV_MA)}}"><i class="fa fa-gear fa-fw"></i> Đổi mật khẩu</a>
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
                    <form class="input-group custom-search-form" action="{{url('admin/search')}}" method="get">
                        <input type="text" min="3" class="form-control" placeholder="Tìm kiếm..." name="q">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </form>
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
                        <li>
                            <a href="{{url('admin/slider')}}">Sliders</a>
                        </li>
                        <li>
                            <a href="{{url('admin/contact')}}">Contacts</a>
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
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>