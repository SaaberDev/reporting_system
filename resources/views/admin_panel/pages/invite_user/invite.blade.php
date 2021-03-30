@extends('admin_panel.layouts.app')
@section('title', 'Create New Asset')

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
                        <h2>Invite new user</h2>
                    </div>
                    <!-- Pentester Space Tittle End -->
                </div>
            </div>
        </div>
    </main>

    <!-- Company Report Section Start -->
    <div class="companyReport-sec">
        <div class="form-section">
            <div class="col-md-12">
                <form action="{{ route('admin.invite') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                    @csrf @method('POST')
                    <div style="padding: 0 200px;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputCompanyName">Email*</label>
                                    <input type="text" name="email" class="form-control {{ ($errors->has('email') ? ' is-invalid' : '') }}" id="exampleInputCompanyName" value="{{ old('email') }}" autofocus aria-describedby="CompanyHelp">
                                    @if($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputCompanyName">Password*</label>
                                    <input type="text" name="password" class="form-control {{ ($errors->has('password') ? ' is-invalid' : '') }}" id="exampleInputCompanyName" value="{{ old('password') }}" autofocus aria-describedby="CompanyHelp">
                                    @if($errors->has('password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <p>Credentials will be send to users provided email address.</p>
                    <div class="ctm-btn-grp">
                        <button type="submit" name="assetBtn" class="btn btn-ctm px-3">Send Invitation</button>
                    </div>
                    </div>
                </form>
            </div>

        </div>
    </div>



@stop

@push('scripts')
    {{-- Internal JS will go here --}}
@endpush
