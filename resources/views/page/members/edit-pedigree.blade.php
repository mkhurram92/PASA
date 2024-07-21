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
        </style>
        <div class="container-fluid main-container">
            <!--Page header-->
            <div class="page-header">
                <div class="page-leftheader">
                    <h4 class="page-title">Edit Pedigree</h4>
                </div>
            </div>
            <!--End Page header-->

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
                            <h3 class="card-title">Update Pioneer Member's Pedigree Chart</h3>
                            <div>
                                <button type="submit" form="pedigree-form" class="btn btn-primary">Save
                                    Pedigree</button>
                                <a class="btn btn-danger" href="{{ route('members.index') }}">
                                    <i class="fa fa-home" style="font-size:20px;"> Home</i>
                                </a>
                                <a class="btn btn-info" href="{{ url()->previous() }}" id="view-members">
                                    <i class="fa fa-arrow-circle-left" style="font-size:20px;"> Back</i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <form id="pedigree-form" action="{{ route('members.updatePedigree', $member->id) }}"
                                method="POST">
                                @csrf
                                @method('POST') <!-- Ensure the method matches the route's HTTP method -->

                                @foreach ($member->pedigree as $index => $pedigree)
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <a class="form-control-label"
                                                    style="color: #022ff8; font-size:16px">Generation x
                                                    {{ $pedigree->pedigree_level + 1 }}</a>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-2">
                                                <label class="form-control-label">Father Name</label>
                                                <input class="form-control" name="pedigree[{{ $index }}][id]"
                                                    type="hidden" value="{{ $pedigree->id }}">
                                                <input class="form-control" name="pedigree[{{ $index }}][f_name]"
                                                    value="{{ $pedigree->f_name }}" type="text">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Birth Date</label>
                                                <input class="form-control"
                                                    name="pedigree[{{ $index }}][date_of_birth]"
                                                    value="{{ $pedigree->date_of_birth ?? '' }}" type="text">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Birth Place</label>
                                                <input class="form-control"
                                                    name="pedigree[{{ $index }}][place_of_birth]"
                                                    value="{{ $pedigree->place_of_birth ?? '' }}" type="text">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Death Date</label>
                                                <input class="form-control"
                                                    name="pedigree[{{ $index }}][date_of_death]"
                                                    value="{{ $pedigree->date_of_death ?? '' }}" type="text">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Death Place</label>
                                                <input class="form-control"
                                                    name="pedigree[{{ $index }}][place_of_death]"
                                                    value="{{ $pedigree->place_of_death ?? '' }}" type="text">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Marriage Date</label>
                                                <input class="form-control"
                                                    name="pedigree[{{ $index }}][date_of_marriage]"
                                                    value="{{ $pedigree->date_of_marriage ?? '' }}" type="text">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Mother Name</label>
                                                <input class="form-control"
                                                    name="pedigree[{{ $index }}][m_name]"
                                                    value="{{ $pedigree->m_name }}" type="text">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Birth Date</label>
                                                <input class="form-control"
                                                    name="pedigree[{{ $index }}][m_birth_date]"
                                                    value="{{ $pedigree->m_birth_date ?? '' }}" type="text">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Birth Place</label>
                                                <input class="form-control"
                                                    name="pedigree[{{ $index }}][m_birth_place]"
                                                    value="{{ $pedigree->m_birth_place ?? '' }}" type="text">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Death Date</label>
                                                <input class="form-control"
                                                    name="pedigree[{{ $index }}][m_death_date]"
                                                    value="{{ $pedigree->m_death_date ?? '' }}" type="text">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Death Place</label>
                                                <input class="form-control"
                                                    name="pedigree[{{ $index }}][m_death_place]"
                                                    value="{{ $pedigree->m_death_place ?? '' }}" type="text">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Marriage Place</label>
                                                <input class="form-control"
                                                    name="pedigree[{{ $index }}][place_of_marriage]"
                                                    value="{{ $pedigree->place_of_marriage ?? '' }}" type="text">
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                    </div>
                                @endforeach
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- app-content end-->
@include('layout.footer')
