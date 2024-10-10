<!-- jQuery (Make sure it's loaded first) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 JS (after jQuery) -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@include('layout.header')
@include('layout.sidebar')
<div class="app-content main-content">
    <div class="side-app">
        <div class="container-fluid">
            <div class="page-header">
                <div class="page-leftheader">
                    <h3 class="page-title">Reports</h3>
                </div>
            </div>
            <form action="#" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body p-2">
                        <div class="row align-items-center">
                            <!-- Ship Dropdown -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ship">Select Ship</label>
                                    <select name="ship_id" id="ship" class="form-control select2">
                                        <option value="">Select Ship</option>
                                        @foreach ($sameship as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name_of_ship }} - {{ $item->year }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Display Selected Ship Name -->
                            <h4 id="selectedShip" class="mt-4" style="text-align: center;"></h4>
                        </div>
                        <!-- Table to Display Ancestors Information -->
                        <div class="mt-4">
                            <table id="reportTable" class="table table-bordered" style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th>Pioneer Name</th>
                                        <th>Gender</th>
                                        <th>Member</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Ancestor data will be populated here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- app-content end-->
@include('layout.footer')

<!-- Initialize Select2 and AJAX for Ancestors -->
<script>
    $(document).ready(function() {
        $('#ship').select2({
            placeholder: "Select Ship",
            allowClear: true
        });

        // Handle ship selection change
        $('#ship').on('change', function() {
            var selectedShip = $(this).find('option:selected').text();
            $('#selectedShip').text(selectedShip ? 'Ship Name : ' + selectedShip : '');
            var shipId = $(this).val();
            if (shipId) {
                $.ajax({
                    url: '{{ route('get.ancestors') }}',
                    type: 'GET',
                    data: {
                        ship_id: shipId
                    },
                    success: function(data) {
                        // Clear previous data
                        $('#reportTable tbody').empty();

                        // Populate the table
                        if (data.length) {
                            $.each(data, function(index, ancestor) {
                                $('#reportTable tbody').append('<tr><td>' + ancestor
                                    .ancestor_surname + ' ' + ancestor
                                    .given_name + '</td>' +
                                    '<td>' + (ancestor.gender == '1' ? 'Male' :
                                        'Female') + '</td>' +
                                    '<td>' + (ancestor.member_names ? ancestor
                                        .member_names : ' ') + '</td></tr>'
                                    ); // Displaying member names
                            });
                        } else {
                            $('#reportTable tbody').html(
                                '<tr><td colspan="4" class="text-center">No Ancestors Found</td></tr>'
                                );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                        console.log(xhr
                            .responseText);
                    }
                });
            } else {
                $('#reportTable tbody').empty();
            }
        });
    });
</script>
