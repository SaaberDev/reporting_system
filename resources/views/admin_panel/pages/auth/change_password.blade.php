@extends('admin_panel.layouts.app')
@section('title', 'Change Password')

@push('styles')
    {{-- Internal CSS will go here --}}
@endpush

@section('content')
    <main>
        <div class="container-fluid">
            <div class="row asset-margin">
                <div class="col-sm-12 col-md-6 text-center">
                    <!-- PentesterSpace  Title Start -->
                    <div class="penetesterSPace">
                        <h2>Change Password</h2>
                    </div>
                    <!-- Pentester Space Tittle End -->
                </div>
            </div>
        </div>
    </main>

    <!-- Company Report Section Start -->
    <div class="password-reset-box">
        <div class="form-section">
            <div class="col-md-12">
                <form action="{{ route('admin.update.password') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                    @csrf @method('POST')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="account-info">
                                        <label>Account Information</label>
                                        <hr>
                                        <p>Name: {{ Auth::user()->name }}</p>
                                        <p>Email: {{ Auth::user()->email }}</p>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputCompanyName">Current Password</label>
                                        <input type="password" name="current_pass" class="form-control {{ $errors->has('current_pass') || session('message_error') ? ' is-invalid' : '' }}" id="exampleInputCompanyName" value="{{ old('current_pass') }}" autofocus aria-describedby="CompanyHelp">
                                        @if($errors->has('current_pass'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('current_pass') }}</strong>
                                            </span>
                                        @elseif(session('message_error'))
                                            <span class="invalid-feedback">
                                                <strong>{{ session('message_error') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputCompanyName">New Password</label>
                                        <input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" id="exampleInputCompanyName" value="{{ old('password') }}" autofocus aria-describedby="CompanyHelp">
                                        @if($errors->has('password'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputCompanyName">Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" id="exampleInputCompanyName" value="{{ old('password_confirmation') }}" autofocus aria-describedby="CompanyHelp">
                                        @if($errors->has('password_confirmation'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="ctm-btn-grp">
                        <button type="submit" name="assetBtn" class="btn btn-ctm px-3">Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- Company Report Section End -->

@stop

@push('scripts')
    {{-- Datepicker --}}
    <script>
        $('#datepicker1').datepicker();
        $('#datepicker2').datepicker();
    </script>

    {{-- Autofocus form Input --}}
    <script>
        function testAttribute(element, attribute) {
            const test = document.createElement(element);
            return attribute in test;
        }
        window.onload = function() {
            if (!testAttribute('input', 'autofocus'))
                document.getElementById('exampleInputCompanyName').focus();
        }
    </script>

    {{-- Tagify Plugin --}}
    <script>
        $('[name=inScopeUrl]').tagify();
        $('[name=outScopeUrl]').tagify();
    </script>
@endpush
