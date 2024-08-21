<h3>Ancestor</h3>
<section>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div id="ancestor-forms">
                        <!-- Initial form -->
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-control-label">Pioneer Name</label>
                                    <select name="ancestor_given_name[]" class="form-control ancestor_given_name">
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
                                    <input name="source_of_arrival[]" class="form-control source_of_arrival" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-control-label">Arrival Date</label>
                                    <input name="mode_of_travel_id[]" class="form-control mode_of_travel_id" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" onclick="addAncestorForm()">Add Another
                            Ancestor</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
        $('#ancestor-forms').on('change', '.ancestor_given_name', function() {
            handleSelectChange(this);
        });

        // Function to add a new ancestor form
        function addAncestorForm() {
            console.log('Add Ancestor Form function called.'); // Debug log

            var ancestorFormCount = $('#ancestor-forms .card-body').length;

            // Clone the initial form
            var newAncestorForm = $('#ancestor-forms .card-body:first').clone();
            console.log('Ancestor form cloned.', newAncestorForm); // Debug log

            // Clear the cloned form's values
            newAncestorForm.find('select').prop('selectedIndex', 0); // Reset the select element
            newAncestorForm.find('input').val(''); // Clear the input values

            // Add a remove button to the cloned form if it doesn't exist
            if (!newAncestorForm.find('.remove-button').length) {
                newAncestorForm.append(
                    '<div class="col-md-2"><button type="button" class="btn btn-danger remove-button" onclick="removeAncestorForm(this)">Remove</button></div>'
                );
            }

            // Insert the cloned form before the button container
            $('#ancestor-forms').append(newAncestorForm);
            console.log('Ancestor form appended.', newAncestorForm); // Debug log
        }

        // Function to remove an ancestor form
        function removeAncestorForm(element) {
            $(element).closest('.card-body').remove();
        }

        // Attach the addAncestorForm function to the button
        $('.btn-primary').on('click', function() {
            addAncestorForm();
        });
    });
</script>
