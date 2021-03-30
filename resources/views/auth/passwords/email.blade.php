@extends('layouts.app')

@section('content')
    <div class="login-form">
        <div class="login-form-wrapper">
            <div class="login-form-wrap">
                <form action="{{ route('password.email') }}" method="POST" class="form">
                    @csrf @method('POST')
                    <span class="form-title" style="margin-bottom: 1rem;">
                        Reset Password
                    </span>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="form-input">
                        <input type="text" id="mail" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" placeholder="Email" autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <button type="submit" class="form-btn">
                        Send Reset Link
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
