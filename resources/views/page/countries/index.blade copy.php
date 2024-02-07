@include('layout.header')
@include('layout.sidebar')
<!-- app-content start-->
<div class="app-content main-content">
    <div class="side-app">
        <div class="container-fluid main-container">

            <!--Page header-->
            <div class="page-header">
                <div class="page-leftheader">
                    <h4 class="page-title">Countries</h4>
                </div>
                <!-- <div class="page-rightheader ms-auto d-lg-flex d-none">
                    <div class="ms-5 mb-0">
                        <input type="text" id="daterange-btn" class="form-control">
                    </div>
                </div> -->
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
                            <h3 class="card-title">Country Table</h3>
                            @can('countries-create')
                                <div class="text-right">
                                    <a class="modal-effect btn btn-primary btn-block" href="javascript:void(0)"
                                        id="createNew" data-bs-effect="effect-slide-in-right">Add Country</a>
                                </div>
                            @endcan
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
        var dt_master_elem = $("#country-table"),
            dt_master = "";
        window.addEventListener("DOMContentLoaded", function() {
            $('#createNew').click(function() {
                $.get("{{ route('countries.create') }}", form => {
                    $('#crud').html(form.html);
                    $('#crud').find(".modal").modal('show');
                })
            });
            $(document).on("click", ".edit-record,.view-record", function(e) {
                $.get($(e.target).attr("data-href"), form => {
                    $('#crud').html(form.html);
                    $('#crud').find(".modal").modal('show');
                })
            });


            const initDataTable = () => {
                if ($.fn.DataTable.isDataTable($('#country-table'))) {
                    $('#country-table').DataTable().destroy();
                }
                // user datatable
                if (typeof dt_master !== "undefined") {
                    dt_master = dt_master_elem.DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: "{{ route('countries.index') }}",
                            type: 'GET',
                            data: {
                                date: $("#daterange-btn").val()
                            }
                        },
                        columns: [
                            // columns according to JSON
                            {
                                data: 'id'
                            }, {
                                data: 'name'
                            }, {
                                data: 'code'
                            },
                            {
                                data: 'status'
                            }, {
                                data: 'action'
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
                                title: 'Countries',
                                text: 'Print',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [0, 1, 2],
                                },
                                customize: function(win) {
                                    //customize print view for dark
                                    $(win.document.body)
                                        .css('color', config.colors.headingColor)
                                        .css('border-color', config.colors
                                            .borderColor)
                                        .css('background-color', config.colors
                                            .body);
                                    $(win.document.body)
                                        .find('table')
                                        .addClass('compact')
                                        .css('color', 'inherit')
                                        .css('border-color', 'inherit')
                                        .css('background-color', 'inherit');
                                }
                            }, {
                                extend: 'csv',
                                title: 'Countries',
                                text: 'Csv',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [0, 1, 2],
                                }
                            }, {
                                extend: 'excel',
                                title: 'Countries',
                                text: 'Excel',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [0, 1, 2],
                                }
                            }, {
                                extend: 'pdf',
                                title: 'Countries',
                                text: 'Pdf',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [0, 1, 2],
                                }
                            }, {
                                extend: 'copy',
                                title: 'Countries',
                                text: 'Copy',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [0, 1, 2],
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
