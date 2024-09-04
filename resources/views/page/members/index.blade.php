<!-- Add these updated CDN links to Bootstrap and Tabulator -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/tabulator-tables@5.1.5/dist/js/tabulator.min.js"></script>

<!-- Your existing CDN links for other libraries -->
<link href="https://unpkg.com/tabulator-tables@5.1.5/dist/css/tabulator.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.17.0/dist/xlsx.full.min.js"></script>
<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.20/jspdf.plugin.autotable.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>


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
            font-size: 15px;
            border: none;

        }

        .tabulator-col-title {
            text-align: center;
            font-size: 16px;
            padding: 8px;
            background-color: #D3D3D3;
            border: none;
        }

        .tabulator-row .tabulator-cell {
            border-right: none;
        }

        .tabulator-header-filter input {
            text-align: center;
            font-size: 14px;
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
            background-color: #3498db;
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
            /* Blue color for Edit button */
            color: #fff;
        }

        .button-container button.view-button {
            background-color: #2ecc71;
            /* Green color for View button */
            color: #fff;
        }

        .button-container button:hover {
            opacity: 0.8;
            /* Reduce opacity on hover */
        }
    </style>

    <div class="side-app">
        <div class="container-fluid main-container">
            <div class="page-header">
                <div class="page-leftheader">
                    <h3 class="page-title">Membership</h3>
                </div>
                <div class="card-header d-flex justify-content-between align-items-center">
                    <a class="btn btn-primary" href="{{ route('members.create') }}" id="add-record">
                        <i class="fa fa-plus-circle" style="font-size:24px;"></i>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 p-12">
                    @if ($errors->any() || session('error') || session('success'))
                    <div class="card">
                        <div class="card-body">
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
                        </div>
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="tabulator-toolbar">
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
                            </div>
                            <div class="table-responsive">
                                <div id="members-table"></div>
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
    var membersData = <?php echo json_encode($members); ?>;
    var membershipTypeOptions = <?php echo json_encode($membershipTypeOptions); ?>;
    var membershipStatusOptions = <?php echo json_encode($membershipStatusOptions); ?>;

    var table = new Tabulator("#members-table", {
        data: membersData,
        layout: "fitColumns",
        columns: [{
                title: 'Membership No',
                field: 'additional_info.membership_number',

                hozAlign: "right",
                vertAlign: "middle",
                headerFilter: "input",
                width: "8%",
                headerFilterPlaceholder: 'Filter by Membership No'
            },
            {
                title: 'Family Name',
                field: 'family_name',
                hozAlign: "left",
                vertAlign: "middle",
                headerFilter: "input",
                headerFilterPlaceholder: 'Filter by Family Name'
            },
            {
                title: 'Given Name/s',
                field: 'given_name',
                hozAlign: "left",
                vertAlign: "middle",
                headerFilter: "input",
                headerFilterPlaceholder: 'Filter by Given Name/s'
            },
            {
                title: 'Membership Type',
                field: 'subscription_plan.name',
                hozAlign: "left",
                vertAlign: "middle",
                headerFilter: "select",
                headerFilterPlaceholder: 'Filter by Membership Type',
                headerFilterParams: {
                    values: membershipTypeOptions
                }
            },
            {
                title: 'Membership Status',
                field: 'membership_status.name',
                hozAlign: "left",
                vertAlign: "middle",
                headerFilter: "select",
                headerFilterPlaceholder: 'Filter by Membership Status',
                headerFilterParams: {
                    values: membershipStatusOptions
                }
            },
            {
                title: 'Journal',
                field: 'journal',
                hozAlign: "left",
                vertAlign: "middle",
                headerFilter: "select",
                headerFilterParams: {
                    values: {
                        "0": "Email",
                        "1": "Post",
                    }
                },
                headerFilterPlaceholder: 'Filter by Journal',
                formatter: function(cell, formatterParams, onRendered) {
                    var value = cell.getValue();
                    return value == 0 ? "Email" : "Post";
                }
            },
            {
                title: 'Email Address',
                field: 'contact.email',
                hozAlign: "left",
                vertAlign: "middle",
                headerFilter: "input",
                headerFilterPlaceholder: 'Filter by Email'

            },
            {
                title: "Action",
                field: "actions",
                hozAlign: "center",
                width: "8%",
                download: false,
                vertAlign: "middle",
                formatter: function(cell, formatterParams, onRendered) {
                    var id = cell.getData().id;
                    return '<div class="button-container">' +
                        '<button class="fa fa-eye view-button" onclick="redirectToView(' +
                        id +
                        ')"> View</button>' +
                        '</div>';
                }
            }
        ],
        pagination: "local",
        paginationSize: 25,
        placeholder: "No Data Available"
    });

    function redirectToView(id) {
        var baseUrl = 'members/view-member/';
        var url = baseUrl + id;
        window.location.href = url;
    }

    // Add a reset button
    var resetButton = document.getElementById("reset-button");


    resetButton.addEventListener("click", function() {
        table.clearFilter();
        table.clearHeaderFilter();
    });

    $("#pageSizeDropdown").on("change", function() {
        var selectedPageSize = parseInt($(this).val(), 10);
        table.setPageSize(selectedPageSize);
    });

    function printData() {
        table.print(false, true);
    }
    //trigger download of data.csv file
    document.getElementById("download-csv").addEventListener("click", function() {
        table.download("csv", "Member List.csv");
    });

    //trigger download of data.xlsx file
    document.getElementById("download-xlsx").addEventListener("click", function() {
        table.download("xlsx", "Member List.xlsx", {
            sheetName: "PASA01"
        });
    });

    //trigger download of data.pdf file
    document.getElementById("download-pdf").addEventListener("click", function() {
        table.download("pdf", "Member List.pdf", {
            orientation: "landscape",
            title: "Member List",
        });
    });
</script>
@endsection

<!-- app-content end-->
@include('layout.footer')