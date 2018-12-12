<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 12/12/2018
 * Time: 9:32 AM
 */?>
        <!DOCTYPE html>
<html>
<head>
    <title>Xác nhân đơn hàng</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div>
            <div class="col-md-12">
                <h2>Xác nhận đơn hàng #{{$temp_order->DH_MA}}</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h3>Khách hàng</h3>
                            <p>Tên: {{$temp_customer->KH_TEN}}</p>
                            <p>Địa chỉ: {{$temp_customer->fulladdress}}</p>
                            <p>Số ĐT: {{$temp_customer->KH_SDT}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Sách</th>
                                    <th>SL</th>
                                    <th>Giá</th>
                                    <th>Giảm</th>
                                    <th>Thành tiền</th>
                                </tr>
                                </thead>
                                <tbody>
                                @for($i=0; $i<count($data);$i++)
                                    <tr>
                                        <td>{{$data[$i]['name']}}</td>
                                        <td>{{$data[$i]['qty']}}</td>
                                        <td>{{number_format($data[$i]['price'])}} đ</td>
                                        <td>{{number_format($data[$i]['sale'])}} đ</td>
                                        <td>{{number_format($data[$i]['plus'])}} đ</td>
                                    </tr>
                                @endfor
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th colspan="3">Tạm tính</th>
                                    <td colspan="2">{{number_format($sum)}} đ</td>
                                </tr>
                                <tr>
                                    <th colspan="3">Phí vận chuyển</th>
                                    <td colspan="2">{{number_format($ship)}} đ</td>
                                </tr>
                                <tr>
                                    <th colspan="3">Tổng cổng</th>
                                    <td colspan="2">{{number_format($total)}} đ</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
