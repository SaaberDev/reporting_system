@extends('admin_panel.layouts.app')
@section('title', 'Assets')

@push('styles')
    {{-- Internal CSS will go here --}}
@endpush

@section('content')
<main class="main-cont">
    <div class="container-fluid">
        <div class="row d-flex align-items-center justify-content-between ctm-padding">
            <div class="col-sm-12 col-md-6 text-left">
                <!-- PentesterSpace  Title Start -->
                <div class="penetesterSPace">
                    <h2>Assets</h2>
                </div>
                <!-- penetesterSPace Tittle End -->
            </div>
            <div class="col-sm-12 col-md-6 text-right">
                <div class="assetBtn">
                    <a class="btn btn-ctm" href="{{ route('admin.invite') }}">Invite User</a>
                    <a class="btn btn-ctm" href="{{ route('admin.create') }}">Create New Asset</a>
                </div>
            </div>
        </div>
        <div class="row ctm-margin">
            <div class="col-md-12">
                <div class="reportTable">
                    <table class="table table-dark" id="assets_data">
                        <thead>
                        <tr>
                            <th scope="col">Sl No</th>
                            <th scope="col">Status</th>
                            <th scope="col">Company</th>
                            <th scope="col">Submitted Bug</th>
                            <th scope="col">Triage Status</th>
                            <th scope="col">Report Complete</th>
                            <th scope="col">Description</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($assets as $asset)
                                <tr>
                            <th scope="row">{{ $asset->id }}</th>
                            <td style="display: flex;align-items: center;justify-content: space-around;">
                                @if($asset->program_status === 1)
                                    <span class="circleGreen mr-2"></span>Running
                                @elseif($asset->program_status === 0)
                                    <span class="circleRed mr-2"></span>Closed
                                @endif
                            </td>
                            <td>{{ $asset->company_name }}</td>
                            <td>{{ $asset->infos_count }}</td>
                                    <td>Valid<span> ({{ $asset->valid_infos }} out of {{ $asset->infos_count }})</span></td>
                            <td>Description</td>
                            <td class="eyeBtn">
                                <div class="d-flex align-items-center justify-content-center">
                                    <button type="submit" onclick="location.href='{{ route('admin.show', $asset->asset_slug) }}'"><i class="fa fa-eye text-success"></i></button>
                                    <button type="submit" onclick="location.href='{{ route('admin.edit', $asset->id) }}'"><i class="fa fa-edit text-primary"></i></button>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <td>No Assets Available</td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@stop

@push('scripts')
    {{-- Internal JS will go here --}}
    <!-- Datatables -->
    <script>
        $(function () {
            $("#assets_data").DataTable({
                "paging": true,
                "lengthMenu": [[4, 8, -1], [4, 8, "All"]],
                "columnDefs": [
                    { "searchable": true, "targets": 0 },
                    { "searchable": false, "targets": 1 },
                    { "searchable": false, "targets": 2 },
                    { "searchable": false, "targets": 3 },
                    { "searchable": false, "targets": 4 },
                ],
                "searching": true,
                "ordering": false,
                "info": true,
                dom: "<'row'<'col-sm-2'l><'col-sm-2'f><'col-sm-8'p>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i>>",
            });
        });
    </script>
@endpush
