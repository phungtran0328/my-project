<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 11/09/2018
 * Time: 10:15 AM
 */
?>
@extends('master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive ">
                    <table class="table table-bordered table-hover">
                        <tbody>
                        @php $i = 1; @endphp

                        @foreach($dataSum as $item)
                            @if($i<11)
                                @php
                                    $temp = new \App\Book();
                                    $book = $temp->getBookPromotion($item['id']);
                                @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td><img src="images/{{$book['image']}}" width="50px" height="50px"></td>
                                <td>
                                    {{$book['name']}} <br><br>
                                    Giá bìa: {{$book['price']}}
                                </td>
                                <td></td>
                            </tr>
                                @else @break;
                            @endif
                            @php $i++; @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
