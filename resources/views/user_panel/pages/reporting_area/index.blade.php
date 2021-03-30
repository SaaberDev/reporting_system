@extends('user_panel.layouts.app')
@section('title', 'Reporting Area')

@push('styles')
    {{-- Internal CSS will go here --}}
@endpush

@section('content')
    <section id="index-page">
        <div class="container">
            <div class="row main-heading">
                <div class="col-12 text-center mt-2">
                    <h1>Running Programs</h1>
                </div>    <!-- col end -->
            </div>  <!-- row end -->
            <div class="table-title">
                <div class="row text-center">
                    <div class="col-sm-3 col-md-3">

                    </div>   <!-- col end -->
                    <div class="col-sm-3 col-md-3">
                        <h3>Program</h3>
                    </div>  <!-- col end -->
                    <div class="col-sm-3 col-md-3">
                        <h3>Start Date</h3>
                    </div>  <!-- col end -->
                    <div class="col-sm-3 col-md-3">
                        <h3>End Date</h3>
                    </div>  <!-- col end -->
                </div>  <!-- row end -->
            </div>  <!-- table-title end -->

            @forelse($assets as $asset)
            <div class="table-single-row clickable">
                <div class="row text-center d-flex align-items-center">
                    <div class="col-sm-3 col-md-3">
                        <div class="brand-logo mx-auto">
                            <img class="img-fluid" src="{{ asset('storage/admin_panel/img/' . $asset->company_logo) }}" alt="Company Logo">
                        </div> <!-- Brand-logo end -->
                    </div>  <!-- col end -->

                    <div class="col-sm-3 col-md-3">
                        <div class="brand-name">
                            <a href="{{ route('report.show', $asset->asset_slug) }}">{{ $asset->company_name }}</a>
                        </div>
                    </div>  <!-- col end -->

                    <div class="col-sm-3 col-md-3">
                        <div class="working-date">
                            <p>{{ $asset->start_date }}</p>
                        </div>
                    </div>  <!-- col end -->

                    <div class="col-sm-3 col-md-3">
                        <div class="working-date">
                            <p>{{ $asset->end_date }}</p>
                        </div>
                    </div>  <!-- col end -->

                </div>  <!-- row end -->
            </div>  <!-- table-single-row end-->
            @empty
                <div class="table-single-row clickable">
                    <div class="row text-center d-flex align-items-center">
                        <div class="col-sm-6 col-md-6">
                                No Programs are running right now. Please come back later.
                        </div>  <!-- col end -->
                    </div>  <!-- row end -->
                </div>
            @endforelse

        </div>  <!-- container end -->
    </section>
@stop

@push('scripts')
    {{-- Internal JS will go here --}}
@endpush
