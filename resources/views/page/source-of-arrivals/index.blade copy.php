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
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
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
                            <h3 class="card-title">Source of Arrivals Table</h3>
                            @can("source-of-arrival-create")
                            <div class="text-right">
                                <a class="modal-effect btn btn-primary btn-block" href="javascript:void(0)" id="create-record" data-bs-effect="effect-slide-in-right">Create Arrival</a>
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
    var dt_mode_of_arrivals_elem = $("#sourceofarrivals-table")
        , dt_mode_of_arrivals = "";
    window.addEventListener("DOMContentLoaded", function() {
        $('#create-record').click(function() {
            $.get("{{ route('source-of-arrivals.create') }}", form => {
                $('#crud').html(form.html);
                $('#crud').find(".modal").modal('show');
            })
        });

        $(document).on("click", ".edit-record,.view-record", function(e) {
            e.preventDefault();
            $.get($(e.target).attr("data-href"), form => {
                $('#crud').html(form.html);
                $('#crud').find(".modal").modal('show');
            })
        });

        const initDataTable = () => {
            if ($.fn.DataTable.isDataTable($('#sourceofarrivals-table'))) {
                $('#sourceofarrivals-table').DataTable().destroy();
            }
            // user datatable
            if (typeof dt_mode_of_arrivals !== "undefined") {
                dt_mode_of_arrivals = dt_mode_of_arrivals_elem.DataTable({
                    processing: true
                    , serverSide: true
                    , ajax: {
                        url: "{{ route('source-of-arrivals.index') }}"
                        , type: 'GET'
                        , data: {
                            date: $("#daterange-btn").val()
                        }
                    }
                    , columns: [
                        // columns according to JSON
                        {
                            data: 'id'
                        }
                        , {
                            data: 'name'
                        }
                        , {
                            data: 'action'
                        }
                    , ]
                    , dom: '<"row mx-2"' +
                        '<"col-md-2"<"me-3"l>>' +
                        '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>' +
                        '>t' +
                        '<"row mx-2"' +
                        '<"col-sm-12 col-md-6"i>' +
                        '<"col-sm-12 col-md-6"p>' +
                        '>'
                    , language: {
                        sLengthMenu: '_MENU_'
                        , search: ''
                        , searchPlaceholder: 'Search..'
                    },
                    // Buttons with Dropdown
                    buttons: [{
                        extend: 'collection'
                        , className: 'btn btn-label-primary dropdown-toggle mx-3'
                        , text: 'Export'
                        , buttons: [{
                                extend: 'print'
                                , title: 'Source of arrivals'
                                , text: 'Print'
                                , className: 'dropdown-item'
                                , exportOptions: {
                                    columns: [0, 1]
                                , }
                                , customize: function(win) {
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
                            }
                            , {
                                extend: 'csv'
                                , title: 'Source of arrivals'
                                , text: 'Csv'
                                , className: 'dropdown-item'
                                , exportOptions: {
                                    columns: [0, 1]
                                , }
                            }
                            , {
                                extend: 'excel'
                                , title: 'Source of arrivals'
                                , text: 'Excel'
                                , className: 'dropdown-item'
                                , exportOptions: {
                                    columns: [0, 1]
                                , }
                            }
                            , {
                                extend: 'pdf'
                                , title: 'Source of arrivals'
                                , text: 'Pdf'
                                , className: 'dropdown-item'
                                , exportOptions: {
                                    columns: [0, 1]
                                , }
                            }
                            , {
                                extend: 'copy'
                                , title: 'Source of arrivals'
                                , text: 'Copy'
                                , className: 'dropdown-item'
                                , exportOptions: {
                                    columns: [0, 1]
                                , }
                            }
                        ]
                    }]
                , });
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
