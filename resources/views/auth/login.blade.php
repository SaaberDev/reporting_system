@extends('layouts.app')

@section('content')
    <div class="login-form">
        <div class="login-form-wrapper">
            <div class="login-form-wrap text-white" style="text-align: center;padding: 20px;">
                <div class="login-form-wrap text-black-50 font-weight-bold" style="width: 100%;background: rgb(255 255 255 / 92%);padding: 15px;margin: auto;">
                    <p style="margin: 0;font-size: 18px;color: black;">
                        This is a vulnerability reporting system. Where user will be able to submit data to check if their site is secured.
                        Company will then manually check and inform user if any vulnerability found and provide it's solution.
                        Only Admin will create user and send credentials manually.
                    </p>
                </div>

                <button class="form-btn" id="admin" style="display: inline-block;margin-bottom: 0;">ADMIN</button>
                <button class="form-btn" id="user" style="display: inline-block;margin-bottom: 0;">USER</button>

            </div>
            <div class="login-form-wrap">
                <form action="{{ route('login') }}" method="POST" class="form">
                    @csrf @method('POST')
                    <span class="form-title">
                        Reporting Panel
                    </span>
                    <span class="form-title">
                        <img src="{{ asset('admin_panel/assets/img/logo/logo.png') }}" alt="">
                    </span>
                    <div class="form-input">
                        <label></label>
                        <input type="text" id="mail" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" placeholder="Email" autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label></label>
                        <input type="password" id="pass" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="submit" class="form-btn">
                        Login
                    </button>
                </form>
                <button onclick="location.href='{{ route('password.request') }}'" class="form-btn">Reset Password</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $("#admin").click(function () {
            $("#mail").val("admin@demo.com");
            $("#pass").val("1234");
        });

        $("#user").click(function () {
            $("#mail").val("user@demo.com");
            $("#pass").val("1234");
        });
    </script>
@endpush
