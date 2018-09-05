<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 08/30/2018
 * Time: 10:13 AM
 */
?>
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{--<div class="alert alert-danger" style="display:none"></div>--}}

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Đăng nhập</h3>
            </div>

            <div class="modal-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                        {{$errors->has('email')? 'has-error': ''}}
                    </div>
                @endif
                @if (Session::has('message'))
                    <div class="alert alert-warning">{{ Session::get('message') }}</div>
                @endif
                <form action="{{url('/login')}}"  method="POST" class="form-horizontal" id="form">
                    {{ csrf_field() }}

                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label required" for="txtMail"><strong>Email (*)</strong></label>
                        <div class="col-md-7">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Nhập Email" required>

                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label required" for="txtPass"><strong>Mật khẩu (*)</strong></label>
                        <div class="col-md-7">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu từ 6 đến 32 ký tự" >

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3"></div>
                        <div class="col-md-7">
                            <input type="submit" name="login" id="login" class="btn btn-primary btn-block" value="Đăng nhập">
                        </div>
                    </div>
                </form>
            </div>
            {{--<div class="modal-footer"></div>--}}
        </div>
    </div>
</div>


@if (Session::has('message'))
    <script>  $('#login-modal').modal({show: 'true'}); </script>
@endif
@if(count($errors)>0)
<script type="text/javascript">
    $(document).ready(function(){
        $('#login-modal').modal({ show : true  });
    });
</script>
@endif



