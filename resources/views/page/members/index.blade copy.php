@include('layout.header')
@include('layout.sidebar')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@endsection

<!-- app-content start-->
<div class="app-content main-content">
    <div class="side-app">
        <div class="container-fluid main-container">
            <div class="page-header">
                <div class="page-leftheader">
                    <h4 class="page-title">Members List</h4>
                </div>
                <div class="page-rightheader">
                    <a href="" class="btn btn-primary view-record">Add a Member</a>
                </div>
            </div>
            <!--End Page header-->

            <!-- Row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label" style="font-size: 16px;">Name</label>
                                        <input type="text" data-column-index="1" class="form-control"
                                            style="font-size: 16px;" placeholder="Name" id="search-name">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label" style="font-size: 16px;">Family Name</label>
                                        <input type="text" data-column-index="2" class="form-control"
                                            style="font-size: 16px;" placeholder="Name" id="search-family-name">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label" style="font-size: 16px;">E-Mail</label>
                                        <input type="text" class="form-control" data-column-index="3"
                                            style="font-size: 16px;" placeholder="Email" id="search-email">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label" style="font-size: 16px;"
                                            for="membership_type">Membership Type</label>
                                        <select class="form-control" style="font-size: 16px;" data-column-index="4"
                                            name="membership_type" id="membership_type">
                                            <option value="">Select Type</option>
                                            @foreach ($membership_types as $membership_type)
                                                <option value="{{ $membership_type->id }}">{{ $membership_type->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label" style="font-size: 16px;"
                                            for="membership_status">Membership Status</label>
                                        <select class="form-control" style="font-size: 16px;" data-column-index="6"
                                            name="membership_status" id="membership_status">
                                            <option value="">Select Type</option>
                                            @foreach ($membership_status as $status)
                                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label" style="font-size: 16px;">Approval From Date</label>
                                        <input type="date" class="form-control" style="font-size: 16px;"
                                            id="search-date">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label" style="font-size: 16px;">Approval To Date</label>
                                        <input type="date" class="form-control" style="font-size: 16px;"
                                            id="search-end-date">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label" style="font-size: 16px;">&nbsp;</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="button" style="width: 100%;" class="btn btn-secondary"
                                                    id="clear-filters">Clear Filters</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                        <div class="card-body p-10">
                            <div class="table-responsive">
                                {{ $dataTable->table() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EFFECTS -->
<div id="crud"></div>

@section('scripts')
    <script>
        var dt_members_elem = $("#members-table");
        var dt_ship = "";

        // Event listener for date range change and form submission
        $(document).on("change submit", "#daterange-btn, #crud form", function() {
            initDataTable();
        });

        // Event listener for dropdown button
        $(document).on("click", "#dropdownMenuButton", function() {
            var id = $(this).attr('data-id');
            $(this).next().toggleClass('show');
        });

        // Event listener for viewing record
        $(document).on("click", ".view-record", function() {
            $.get($(this).attr("data-href"), function(form) {
                $('#crud').html(form.html);
                $('#crud').find(".modal").modal('show');
            });
        });

        // Function to initialize DataTable
        const initDataTable = () => {
            if ($.fn.DataTable.isDataTable(dt_members_elem)) {
                dt_members_elem.DataTable().destroy();
            }

            dt_ship = dt_members_elem.DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('members.index') }}",
                    type: 'GET',
                    data: {
                        date: $("#daterange-btn").val()
                    }
                },
                columns: [
                    // columns according to JSON
                    {
                        data: 'id'
                    },
                    {
                        data: 'given_name'
                    },
                    {
                        data: 'family_name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'member_type_id',
                    },
                    {
                        data: 'approved_at'
                    },
                    {
                        data: 'member_status_id'
                    },
                    {
                        data: 'actions'
                    },
                ],
                dom: '<"row mx-2"' +
                    '<"col-md-2"<"me-3"l>>' +
                    '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"B>>' +
                    '>t' +
                    '<"row mx-2"' +
                    '<"col-sm-12 col-md-6"i>' +
                    '<"col-sm-12 col-md-6"p>' +
                    '>',
                language: {
                    sLengthMenu: '_MENU_',
                    search: '',
                    searchPlaceholder: 'Search..'
                },
                ordering: false,
                // Buttons with Dropdown
                buttons: [{
                    extend: 'collection',
                    className: 'btn btn-label-primary dropdown-toggle mx-3',
                    text: 'Export',
                    buttons: [{
                        extend: 'print',
                        title: 'Member List',
                        text: 'Print',
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        },
                        customize: function(win) {
                            // customize print view for dark
                            $(win.document.body)
                                .css('color', 'inherit')
                                .css('border-color', 'inherit')
                                .css('background-color', 'inherit');
                            $(win.document.body)
                                .find('table')
                                .addClass('compact');
                        }
                    }, {
                        extend: 'csv',
                        title: 'Member List',
                        text: 'Csv',
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    }, {
                        extend: 'excel',
                        title: 'Member List',
                        text: 'Excel',
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    }, {
                        extend: 'pdf',
                        title: 'Member List',
                        text: 'Pdf',
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    }, {
                        extend: 'copy',
                        title: 'members',
                        text: 'Copy',
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    }]
                }],
            });
        }
        $(document).on("click", "#clear-filters", function() {
            $('#search-name, #search-email, #search-family-name, #membership_type, #membership_status').val('');
            dt_ship.search('').columns().search('').draw();
        });

        // Event listener for text input and dropdown change
        $(document).on("input change", "#search-name, #search-family-name, #search-email, #membership_type, #membership_status", function() {
            var columnIndex = $(this).data('column-index');
            if (columnIndex === undefined) {
                columnIndex = dt_ship.column(this).index();
            }

            // Show alert with the column index
            //alert("Column Index: " + columnIndex);

            // Apply DataTable filter based on the input value or selected option
            dt_ship.columns(columnIndex).search(this.value).draw();
        });


        // Initialize DataTable on document ready
        $(document).ready(function() {
            initDataTable();
        });
    </script>
@endsection

<!-- app-content end-->
@include('layout.footer')
