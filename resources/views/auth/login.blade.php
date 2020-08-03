@extends('layouts.app')

@section('content')
    <div class="login-form">
        <div class="login-form-wrapper">
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
                        <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" placeholder="Email or Username" autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" autocomplete="current-password">
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
            </div>
        </div>
    </div>
@endsection
