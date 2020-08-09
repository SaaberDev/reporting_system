@extends('admin_panel.layouts.app')
@section('title', e($assets->company_name) )

@push('styles')
    {{-- Internal CSS will go here --}}
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row py-3 d-flex align-items-center ctm-margin">
            <div class="col-md-4">
                <!-- PentesterSpace  Title Start -->
                <div class="penetesterSPace">
                    <h2>{{ $assets->id }}. @yield('title')</h2>
                </div>
                <!-- penetesterSPace Tittle End -->
            </div>

            <div class="col-md-8">
                <div class="company-section">
                    <form action="{{ route('admin.previewPDF', $assets->asset_slug) }}" method="GET">
                        @csrf @method('GET')
                        <button type="submit" class="btn btn-info px-2 mr-1 my-1">Generate PDF</button>
                    </form>

                    <button href="{{ route('admin.destroy_asset', $assets->id) }}" class="btn btn-danger px-2 my-1" id="delete_asset" type="submit">DELETE PROGRAM</button>
                    <div class="programStatus d-flex align-items-center px-2 my-1">
                        <h5>Program Status: <span id="statusText" class="{{ $assets->program_status == 1 ? 'text-success' : 'text-danger' }}">{{ $assets->program_status == 1 ? 'Running' : 'Closed' }}</span> | <input type="checkbox" data-id="{{ $assets->asset_slug }}" name="program_status" class="js-switch" {{ $assets->program_status == 1 ? 'checked' : '' }}></h5>
                    </div>
                </div>
            </div>
            <!-- Program Status End -->
        </div>
    </div>

    <!-- Company Report Section Start -->
    <div class="container-fluid">
        <div class="row ctm-margin">
            <div class="col-md-12">
                <div class="reportTable">
                    <table class="table table-dark" id="show_assets_data">
                        <thead>
                        <tr>
                            <th scope="col">Report No</th>
                            <th scope="col">Bug Name</th>
                            <th scope="col">Severity</th>
                            <th scope="col">Triage Status</th>
                            <th scope="col">Reporter</th>
                            <th scope="col">Detail</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($reports as $report)
                        <tr>
                            <input type="hidden" class="report_id" value="{{ $report->id }}">

                            <th scope="row">{{ $report->id }}</th>
                            <td>{{ $report->bug_name }}</td>
                            <td>
                                @if(empty($report->severity))
                                    {{ $report->severity_calc }}
                                @else
                                    {{ $report->severity }}
                                @endif
                            </td>
                            <td>
                                @if($report->triage_status == 1)
                                    Valid
                                @else
                                    Invalid
                                @endif
                            </td>
                            <td>{{ $report->reporter_name }}</td>
                            <td class="editBtn">
                                <div class="d-flex align-items-center justify-content-center mx-auto">
                                    <a href="{{ route('admin.showReport', $report->report_slug) }}"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.destroy_report', $report->id) }}" class="delete_report" type="button"><i class="fas fa-trash-alt text-danger"></i></a>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <td>No Reports Available</td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Company Report Section End -->
@stop

@push('scripts')
    {{-- Internal JS will go here --}}
    <script>
        let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

        elems.forEach(function(html) {
            let switchery = new Switchery(html,  { size: 'small' });
        });

        $(document).ready(function(){
            $('.js-switch').change(function () {
                let program_status = $(this).prop('checked') === true ? 1 : 0;
                let assetSlug = $(this).data('id');

                const statusText = document.getElementById('statusText');
                if (program_status === 1) {
                    $('#statusText').addClass('text-success').removeClass('text-danger');
                    statusText.innerHTML = "Running";
                } else {
                    $('#statusText').addClass('text-danger').removeClass('text-success');
                    statusText.innerHTML = "Closed";
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('admin.updateStatus', $assets->asset_slug) }}',
                    data: {
                        'program_status': program_status,
                        'asset_slug': assetSlug,
                    },

                    success: function (data) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            onOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })
                        Toast.fire({
                            icon: 'success',
                            title: data.message,
                        })
                    }
                });
            });
        });
    </script>

    <!-- Datatables -->
    <script>
        $(function () {
            $("#show_assets_data").DataTable({
                "paging": true,
                "lengthMenu": [[4, 8, -1], [4, 8, "All"]],
                //"searching": true,
                "columnDefs": [
                    { "searchable": true, "targets": 0 },
                    { "searchable": false, "targets": 1 },
                    { "searchable": false, "targets": 2 },
                    { "searchable": false, "targets": 3 },
                    { "searchable": false, "targets": 4 },
                ],
                "ordering": false,
                "info": true,
                dom: "<'row'<'col-sm-2'l><'col-sm-2'f><'col-sm-8'p>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i>>",
            });
        });
    </script>

    <script>
        $('#delete_asset').on('click', function (event) {
            event.preventDefault();
            const url_asset = $(this).attr('href');

            Swal.fire({
                title: 'Are you sure?',
                text: "This record and it's details will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    window.location.href = url_asset;
                }
            })
        });


        $('.delete_report').on('click', function (event) {
            event.preventDefault();
            const url_report = $(this).attr('href');

            Swal.fire({
                title: 'Are you sure?',
                text: 'This record will be deleted permanently!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    window.location.href = url_report;
                }
            })
        });
    </script>
@endpush
