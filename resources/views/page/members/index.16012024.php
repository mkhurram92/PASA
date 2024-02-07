@include('layout.header')
@include('layout.sidebar')
<!-- app-content start-->
<div class="app-content main-content">
    <div class="side-app">
        <div class="container-fluid main-container">

            <!--Page header-->
            <div class="page-header">
                <div class="page-leftheader">
                    <h4 class="page-title"></h4>
                </div>
                <div class='page-rightheader'>
                    <a href="#"class="btn btn-primary view-record">Add a Member</a>
                </div>
            </div>
            <!--End Page header-->

            <!-- Row -->
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
                        <div class="card-header  justify-content-between">
                            <h3 class="card-title">Member List</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                {{ $dataTable->table() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->

        </div>
    </div>
</div>

<!-- MODAL EFFECTS -->
<div id="crud"></div>

@section('scripts')
    <script>
        var dt_members_elem = $("#members-table"),
            dt_ship = "";
        window.addEventListener("DOMContentLoaded", function() {

            $(document).on("click", "#dropdownMenuButton", function(e) {
                var id = $(this).attr('data-id');
                $(this).next().toggleClass('show');
            });

            $(document).on("click", ".view-record", function(e) {
                $.get($(e.target).attr("data-href"), form => {
                    $('#crud').html(form.html);
                    $('#crud').find(".modal").modal('show');
                })
            });

            const initDataTable = () => {
                if ($.fn.DataTable.isDataTable($('#members-table'))) {
                    $('#members-table').DataTable().destroy();
                }
                // user datatable
                if (typeof dt_ship !== "undefined") {
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
                                data: 'member_type'
                            },
                            {
                                data: 'approved_at'
                            },
                            {
                                data: 'membership_status'
                            },
                            {
                                data: 'actions'
                            },
                        ],
                        dom: '<"row mx-2"' +
                            '<"col-md-2"<"me-3"l>>' +
                            '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>' +
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
                                    columns: [0, 1, 2, 3, 4, 5, 6],
                                },
                                customize: function(win) {
                                    //customize print view for dark
                                    $(win.document.body)
                                        .css('color', config.colors
                                            .headingColor)
                                        .css('border-color', config
                                            .colors
                                            .borderColor)
                                        .css('background-color', config
                                            .colors
                                            .body);
                                    $(win.document.body)
                                        .find('table')
                                        .addClass('compact')
                                        .css('color', 'inherit')
                                        .css('border-color', 'inherit')
                                        .css('background-color',
                                            'inherit');
                                }
                            }, {
                                extend: 'csv',
                                title: 'Member List',
                                text: 'Csv',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6],
                                }
                            }, {
                                extend: 'excel',
                                title: 'Member List',
                                text: 'Excel',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6],
                                }
                            }, {
                                extend: 'pdf',
                                title: 'Member List',
                                text: 'Pdf',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6],
                                }
                            }, {
                                extend: 'copy',
                                title: 'members',
                                text: 'Copy',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6],
                                }
                            }]
                        }],
                    });
                }
            }
            initDataTable()
            $(document).on("change", "#daterange-btn", function() {
                initDataTable()
            })
            $(document).on("submit", "#crud form", function() {
                initDataTable()
            })
        })
    </script>
@endsection
<!-- app-content end-->
@include('layout.footer')
