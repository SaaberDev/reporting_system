@extends('user_panel.layouts.app')
@section('title', e($assets->company_name))

@push('styles')
    {{-- Internal CSS will go here --}}
@endpush

@section('content')
    <section id="asset-page">
        <div class="container">
            <div class="brand-part custom-bg">
                <div class="row py-5 pl-5 my-5 d-flex align-items-center">
                    <div class="col-12 col-md-2 text-right mb-3 mb-md-0">
                        <div class="brand-logo">
                            <div class="logo-shape ml-5">
                                <img src="{{ asset('storage/admin_panel/img/' . $assets->company_logo) }}" alt="">
                            </div>
                        </div>  <!-- brand-logo end -->
                    </div>  <!-- col end -->
                    <div class="col-12 col-md-10 d-flex align-items-center justify-content-between sm-design">
                        <div class="brand-content">
                            <h2>{{ $assets->company_name }}</h2>
                            <a href="{{ $assets->url }}">{{ $assets->url }}</a>
                        </div>  <!-- brand-content end -->
                        <a href="{{ route('report.create', $assets->asset_slug ) }}" class="btn btn-danger btn-sm px-4 py-2 mr-5">Submit Report</a>
                    </div>  <!-- col end -->
                </div>  <!-- row end -->
            </div>  <!-- brand-part end -->

            <div class="scope-part custom-bg py-3 mb-3">
                <div class="row text-center">
                    <div class="col-md-12">
                        <h3>Scope</h3>
                    </div>  <!-- col end -->
                </div>  <!-- row end -->
            </div>  <!-- scope-part end -->

            <div class="file-download-part custom-bg mb-3 py-5">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-sm-12 col-md-3 text-center">
                            <h3>App URL</h3>
                        </div>   <!-- col end -->

                        <div class="col-sm-12 col-md-9">
                            <div class="mid-cont">
                                <div class="sngl-col d-flex">
                                    <h5>ISO:</h5>
                                    <p>{{ $app_urls->ios }}</p>
                                    <div class="dwn-ref mx-auto">
                                        @if(!empty($app_urls->ios))
                                            <a href="{{ $app_urls->ios }}" target="_blank">Download Here <i class="fas fa-download"></i></a>
                                        @else
                                            App link not available
                                        @endif
                                    </div>  <!-- dwn-ref end -->
                                </div>
                                <div class="sngl-col d-flex">
                                    <h5>Android:</h5>
                                    <p>{{ $app_urls->android }}</p>
                                    <div class="dwn-ref mx-auto">
                                        @if(!empty($app_urls->android))
                                            <a href="{{ $app_urls->android }}" target="_blank">Download Here <i class="fas fa-download"></i></a>
                                        @else
                                            App link not available
                                        @endif
                                    </div>  <!-- dwn-ref end -->
                                </div>  <!-- sngl-col end -->
                            </div>  <!-- mid-cont end -->
                        </div>   <!-- col end -->

                    </div>  <!-- row end -->
                </div>  <!-- container end -->
            </div>  <!-- file-download-part end -->

            <div class="outof-scope custom-bg py-5 mb-3">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-3 text-center">
                            <h3>In Scope</h3>
                        </div>  <!-- col end -->
                        <div class="col-md-9">
                            <div class="scope-cont">
                                <ul class="pl-5">
                                    @forelse($inScopeUrls as $inScopeUrl)
                                        <li>{{ change_http($inScopeUrl->value) }}</li>
                                    @empty
                                        Not Available
                                    @endforelse
                                </ul>
                            </div>  <!-- scope-cont end -->
                        </div>  <!-- col end -->
                    </div>  <!-- row end -->
                </div>  <!-- container end -->
            </div>  <!-- In Scope End -->

            <div class="outof-scope custom-bg py-5 mb-3">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-3 text-center">
                            <h3>Out Of Scope</h3>
                        </div>  <!-- col end -->
                        <div class="col-md-9">
                            <div class="scope-cont">
                                <ul class="pl-5">
                                    @forelse($outScopeUrls as $outScopeUrl)
                                        <li>{{ $outScopeUrl->value }}</li>
                                    @empty
                                        Not Available
                                    @endforelse
                                </ul>
                            </div>  <!-- scope-cont end -->
                        </div>  <!-- col end -->
                    </div>  <!-- row end -->
                </div>  <!-- container end -->
            </div>  <!-- Out Scope End -->
        </div>  <!-- container end -->
    </section>  <!-- section end -->
@stop

@push('scripts')
    {{-- Internal JS will go here --}}
@endpush
