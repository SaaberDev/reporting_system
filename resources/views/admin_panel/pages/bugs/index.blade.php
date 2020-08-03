@extends('admin_panel.layouts.app')
@section('title', 'Show Report Page')

@push('styles')
    {{-- Internal CSS will go here --}}
    <style>
        .ctm-nav {
            background-color: #242d35!important;
        }

        .content {
            margin-bottom: 20px;
        }

        .content h2 {
            font-size: 1.9rem;
        }

        .ctm-bg {
            background-color: #242d35;
            padding: 20px;
            border-radius: 3px;
        }

        .prev-content h2 {
            font-size: 1.5rem;
        }

        .valid-report {
            background: #ffffff1f;
            padding: 25px;
        }

        .programStatus {
            border: 0.1px solid rgb(53 179 162 / 87%);
        }
    </style>
@endpush

@section('content')
    <!-- Code for Report Details -->
    <main class="main-cont">
        <div class="container-fluid">
            <div class="row valid-report d-flex justify-content-between searchBar" style="margin:0px 0px; ">
                <div class="col-12 col-md-4">
                    <div class="input-group mb-0">
                        <input type="text" name="report-search" class="form-control border-0" placeholder="Search here, Currently Viewing Report No: {{ $reports->id }}" value="">

                        <div class="input-group-append">
                            <button class="input-group-text border-0" style="background-color: #242d35; color: #fff; border-left: 1px solid #eeeeee!important;"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="programStatus  px-2 form-group  mb-0">
                        <h5>Valid Status: <span id="reportStatusText" class="{{ $reports->triage_status == 1 ? 'text-success' : 'text-danger' }}">{{ $reports->triage_status == 1 ? 'Valid' : 'Invalid' }}</span> | <input type="checkbox" data-id="{{ $reports->report_slug }}" name="triage_status" class="js-switch" {{ $reports->triage_status == 1 ? 'checked' : '' }}></h5>
                    </div>
                </div>
            </div>
            <div class="row py-4 title-font title-bg mx-0 my-3  text-center">
                <div class="col-md-12 mb-2">
                    <div class="title-bg title-font">
                        <h2>Vulnerability Title : <span>{{ $reports->bug_name }}</span></h2>
                    </div>
                </div>
                <div class="col-md-12 mb-2 ">
                    <div class="title-bg title-font ">
                        <h3>Weakness : <span>@if(empty($reports->weakness)) {{ $reports->otherWeakness }} @else {{ $reports->weakness }} @endif</span></h3>
                    </div>
                </div>
                <div class="col-md-12 mb-2 ">
                    <div class="title-bg">
                        <h3>Threat level : <span>@if(empty($reports->severity)) {{ $reports->severity_calc }} @else {{ $reports->severity }} @endif </span></h3>
                    </div>
                </div>
            </div>
            <!-- row end -->
            <div class="row ">
                <div class="col-md-12 ">
                    <div class="content ctm-bg ">
                        <div class="row align-items-center ">
                            <div class="col-md-4 text-center ">
                                <div class="ctm-bg mb-1 ">
                                    <h2>Description</h2>
                                </div>
                            </div>
                            <div class="col-md-8 ">
                                <div class="prev-content ">
                                    {!! $data['desc'] !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- descrip end -->
                    <div class="content ctm-bg ">
                        <div class="row align-items-center ">
                            <div class="col-md-4 text-center ">
                                <div class="mb-1">
                                    <h2>Impact</h2>
                                </div>
                            </div>
                            <div class="col-md-8 ">
                                <div class="prev-content ">
                                    {!! $data['impact'] !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- impact end -->
                    <div class="content ctm-bg ">
                        <div class="row align-items-center ">
                            <div class="col-md-4 text-center ">
                                <div class="mb-1">
                                    <h2>Step of Reproduce</h2>
                                </div>
                            </div>
                            <div class="col-md-8 ">
                                <div class="prev-content ">
                                    {!! $data['steps_of_reproduce'] !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- reproduce end -->
                    <div class="content ctm-bg ">
                        <div class="row align-items-center ">
                            <div class="col-md-4 text-center ">
                                <div class="mb-1 ">
                                    <h2>Exploitation</h2>
                                </div>
                            </div>
                            <div class="col-md-8 ">
                                <div class="prev-content ">
                                    {!! $data['exploitation'] !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- exploitation end -->
                    <div class="content ctm-bg ">
                        <div class="row align-items-center ">
                            <div class="col-md-4 text-center ">
                                <div class="mb-1 ">
                                    <h2>Fixation</h2>
                                </div>
                            </div>
                            <div class="col-md-8 ">
                                <div class="prev-content ">
                                    {!! $data['fixation'] !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- fixation end -->
                </div>
                <!-- col end -->
            </div>
            <!-- row end -->
        </div>
        <!-- container end -->
    </main>
    <!-- Code for Report Details -->
@stop

@push('scripts')
    {{-- Internal JS will go here --}}
    <!-- Toogle Switch -->
    <script>
        let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

        elems.forEach(function(html) {
            let switchery = new Switchery(html, {
                size: 'small'
            });
        });

        $(document).ready(function() {
            $('.js-switch').change(function() {
                let triageStatus = $(this).prop('checked') === true ? 1 : 0;
                let reportSlug = $(this).data('id');

                const reportStatusText = document.getElementById('reportStatusText');
                if (triageStatus === 1) {
                    $('#reportStatusText').addClass('text-success').removeClass('text-danger');
                    reportStatusText.innerHTML = "Valid";
                } else {
                    $('#reportStatusText').addClass('text-danger').removeClass('text-success');
                    reportStatusText.innerHTML = "Invalid";
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token "]').attr('content')
                    }
                });
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('admin.updateValidStatus', $reports->report_slug) }}',
                    data: {
                        'triage_status': triageStatus,
                        'report_slug': reportSlug,
                    },
                    success: function (data) {
                        //console.log(data.message)
                        toastr.options.positionClass = 'toast-top-full-width';
                        toastr.options.closeButton = true;
                        toastr.options.closeMethod = 'fadeOut';
                        toastr.options.closeDuration = 100;
                        toastr.success(data.message);
                    }
                });
            });
        });
    </script>
@endpush
