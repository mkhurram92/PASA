@include('layout.header')
@include('layout.sidebar')
<!-- app-content start-->
<div class="app-content main-content">
    <div class="side-app">
        <div class="container-fluid main-container">

            <!--Page header-->
            <!--<div class="page-header">-->
            <!--    <div class="page-rightheader ms-auto d-lg-flex d-none">-->
            <!--        <div class="ms-5 mb-0">-->
            <!--            <input type="text" id="daterange-btn" class="form-control">-->
            <!--            <a class="btn btn-white date-range-btn" href="javascript:void(0)" >-->
            <!--                <svg class="header-icon2 me-3" x="1008" y="1248" viewBox="0 0 24 24"-->
            <!--                    height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">-->
            <!--                    <path d="M5 8h14V6H5z" opacity=".3" />-->
            <!--                    <path-->
            <!--                        d="M7 11h2v2H7zm12-7h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2zm-4 3h2v2h-2zm-4 0h2v2h-2z" />-->
            <!--                </svg> <span>Select Date-->
            <!--                    <i class="fa fa-caret-down"></i></span>-->
            <!--            </a>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <!--End Page header-->

            <!-- Row -->
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h3 class="card-title">User Table</h3>
                            @can('user-create')
                                <div class="text-right">
                                    <a class="modal-effect btn btn-primary btn-block" data-bs-effect="effect-slide-in-right"
                                        id="createUser">Create User</a>
                                </div>
                            @endcan
                        </div>
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
        var dt_user_elem = $("#users-table"),
            dt_user = "";
        window.addEventListener("DOMContentLoaded", function() {
            const initDataTable = () => {
                if ($.fn.DataTable.isDataTable($('#users-table'))) {
                    $('#users-table').DataTable().destroy();
                }
                // user datatable
                if (typeof dt_user !== "undefined") {
                    dt_user = dt_user_elem.DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: "{{ route('user.index') }}",
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
                                data: 'name'
                            },
                            {
                                data: 'email'
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
                                    title: 'Users',
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
                                    title: 'Users',
                                    text: 'Csv',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3],
                                    }
                                },
                                {
                                    extend: 'excel',
                                    title: 'Users',
                                    text: 'Excel',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3],
                                    }
                                },
                                {
                                    extend: 'pdf',
                                    title: 'Users',
                                    text: 'Pdf',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3],
                                    }
                                },
                                {
                                    extend: 'copy',
                                    title: 'Users',
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
            $('#createUser').click(function() {
                $.get("{{ route('user.create') }}", form => {
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
            $(document).on("submit", "#crud form", function() {
                initDataTable()
            })
        })
    </script>
@endsection

@include('layout.footer')
