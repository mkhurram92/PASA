@include('layout.header')
@include('layout.sidebar')

<!-- app-content start-->
<div class="app-content main-content">
    <style>
        .tabulator-toolbar {
            background-color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .tabulator {
            font-size: 16px;
            border: none;
        }

        .tabulator-col-title {
            text-align: center;
            font-size: 18px;
            padding: 8px;
            background-color: #D3D3D3;
            border: none;
        }

        .tabulator-row .tabulator-cell {
            border-right: none;
            font-size: 16px;
        }

        .tabulator-header-filter input {
            text-align: center;
            font-size: 16px;
        }

        .tabulator-tableholder {
            background-color: white;
        }

        .custom-button {
            padding: 10px;
            width: 150px;
            height: 45px;
            border: none;
            border-radius: 5px;
            background-color: #3498db;
            color: white;
            cursor: pointer;
        }

        .custom-button:hover {
            background-color: #45a049;
        }

        .button-container {
            display: flex;
        }

        .button-container button {
            padding: 12px 12px;
            margin: 5px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            font-size: 14px;
        }

        .button-container button.edit-button {
            background-color: #3498db;
            color: #fff;
        }

        .button-container button.view-button {
            background-color: #2ecc71;
            color: #fff;
        }

        .button-container button:hover {
            opacity: 0.8;
        }
    </style>
    <div class="side-app">
        <div class="container-fluid main-container">
            <!-- Page header -->
            <div class="page-header">
                <div class="page-leftheader">
                    <h3 class="page-title">Member's Juniors</h3>
                </div>
                <div class="card-header d-flex justify-content-between align-items-center">
                    <a class="btn btn-primary" href="{{ route('JuniorForm') }}" >
                        <i class="fa fa-plus-circle" style="font-size:24px;"></i>
                    </a>
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

                        <div class="card">
                            <div class="card-body p-2">
                                <div class="tabulator-toolbar">
                                    @if (auth()->user()->role_id == 1)
                                    Show <select style="padding:10px;" id="pageSizeDropdown">
                                        <option value="1000000">ALL</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    <button class="custom-button" type="button" id="printTable"
                                        onclick="printData()">Print</button>
                                    <button class="custom-button" id="download-csv">Download CSV</button>
                                    <button class="custom-button" id="download-xlsx">Download EXCEL</button>
                                    <button class="custom-button" id="download-pdf">Download PDF</button>
                                    <button class="custom-button" id="reset-button">Reset Filter</button>
                                    @endif
                                </div>
                                <div class="table-responsive">
                                    <div id="juniors-table"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script src="https://unpkg.com/tabulator-tables@5.4.3/dist/js/tabulator.min.js"></script>
<link href="https://unpkg.com/tabulator-tables@5.4.3/dist/css/tabulator.min.css" rel="stylesheet">
<script>
    var juniorsData = @json($juniors);

    var table = new Tabulator("#juniors-table", {
        data: juniorsData,
        layout: "fitColumns",
        maxHeight:"100%",
        columns: [{
                title: "Given Name",
                field: "given_name",
                headerFilter: "input",
                headerFilterPlaceholder: 'Search by Given Name',
            },
            {
                title: "Family Name",
                field: "family_name",
                headerFilterPlaceholder: 'Search by Family Name',
                headerFilter: "input"
            },
            {
                title: "Preferred Name",
                field: "preferred_name",
                headerFilter: "input",
                headerFilterPlaceholder: 'Search by Preferred Name'
            },
            {
                title: "Birth Date",
                field: "date_of_birth",
                headerFilter: "input",
                headerFilterPlaceholder: 'Search by Birth Date'

            },
            {
                title: "Gender",
                field: "gender",
                headerFilter: "input",
                headerFilterPlaceholder: 'Search by Gender',
                formatter: function(cell) {
                    const value = cell.getValue();
                    return value === 1 ? "Male" : "Female";
                }
            },
            {
                title: "Action",
                field: "actions",
                hozAlign: "center",
                vertAlign: "middle",
                download: false,
                width: "8%",
                formatter: function(cell, formatterParams, onRendered) {
                    var id = cell.getData().id;
                    return '<div class="button-container">' +
                        '<button class="fa fa-eye view-button" onclick="redirectToView(' + id +
                        ')"> </button>' +
                        '</div>';
                }
            }
        ],
        pagination: "local",
        paginationSize: 25,
        placeholder: "No Data Available"
    });
</script>
@endsection

@include('layout.footer')