@extends('layouts/customer');
<link href="{{ asset('user/css/import/checkout_log.css') }}" rel="stylesheet" type="text/css" />
@section('content')
    {{ session('id') }}
    <div id="wrapper" class="wp-inner clearfix">
        <div class="login-form">
            <form action="" id="form-login">
                <h1 class="form-heading">Đăng nhập</h1>
                <div class="form-group">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input type="text" name="username" class="form-input" placeholder="Tên đăng nhập">
                </div>
                <div class="form-group">
                    <i class="fa fa-key" aria-hidden="true"></i>
                    <input type="password" name="password" class="form-input" placeholder="Mật khẩu">
                    <div id="eye">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </div>
                </div>
                <span>
                    <input type="checkbox" class="checkbox">
                    Ghi nhớ mật khẩu
                </span>
                <input type="submit" value="Đăng nhập" class="form-submit">
            </form>
        </div>
        <div class="or">OR</div>

        <div class="reg-form">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('user.add') }}" method="post" id="form-login">
                @csrf
                <h1 class="form-heading">Đăng kí</h1>
                <div class="form-group">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input type="text" name="customer_name" class="form-input" placeholder="Tên đăng nhập">

                </div>
                @error('customer_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="form-group">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <input type="email" name="customer_email" placeholder="Email" class="form-input" />
                </div>
                @error('customer_email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="form-group">
                    <i class="fa fa-key" aria-hidden="true"></i>
                    <input type="password" name="customer_pass" class="form-input" placeholder="Mật khẩu">
                    <div id="eye1">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </div>
                </div>
                @error('customer_pass')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="form-group">
                    <i class="fa fa-key" aria-hidden="true"></i>
                    <input type="password" name="comfirm_password" class="form-input" placeholder="Xác nhận mật khẩu">
                    <div id="eye2">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </div>

                </div>
                @error('comfirm_password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="form-group">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <input type="text" name="customer_phone" class="form-input" placeholder="Số điện thoại">

                </div>
                @error('customer_phone')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <input type="submit" name="btn-reg" value="Đăng Ký" class="form-submit">
            </form>

        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('user/js/checkout_login.js') }}"></script>
@endsection
