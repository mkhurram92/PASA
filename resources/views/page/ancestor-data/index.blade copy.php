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
                        <div class="card-header justify-content-between">
                            <h3 class="card-title">Ancestor List</h3>
                            @can('ancestor-create')
                                <div class="text-right">
                                    <a class="btn btn-primary btn-block" href="{{ route('ancestor-data.create') }}">Add a Pioneer
                                        Ancestor</a>
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
        var dt_ancestor_data_elem = $("#ancestor-data-table"),
            dt_ancestor_data = "";
        window.addEventListener("DOMContentLoaded", function() {
            const initDataTable = () => {
                if ($.fn.DataTable.isDataTable($('#ancestor-data-table'))) {
                    $('#ancestor-data-table').DataTable().destroy();
                }
                // user datatable
                if (typeof dt_ancestor_data !== "undefined") {
                    dt_ancestor_data = dt_ancestor_data_elem.DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: "{{ route('ancestor-data.index') }}",
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
                                data: 'ancestor_surname'
                            },
                            // {
                            //     data: 'maiden_surname'
                            // },
                            {
                                data: 'given_name'
                            },
                            {
                                data: 'gender'
                            },
                            // {
                            //     data: 'source_of_arrival'
                            // },
                            // {
                            //     data: 'mode_of_travel_native_bith'
                            // },
                            {
                                data: 'date_of_birth'
                            },
                            // {
                            //     data: 'from'
                            // },
                            {
                                data: 'occupation'
                            },
                            {
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
                                    title: 'Ancestors',
                                    text: 'Print',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3],
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
                                },
                                {
                                    extend: 'csv',
                                    title: 'Ancestors',
                                    text: 'Csv',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3],
                                    }
                                },
                                {
                                    extend: 'excel',
                                    title: 'Ancestors',
                                    text: 'Excel',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3],
                                    }
                                },
                                {
                                    extend: 'pdf',
                                    title: 'Ancestors',
                                    text: 'Pdf',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3],
                                    }
                                },
                                {
                                    extend: 'copy',
                                    title: 'Ancestors',
                                    text: 'Copy',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3],
                                    }
                                }
                            ]
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
