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
                            <h3 class="card-title">Add Ancestor</h3>
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
                            <form action="{{ route('members.storeAncestor', $member->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="member_id" value="{{ $member->id }}">
                                <div id="ancestor-forms">
                                    <!-- Initial form -->
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label class="form-control-label">Pioneer Name</label>
                                                <select name="given_name[]" class="form-control given_name">
                                                    <option value="">Select Ancestor</option>
                                                    @foreach ($ancestors as $ancestor)
                                                        <option value="{{ $ancestor->id }}"
                                                            data-source="{{ $ancestor->sourceOfArrival->name ?? '' }}"
                                                            data-ship-year="{{ $ancestor->mode_of_travel->year_of_arrival ?? '' }}"
                                                            data-ship-name="{{ $ancestor->mode_of_travel->ship->name_of_ship ?? '' }}">
                                                            {{ $ancestor->ancestor_surname }}
                                                            {{ $ancestor->given_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-control-label">Source of Arrival</label>
                                                <input name="source_of_arrival[]" class="form-control source_of_arrival"
                                                    disabled>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-control-label">Ship Name - Arrival Year</label>
                                                <input name="ship_name_year[]" class="form-control ship_name_year"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-primary" onclick="addAncestorForm()">Add
                                            Another Ancestor</button>
                                        <button type="submit" class="btn btn-success">Save Ancestor</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function initializeSelect2(element) {
                $(element).select2({
                    placeholder: 'Select Ancestor',
                    allowClear: true
                }).on('change', handleAncestorChange);
            }

            function initializeGivenNameListeners() {
                document.querySelectorAll('.given_name').forEach(function(select) {
                    select.removeEventListener('change',
                    handleAncestorChange); 
                    select.addEventListener('change', handleAncestorChange);
                });
            }

            function handleAncestorChange() {
                const selectedOption = this.options[this.selectedIndex];
                const source = selectedOption.getAttribute('data-source') || '';
                const shipName = selectedOption.getAttribute('data-ship-name') || '';
                const shipYear = selectedOption.getAttribute('data-ship-year') || '';

                const parentRow = this.closest('.row.mb-3');
                parentRow.querySelector('.source_of_arrival').value = source;
                parentRow.querySelector('.ship_name_year').value = `${shipName} - ${shipYear}`;
            }

            initializeSelect2('.given_name:first');
            initializeGivenNameListeners();

            window.addAncestorForm = function() {
                var ancestorFormCount = $('#ancestor-forms .card-body').length;

                var newAncestorForm = $('#ancestor-forms .card-body:first').clone();

                newAncestorForm.find('select, input').each(function() {
                    $(this).val('');

                    if ($(this).hasClass('given_name')) {
                        $(this).removeClass('select2-hidden-accessible');
                        $(this).next('.select2').remove();
                        initializeSelect2(this); 
                    }
                });

                newAncestorForm.append(
                    '<div class="col-md-2"><button type="button" class="btn btn-danger remove-button" onclick="removeAncestorForm(this)">Remove</button></div>'
                );

                newAncestorForm.insertBefore($('#ancestor-forms .card-footer'));

                initializeGivenNameListeners();
            }

            window.removeAncestorForm = function(element) {
                $(element).closest('.card-body').remove();
            }
        });
    </script>
@endsection

@include('layout.footer')
