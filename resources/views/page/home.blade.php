<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 08/29/2018
 * Time: 10:07 AM
 */
?>
@extends('master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <div class="list-group">
                <a class="list-group-item" style="font-size: medium; text-align: center; background: gray; color: white; border: none">Danh mục sách</a>
                @foreach($categories as $category)
                <a href="{{url('/category',$category->LS_MA)}}" class="list-group-item" style="font-size: 15px; color: black; border: none"
                   onmouseover="tagActive(this)" onmouseout="tagDisable(this)">{{$category->LS_TEN}}</a>
                @endforeach
            </div>
        </div>
        <div class="col-sm-8">
            <div class="list-group">
                <a class="list-group-item" style="border: none">Daily Deals</a>

                <div id="myCarousel" class="carousel slide" data-ride="carousel" style="height: 410px">
                    <!-- Indicators -->
                    <?php $total=count($sliders); ?>
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        @for($i=1; $i<$total;$i++)
                            <li data-target="#myCarousel" data-slide-to="{{$i}}"></li>

                        @endfor
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">

                        <div class="item active">
                            <img src="images/{{$sliders[0]->slider}}" alt="Image" style="width: 800px; height: 410px">
                            <div class="carousel-caption">
                                <h3>Sell $</h3>
                                <p>Money Money.</p>
                            </div>
                        </div>
                        @for($i=1;$i<$total;$i++)
                            <div class="item">
                                <img src="images/{{$sliders[$i]->slider}}" alt="Image" style="width: 800px; height: 410px">
                                <div class="carousel-caption">
                                    <h3>More Sell $</h3>
                                    <p>Lorem ipsum...</p>
                                </div>
                            </div>
                        @endfor
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <hr>
</div>

<div class="container text-left">
    <div id="content" class="space-top-none">
        <div class="main-content">
            {{--<div class="space60">&nbsp;</div>--}}
            <div class="row">
                <div class="col-sm-12">
                    <div class="beta-products-list">
                        <h4>New Products</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">438 styles found</p>
                            <div class="clearfix"></div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="single-item">
                                    <div class="single-item-header">
                                        <a href="product.html"><img src="source/assets/dest/images/products/1.jpg" alt=""></a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">Sample Woman Top</p>
                                        <p class="single-item-price">
                                            <span>$34.55</span>
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="single-item">
                                    <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>

                                    <div class="single-item-header">
                                        <a href="product.html"><img src="source/assets/dest/images/products/2.jpg" alt=""></a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">Sample Woman Top</p>
                                        <p class="single-item-price">
                                            <span class="flash-del">$34.55</span>
                                            <span class="flash-sale">$33.55</span>
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="single-item">
                                    <div class="single-item-header">
                                        <a href="product.html"><img src="source/assets/dest/images/products/3.jpg" alt=""></a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">Sample Woman Top</p>
                                        <p class="single-item-price">
                                            <span>$34.55</span>
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="single-item">
                                    <div class="single-item-header">
                                        <a href="product.html"><img src="source/assets/dest/images/products/3.jpg" alt=""></a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">Sample Woman Top</p>
                                        <p class="single-item-price">
                                            <span>$34.55</span>
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- .beta-products-list -->

                    <div class="space50">&nbsp;</div>

                    <div class="beta-products-list">
                        <h4>Top Products</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">438 styles found</p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="single-item">
                                    <div class="single-item-header">
                                        <a href="product.html"><img src="source/assets/dest/images/products/1.jpg" alt=""></a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">Sample Woman Top</p>
                                        <p class="single-item-price">
                                            <span>$34.55</span>
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="single-item">
                                    <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>

                                    <div class="single-item-header">
                                        <a href="product.html"><img src="source/assets/dest/images/products/2.jpg" alt=""></a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">Sample Woman Top</p>
                                        <p class="single-item-price">
                                            <span class="flash-del">$34.55</span>
                                            <span class="flash-sale">$33.55</span>
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="single-item">
                                    <div class="single-item-header">
                                        <a href="product.html"><img src="source/assets/dest/images/products/3.jpg" alt=""></a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">Sample Woman Top</p>
                                        <p class="single-item-price">
                                            <span>$34.55</span>
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="single-item">
                                    <div class="single-item-header">
                                        <a href="product.html"><img src="source/assets/dest/images/products/3.jpg" alt=""></a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">Sample Woman Top</p>
                                        <p class="single-item-price">
                                            <span>$34.55</span>
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="space40">&nbsp;</div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="single-item">
                                    <div class="single-item-header">
                                        <a href="product.html"><img src="source/assets/dest/images/products/1.jpg" alt=""></a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">Sample Woman Top</p>
                                        <p class="single-item-price">
                                            <span>$34.55</span>
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="single-item">
                                    <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>

                                    <div class="single-item-header">
                                        <a href="product.html"><img src="source/assets/dest/images/products/2.jpg" alt=""></a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">Sample Woman Top</p>
                                        <p class="single-item-price">
                                            <span class="flash-del">$34.55</span>
                                            <span class="flash-sale">$33.55</span>
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="single-item">
                                    <div class="single-item-header">
                                        <a href="product.html"><img src="source/assets/dest/images/products/3.jpg" alt=""></a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">Sample Woman Top</p>
                                        <p class="single-item-price">
                                            <span>$34.55</span>
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="single-item">
                                    <div class="single-item-header">
                                        <a href="product.html"><img src="source/assets/dest/images/products/3.jpg" alt=""></a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">Sample Woman Top</p>
                                        <p class="single-item-price">
                                            <span>$34.55</span>
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- .beta-products-list -->
                </div>
            </div> <!-- end section with sidebar and main content -->


        </div> <!-- .main-content -->
    </div> <!-- #content -->

</div> <!-- .container -->
@endsection

