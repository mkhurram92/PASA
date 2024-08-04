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
                                        <a class="btn btn-success mr-2" href="#">
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
                                        <a class="btn btn-success mr-2" href="#">
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
                                                    <label class="form-control-label">Arrival Date</label>
                                                    @php
                                                        $arrivalDate = '';
                                                        if ($ancestor->mode_of_travel?->year_of_arrival) {
                                                            $arrivalDate = $ancestor->mode_of_travel?->year_of_arrival;
                                                            if ($ancestor->mode_of_travel->month_of_arrival) {
                                                                $arrivalDate .=
                                                                    '-' .
                                                                    str_pad(
                                                                        $ancestor->mode_of_travel?->month_of_arrival,
                                                                        2,
                                                                        '0',
                                                                        STR_PAD_LEFT,
                                                                    );
                                                                if ($ancestor->mode_of_travel->date_of_arrival) {
                                                                    $arrivalDate .=
                                                                        '-' .
                                                                        str_pad(
                                                                            $ancestor->mode_of_travel?->date_of_arrival,
                                                                            2,
                                                                            '0',
                                                                            STR_PAD_LEFT,
                                                                        );
                                                                }
                                                            }
                                                        }
                                                    @endphp
                                                    <input name="mode_of_travel_id" value="{{ $arrivalDate }}"
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
@include('layout.footer')
