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
                                                            data-day="{{ $ancestor->mode_of_travel->date_of_arrival ?? '' }}"
                                                            data-month="{{ $ancestor->mode_of_travel->month_of_arrival ?? '' }}"
                                                            data-year="{{ $ancestor->mode_of_travel->year_of_arrival ?? '' }}">
                                                            {{ $ancestor->given_name }}
                                                            {{ $ancestor->ancestor_surname }}
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
                                                <label class="form-control-label">Arrival Date</label>
                                                <input name="mode_of_travel_id[]" class="form-control mode_of_travel_id"
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
        });

        // Function to add a new ancestor form
        function addAncestorForm() {
            var ancestorFormCount = $('#ancestor-forms .card-body').length;

            // Clone the initial form
            var newAncestorForm = $('#ancestor-forms .card-body:first').clone();

            // Update the IDs and names of the cloned elements
            newAncestorForm.find('select, input').each(function() {
                var newId = $(this).attr('id') + '_' + ancestorFormCount;
                $(this).attr('id', newId).val('');

                // Update the class to ensure the cloned elements can be targeted
                if ($(this).attr('name') === 'given_name') {
                    $(this).addClass('given_name');
                } else if ($(this).attr('name') === 'source_of_arrival') {
                    $(this).addClass('source_of_arrival');
                } else if ($(this).attr('name') === 'mode_of_travel_id') {
                    $(this).addClass('mode_of_travel_id');
                }
            });

            // Add a remove button to the cloned form
            newAncestorForm.append(
                '<div class="col-md-2"><button type="button" class="btn btn-danger remove-button" onclick="removeAncestorForm(this)">Remove</button></div>'
                );

            // Insert the cloned form before the button container
            newAncestorForm.insertBefore($('#ancestor-forms .card-footer'));
        }

        // Function to remove an ancestor form
        function removeAncestorForm(element) {
            $(element).closest('.card-body').remove();
        }
    </script>
@endsection

@include('layout.footer')
