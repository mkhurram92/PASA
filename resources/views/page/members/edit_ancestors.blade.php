@include('layout.header')
@include('layout.sidebar')

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
            <div class="page-header">
                <div class="page-leftheader">
                    <h4 class="page-title"></h4>
                </div>
            </div>

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
                            <h3 class="card-title">Edit Ancestors</h3>
                            <div>
                                @if (Auth::user()->name == 'Admin')
                                    <a class="btn btn-danger" href="{{ route('members.index') }}">
                                        <i class="fa fa-home" style="font-size:20px;"> Home</i>
                                    </a>
                                    <a class="btn btn-info" href="{{ url()->previous() }}" id="view-members">
                                        <i class="fa fa-arrow-circle-left" style="font-size:20px;"> Back</i>
                                    </a>
                                @else
                                    <a class="btn btn-danger" href="{{ route('profile') }}">
                                        <i class="fa fa-home" style="font-size:20px;"> Home</i>
                                    </a>
                                    <a class="btn btn-info" href="{{ url()->previous() }}" id="view-members">
                                        <i class="fa fa-arrow-circle-left" style="font-size:20px;"> Back</i>
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <form action="{{ route('members.updateAncestors', $member->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="member_id" value="{{ $member->id }}">
                                <div id="ancestor-forms">
                                    @foreach ($member->ancestors as $ancestor)
                                        <div class="card-body">
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <label class="form-control-label">Pioneer Name</label>
                                                    <select name="given_name[]" class="form-control given_name">
                                                        <option value="">Select Ancestor</option>
                                                        @foreach ($ancestors as $anc)
                                                            <option value="{{ $anc->id }}"
                                                                data-source="{{ $anc->sourceOfArrival->name ?? '' }}"
                                                                data-day="{{ $anc->mode_of_travel->date_of_arrival ?? '' }}"
                                                                data-month="{{ $anc->mode_of_travel->month_of_arrival ?? '' }}"
                                                                data-year="{{ $anc->mode_of_travel->year_of_arrival ?? '' }}"
                                                                {{ $ancestor->id == $anc->id ? 'selected' : '' }}>
                                                                {{ $anc->given_name }}
                                                                {{ $anc->ancestor_surname }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-control-label">Source of Arrival</label>
                                                    <input name="source_of_arrival[]"
                                                        class="form-control source_of_arrival"
                                                        value="{{ $ancestor->sourceOfArrival->name ?? '' }}" disabled>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-control-label">Arrival Date</label>
                                                    <input name="mode_of_travel_id[]"
                                                        class="form-control mode_of_travel_id"
                                                        value="{{ $ancestor->mode_of_travel->year_of_arrival ?? '' }}-{{ $ancestor->mode_of_travel->month_of_arrival ?? '' }}-{{ $ancestor->mode_of_travel->date_of_arrival ?? '' }}"
                                                        disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger remove-button"
                                                    onclick="removeAncestorForm(this)">Remove</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary" onclick="addAncestorForm()">Add
                                        Another Ancestor</button>
                                    <button type="submit" class="btn btn-success">Save Ancestors</button>
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
    <!-- Include Select2 CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {

            // Function to handle the change event for given_name select elements
            function handleSelectChange(selectElement) {
                var selectedOption = $(selectElement).find('option:selected');
                var sourceOfArrival = selectedOption.data('source');
                var day = selectedOption.data('day');
                var month = selectedOption.data('month');
                var year = selectedOption.data('year');

                var formContainer = $(selectElement).closest('.card-body');

                formContainer.find('.source_of_arrival').val(sourceOfArrival);

                var formattedDate = '';
                if (year) {
                    formattedDate = year;
                    if (month) {
                        formattedDate += '-' + String(month).padStart(2, '0');
                        if (day) {
                            formattedDate += '-' + String(day).padStart(2, '0');
                        }
                    }
                }

                formContainer.find('.mode_of_travel_id').val(formattedDate);
            }

            // Attach the change event handler to the initial given_name select element
            $('#ancestor-forms').on('change', '.given_name', function() {
                handleSelectChange(this);
            });

            // Function to add a new ancestor form
            function addAncestorForm() {
                var $ancestorForms = $('#ancestor-forms');
                var $lastForm = $ancestorForms.find('.card-body').last();

                // Clone the last form
                var $newAncestorForm = $lastForm.clone();

                // Reset the values of the cloned form
                $newAncestorForm.find('select, input').each(function() {
                    $(this).val('').removeAttr('id');
                });

                // Ensure that the cloned form elements have unique names
                $newAncestorForm.find('.given_name').attr('name', 'given_name[]');
                $newAncestorForm.find('.source_of_arrival').attr('name', 'source_of_arrival[]');
                $newAncestorForm.find('.mode_of_travel_id').attr('name', 'mode_of_travel_id[]');

                // Remove any existing remove buttons in the cloned form
                $newAncestorForm.find('.remove-button').remove();

                // Add a remove button to the cloned form
                $newAncestorForm.append(
                    '<div class="col-md-2"><button type="button" class="btn btn-danger remove-button" onclick="removeAncestorForm(this)">Remove</button></div>'
                );

                // Append the new form before the footer
                $ancestorForms.append($newAncestorForm);
            }

            // Function to remove an ancestor form
            window.removeAncestorForm = function(element) {
                $(element).closest('.card-body').remove();
            }

            // Bind addAncestorForm to the button
            $('body').on('click', '.btn-primary', function() {
                addAncestorForm();
            });
            $('form').on('submit', function(event) {
                console.log('Form is being submitted');
            });

        });
    </script>
@endsection

@include('layout.footer')
