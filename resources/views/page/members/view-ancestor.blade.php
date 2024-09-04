@include('layout.header')
@include('layout.sidebar')
<!-- app-content start-->
<div class="app-content main-content">
    <div class="side-app">
        <style>
            .row {
                margin-bottom: 1rem;
            }

            .form-control-label {
                font-size: 16px;
                font-weight: 500;
            }

            .col-md-2 {
                margin-top: 1rem;
            }

            .remove-button {
                margin-top: 25px;
            }
        </style>
        <div class="container-fluid main-container">
            <!-- Page header -->
            <div class="page-header">
                <div class="page-leftheader">
                    <h4 class="page-title"></h4>
                </div>
            </div>

            <!-- End Page header -->
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @elseif(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @elseif(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="card-header justify-content-between">
                            <h3 class="card-title">View Member's Ancestor</h3>
                            <div>
                                @if (Auth::user()->name == 'Admin')
                                    <a class="btn btn-danger" href="{{ route('members.index') }}">
                                        <i class="fa fa-home" style="font-size:20px;"> Home</i>
                                    </a>
                                    @if (count($member->ancestors) > 0)
                                    <a class="btn btn-info" onclick="downloadExcel()">
                                        <i class="fa fa-file-excel-o" style="font-size:20px;"> Download</i>
                                    </a>                                    
                                        <a class="btn btn-success mr-2"
                                            href="{{ route('members.editAncestors', $member->id) }}">
                                            <i class="pe-7s-pen btn-icon-wrapper" style="font-size:20px;"> Edit</i>
                                        </a>
                                    @else
                                        <a class="btn btn-success mr-2"
                                            href="{{ route('members.addAncestor', $member->id) }}">
                                            <i class="pe-7s-pen btn-icon-wrapper" style="font-size:20px;"> Add</i>
                                        </a>
                                    @endif
                                    <a class="btn btn-info" href="{{ url()->previous() }}" id="view-members">
                                        <i class="fa fa-arrow-circle-left" style="font-size:20px;"> Back</i>
                                    </a>
                                @else
                                    <a class="btn btn-danger" href="{{ route('profile') }}">
                                        <i class="fa fa-home" style="font-size:20px;"> Home</i>
                                    </a>
                                    @if (count($member->ancestors) > 0)
                                        <a class="btn btn-success mr-2" href="{{ route('members.editAncestors', $member->id) }}">
                                            <i class="pe-7s-pen btn-icon-wrapper" style="font-size:20px;"> Edit</i>
                                        </a>
                                    @else
                                        <a class="btn btn-success mr-2"
                                            href="{{ route('members.addAncestor', $member->id) }}">
                                            <i class="pe-7s-pen btn-icon-wrapper" style="font-size:20px;"> Add</i>
                                        </a>
                                    @endif
                                    <a class="btn btn-info" href="{{ url()->previous() }}" id="view-members">
                                        <i class="fa fa-arrow-circle-left" style="font-size:20px;"> Back</i>
                                    </a>
                                @endif
                            </div>
                        </div>
                        @if (count($member->ancestors) > 0)
                            <div class="card-body p-0">
                                <div id="ancestor-forms">
                                    @foreach ($member->ancestors as $ancestor)
                                        <div class="card-body">
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <label class="form-control-label">Pioneer Name</label>
                                                    <input name="ancestor_given_name"
                                                        value="{{ $ancestor->given_name }} {{ $ancestor->ancestor_surname }}"
                                                        class="form-control" disabled>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-control-label">Source of Arrival</label>
                                                    <input name="source_of_arrival"
                                                        value="{{ $ancestor->sourceOfArrival->name ?? '' }}"
                                                        class="form-control" disabled>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-control-label">Ship Name - Year</label>
                                                    @php
                                                        $shipNameYear = '';
                                                        if ($ancestor->mode_of_travel?->ship?->name_of_ship) {
                                                            $shipNameYear = $ancestor->mode_of_travel->ship->name_of_ship;
                                                            if ($ancestor->mode_of_travel?->year_of_arrival) {
                                                                $shipNameYear .= ' - ' . $ancestor->mode_of_travel->year_of_arrival;
                                                            }
                                                        }
                                                    @endphp
                                                    <input name="ship_name_year" value="{{ $shipNameYear }}"
                                                        class="form-control" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="card">
                                <div class="card-header justify-content-between">
                                    <h3 class="card-title">No Ancestor Found</h3>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script>
        // Function to export ancestor data to Excel
        function downloadExcel() {
            // Prepare data for Excel
            var data = [
                ["Pioneer Name", "Source of Arrival", "Ship Name - Year"],
                @foreach ($member->ancestors as $ancestor)
                [
                    "{{ $ancestor->given_name }} {{ $ancestor->ancestor_surname }}",
                    "{{ $ancestor->sourceOfArrival->name ?? '' }}",
                    "{{ $ancestor->mode_of_travel?->ship?->name_of_ship ? $ancestor->mode_of_travel->ship->name_of_ship . ($ancestor->mode_of_travel?->year_of_arrival ? ' - ' . $ancestor->mode_of_travel->year_of_arrival : '') : '' }}"
                ],
                @endforeach
            ];

            // Create a worksheet from the data
            var ws = XLSX.utils.aoa_to_sheet(data);

            // Create a new workbook and append the worksheet
            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Ancestors");

            // Generate Excel file and trigger download
            XLSX.writeFile(wb, "ancestor_data.xlsx");
        }

        document.getElementById('view-members').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default behavior of the link

            // Extract the current URL and the id from it
            var currentUrl = window.location.href;
            var id = currentUrl.substring(currentUrl.lastIndexOf('/') + 1);

            // Construct the new URL for editing
            var newUrl = currentUrl.replace('/view-ancestor/', '/view-member/');

            // Redirect to the new URL
            window.location.href = newUrl;
        });
    </script>
@endsection

@include('layout.footer')
