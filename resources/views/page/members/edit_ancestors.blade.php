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
                                                                data-ship-name="{{ $anc->mode_of_travel->ship->name_of_ship ?? '' }}"
                                                                data-ship-year="{{ $anc->mode_of_travel->year_of_arrival ?? '' }}"
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
                                                    <label class="form-control-label">Ship Name - Year</label>
                                                    <input name="ship_name_year[]" class="form-control ship_name_year"
                                                        value="{{ $ancestor->mode_of_travel->ship->name_of_ship ?? '' }} - {{ $ancestor->mode_of_travel->year_of_arrival ?? '' }}"
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
                                    <button type="button" class="btn btn-primary add-ancestor-btn">Add Another
                                        Ancestor</button>
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
    <script>
        $(document).ready(function() {

            // Function to handle the change event for given_name select elements
            function handleSelectChange(selectElement) {
                var selectedOption = $(selectElement).find('option:selected');
                var sourceOfArrival = selectedOption.data('source');
                var shipName = selectedOption.data('ship-name');
                var shipYear = selectedOption.data('ship-year');

                var formContainer = $(selectElement).closest('.card-body');

                formContainer.find('.source_of_arrival').val(sourceOfArrival);
                formContainer.find('.ship_name_year').val(shipName + ' - ' + shipYear);
            }

            // Attach the change event handler to the initial given_name select element
            $('#ancestor-forms').on('change', '.given_name', function() {
                handleSelectChange(this);
            });

            // Function to add a new ancestor form
            function addAncestorForm() {
                var $ancestorForms = $('#ancestor-forms');
                var $lastForm = $ancestorForms.find('.card-body').last();

                // Clone the last form but don't copy over event handlers or data
                var $newAncestorForm = $lastForm.clone(false);

                // Destroy any Select2 instance on the cloned form
                $newAncestorForm.find('.given_name').select2('destroy');

                // Reset the values of the cloned form
                $newAncestorForm.find('select, input').each(function() {
                    $(this).val(''); // Clear values
                    $(this).removeAttr('id'); // Remove any ID to avoid duplicates
                });

                // Remove any existing remove buttons in the cloned form
                $newAncestorForm.find('.remove-button').remove();

                // Add a remove button to the cloned form
                $newAncestorForm.append(
                    '<div class="col-md-2"><button type="button" class="btn btn-danger remove-button" onclick="removeAncestorForm(this)">Remove</button></div>'
                );

                // Append the new form to the form container
                $ancestorForms.append($newAncestorForm);

                // Reinitialize Select2 for the new dropdown
                $newAncestorForm.find('.given_name').select2();
            }

            // Function to remove an ancestor form
            window.removeAncestorForm = function(element) {
                $(element).closest('.card-body').remove();
            }

            // Initialize Select2 on all existing select elements
            $('.given_name').select2();

            // Bind addAncestorForm to the button using jQuery
            $('.btn-primary').on('click', function() {
                addAncestorForm();
            });

        });
    </script>
@endsection

@include('layout.footer')
