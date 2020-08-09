@extends('admin_panel.layouts.app')
@section('title', 'Update Asset')

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
                        <h2>Update Asset</h2>
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
                <form action="{{ route('admin.update', $assets->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                    @csrf @method('POST')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputCompanyName">Company Name</label>
                                <input type="text" name="companyName" class="form-control {{ $errors->has('companyName') ? ' is-invalid' : '' }}" id="exampleInputCompanyName" value="{{ old('companyName') ? old('companyName') : $assets->company_name }}" autofocus aria-describedby="CompanyHelp">
                                @if($errors->has('companyName'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('companyName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Company Logo<span class="optional">(Optional)</span></label>
                                {{--<div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="companyLogo" class="custom-file-input" id="upload" value="" aria-describedby="inputGroupFileAddon01">
                                        @if($errors->has('companyLogo'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('companyLogo') }}</strong>
                                            </span>
                                        @endif
                                        <label class="custom-file-label" id="upload_file_name">{{ $assets->company_logo ? $assets->company_logo : 'Choose a file' }}</label>
                                    </div>
                                </div>--}}


                                <div class="input-group md-3">
                                    <div class="custom-file">
                                        <input type="text" class="form-control" value="{{ $assets->company_logo }}" placeholder="No File Selected">
                                        <div class="input-group-btn">
                                        <span class="fileUpload btn btn-info">
                                          <span class="upl" id="upload">Browse</span>
                                          <input type="file" name="companyLogo" class="custom-file-input upload up" id="up" onchange="readURL(this);"/> <!-- Use 'multiple' at the end of the closing such this ("readURL(this);" multiple/>) way -->
                                        </span><!-- btn-orange -->
                                        </div><!-- btn -->
                                    </div>
                                </div><!-- group -->
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Start Date</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" id="datepicker1" data-date="2012/02/12" data-date-format="yyyy/mm/dd" name="startDate" class="form-control {{ $errors->has('startDate') ? ' is-invalid' : '' }}" placeholder="yyyy/mm/dd" value="{{ old('startDate') ? old('startDate') : $assets->start_date }}">
                                    @if($errors->has('startDate'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('startDate') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>End Date</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" id="datepicker2" data-date="2012/02/12" data-date-format="yyyy/mm/dd" name="endDate" class="form-control {{ $errors->has('endDate') ? ' is-invalid' : '' }}" placeholder="yyyy/mm/dd" value="{{ old('endDate') ? old('endDate') : $assets->end_date }}">
                                    @if($errors->has('endDate'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('endDate') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputUrl1">URL</label>
                                <input type="text" name="url" class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" value="{{ old('url') ? old('url') : $assets->url }}" id="exampleInputUrl1" aria-describedby="UrlHelp">
                                @if($errors->has('url'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputAppUrl1">App URL<span class="optional">(Optional)</span></label>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i class="fab fa-apple"></i></span>
                                            </div>
                                            <input type="text" name="ios" class="form-control {{ $errors->has('ios') ? 'is-invalid' : '' }}" value="{{ old('ios') ? old('ios') : $AppUrls['ios'] }}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                            @if($errors->has('ios'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('ios') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><i class="fab fa-android"></i></span>
                                            </div>
                                            <input type="text" name="android" class="form-control {{ $errors->has('android') ? 'is-invalid' : '' }}" value="{{ old('android') ? old('android') : $AppUrls['android'] }}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                            @if($errors->has('android'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('android') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputInScopeUrl1">In Scope URL</label>
                                        <input class="form-control {{ $errors->has('inScopeUrl') ? 'is-invalid' : '' }}" name="inScopeUrl" placeholder="Add URL's" value="{{ old('inScopeUrl') ? old('inScopeUrl') : $OptionalUrls['inScope'] }}">
                                        @if($errors->has('inScopeUrl'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('inScopeUrl') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputOutScopeUrl1">Out Scope URL<span class="optional">(Optional)</span></label>
                                        <input class="form-control" name="outScopeUrl" placeholder="Add URL's" value="{{ old('outScopeUrl') ? old('outScopeUrl') : $OptionalUrls['outScope'] }}">
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
