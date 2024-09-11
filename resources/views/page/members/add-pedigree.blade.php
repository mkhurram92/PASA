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
                            <h3 class="card-title">Add Pedigree Chart</h3>
                            <div>
                                @if (Auth::user()->name == 'Admin')
                                    <a class="btn btn-danger" href="{{ route('members.index') }}">
                                        <i class="fa fa-home" style="font-size:20px;"> Home</i>
                                    </a>
                                    <a class="btn btn-info" href="{{ url()->previous() }}" id="view-members">
                                        <i class="fa fa-arrow-circle-left" style="font-size:20px;"> Back</i>
                                    </a>
                                @else
                                    <a class="btn btn-info" href="{{ url()->previous() }}" id="view-members">
                                        <i class="fa fa-arrow-circle-left" style="font-size:20px;"> Back</i>
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <form action="{{ route('members.storePedigree', $member->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="member_id" value="{{ $member->id }}">
                                <div id="pedigree-forms">
                                    <!-- Initial form -->
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <a class="form-control-label"
                                                    style="color: #022ff8; font-size:16px">Generation x <span
                                                        class="pedigree-level">1</span></a>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-2">
                                                <label class="form-control-label">Father Name</label>
                                                <input class="form-control" name="pedigrees[0][f_name]" type="text">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Birth Date</label>
                                                <input class="form-control" name="pedigrees[0][date_of_birth]"
                                                    placeholder="YYYY-MM-DD" type="text">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Birth Place</label>
                                                <input class="form-control" name="pedigrees[0][place_of_birth]"
                                                    type="text">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Death Date</label>
                                                <input class="form-control" name="pedigrees[0][date_of_death]"
                                                    placeholder="YYYY-MM-DD" type="text">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Death Place</label>
                                                <input class="form-control" name="pedigrees[0][place_of_death]"
                                                    type="text">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Marriage Date</label>
                                                <input class="form-control" name="pedigrees[0][date_of_marriage]"
                                                    placeholder="YYYY-MM-DD" type="text">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Mother Name</label>
                                                <input class="form-control" name="pedigrees[0][m_name]" type="text">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Birth Date</label>
                                                <input class="form-control" name="pedigrees[0][m_birth_date]"
                                                    placeholder="YYYY-MM-DD" type="text">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Birth Place</label>
                                                <input class="form-control" name="pedigrees[0][m_birth_place]"
                                                    type="text">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Death Date</label>
                                                <input class="form-control" name="pedigrees[0][m_death_date]"
                                                    placeholder="YYYY-MM-DD" type="text">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Death Place</label>
                                                <input class="form-control" name="pedigrees[0][m_death_place]"
                                                    type="text">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Marriage Place</label>
                                                <input class="form-control" name="pedigrees[0][place_of_marriage]"
                                                    type="text">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-control-label">Additional Notes</label>
                                                <textarea class="form-control" rows="4" name="pedigrees[0][notes]"></textarea>
                                            </div>
                                            <div class="col-md-1 remove-button">
                                                <button type="button" class="btn btn-danger"
                                                    onclick="removePedigreeForm(this)">Remove</button>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary" onclick="addPedigreeForm()">Add
                                        Another Pedigree</button>
                                    <button type="submit" class="btn btn-success">Save Pedigrees</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let pedigreeIndex = 1;

    function addPedigreeForm() {
        const newForm = `
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <a class="form-control-label" style="color: #022ff8; font-size:16px">Generation x <span class="pedigree-level">${pedigreeIndex + 1}</span></a>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2">
                        <label class="form-control-label">Father Name</label>
                        <input class="form-control" name="pedigrees[${pedigreeIndex}][f_name]" type="text">
                    </div>
                    <div class="col-md-2">
                        <label class="form-control-label">Birth Date</label>
                        <input class="form-control" name="pedigrees[${pedigreeIndex}][date_of_birth]" type="text">
                    </div>
                    <div class="col-md-2">
                        <label class="form-control-label">Birth Place</label>
                        <input class="form-control" name="pedigrees[${pedigreeIndex}][place_of_birth]" type="text">
                    </div>
                    <div class="col-md-2">
                        <label class="form-control-label">Death Date</label>
                        <input class="form-control" name="pedigrees[${pedigreeIndex}][date_of_death]" type="text">
                    </div>
                    <div class="col-md-2">
                        <label class="form-control-label">Death Place</label>
                        <input class="form-control" name="pedigrees[${pedigreeIndex}][place_of_death]" type="text">
                    </div>
                    <div class="col-md-2">
                        <label class="form-control-label">Marriage Date</label>
                        <input class="form-control" name="pedigrees[${pedigreeIndex}][date_of_marriage]" type="text">
                    </div>
                    <div class="col-md-2">
                        <label class="form-control-label">Mother Name</label>
                        <input class="form-control" name="pedigrees[${pedigreeIndex}][m_name]" type="text">
                    </div>
                    <div class="col-md-2">
                        <label class="form-control-label">Birth Date</label>
                        <input class="form-control" name="pedigrees[${pedigreeIndex}][m_birth_date]" type="text">
                    </div>
                    <div class="col-md-2">
                        <label class="form-control-label">Birth Place</label>
                        <input class="form-control" name="pedigrees[${pedigreeIndex}][m_birth_place]" type="text">
                    </div>
                    <div class="col-md-2">
                        <label class="form-control-label">Death Date</label>
                        <input class="form-control" name="pedigrees[${pedigreeIndex}][m_death_date]" type="text">
                    </div>
                    <div class="col-md-2">
                        <label class="form-control-label">Death Place</label>
                        <input class="form-control" name="pedigrees[${pedigreeIndex}][m_death_place]" type="text">
                    </div>
                    <div class="col-md-2">
                        <label class="form-control-label">Marriage Place</label>
                        <input class="form-control" name="pedigrees[${pedigreeIndex}][place_of_marriage]" type="text">
                    </div>
                    <div class="col-md-12">
                        <label class="form-control-label">Additional Notes</label>
                        <textarea class="form-control" rows="3" name="pedigrees[${pedigreeIndex}][notes]"></textarea>
                    </div>
                    <div class="col-md-1 remove-button">
                        <button type="button" class="btn btn-danger" onclick="removePedigreeForm(this)">Remove</button>
                    </div>
                </div>
                <br>
                <br>
            </div>
        `;
        document.getElementById('pedigree-forms').insertAdjacentHTML('beforeend', newForm);
        pedigreeIndex++;
    }

    function removePedigreeForm(button) {
        button.closest('.card-body').remove();
    }
</script>
@include('layout.footer')
