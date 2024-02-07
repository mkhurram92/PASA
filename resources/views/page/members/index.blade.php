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
            background-color: #0d6efd;
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
                    <h3 class="page-title">Members List</h3>
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
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <label style="padding: 10px;" for="date-range">Date Range:</label>
                                <input style="padding: 10px 20px;" type="text" id="date-range">
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
                    title: 'ID',
                    field: 'id',
                    hozAlign: "center",
                    vertAlign: "middle",
                    headerFilter: "input",
                    width: "8%",
                    headerFilterPlaceholder: 'Filter by ID'
                },
                {
                    title: 'Given Name',
                    field: 'given_name',
                    hozAlign: "center",
                    vertAlign: "middle",
                    headerFilter: "input",
                    headerFilterPlaceholder: 'Filter by Name'
                },
                {
                    title: 'Family Name',
                    field: 'family_name',
                    hozAlign: "center",
                    vertAlign: "middle",
                    headerFilter: "input",
                    headerFilterPlaceholder: 'Filter by Family Name'
                },
                {
                    title: 'Email Address',
                    field: 'email',
                    hozAlign: "center",
                    vertAlign: "middle",
                    headerFilter: "input",
                    headerFilterPlaceholder: 'Filter by Email'
                },
                {
                    title: 'Approval Date',
                    field: 'approved_at',
                    hozAlign: "center",
                    vertAlign: "middle",
                    headerFilterPlaceholder: 'Filter by Approval Date',
                    headerFilter: "input",
                    formatter: function(cell, formatterParams, onRendered) {
                        var date = new Date(cell.getValue());

                        var day = date.getDate().toString().padStart(2, '0');
                        var month = (date.getMonth() + 1).toString().padStart(2, '0');
                        var year = date.getFullYear();
                        var hours = date.getHours().toString().padStart(2, '0');
                        var minutes = date.getMinutes().toString().padStart(2, '0');
                        var seconds = date.getSeconds().toString().padStart(2, '0');
                        var ampm = hours >= 12 ? 'pm' : 'am';

                        // Convert 24-hour format to 12-hour format
                        hours = (hours % 12) || 12;

                        var formattedDate = day + '/' + month + '/' + year + ' ' + hours + ':' +
                            minutes +
                            ':' + seconds + ' ' + ampm;

                        return formattedDate;
                    }
                },
                {
                    title: 'Membership Type',
                    field: 'membership_type.name',
                    hozAlign: "center",
                    vertAlign: "middle",
                    headerFilter: "select",
                    headerFilterPlaceholder: 'Filter by Membership Type',
                    headerFilterParams: {
                        values: membershipTypeOptions
                    },
                    formatter: function(cell, formatterParams, onRendered) {
                        // Access the cell value
                        var membershipType = cell.getValue();

                        // Add custom styling based on membership type
                        var style = '';
                        if (membershipType === 'Pioneer Membership') {
                            style = 'color: green;';
                        } else if (membershipType === 'Pioneer Life Membership') {
                            style = 'color: limegreen;';
                        } else if (membershipType === 'Pioneer Partner Membership') {
                            style = 'color: blue;';
                        } else if (membershipType === 'Associate Pioneer Membership') {
                            style = 'color: red;';
                        } else if (membershipType === 'Associate Life Membership') {
                            style = 'color: pink;';
                        } else if (membershipType === 'Junior Pioneer Membership') {
                            style = 'color: purple;';
                        } else if (membershipType === 'Friend Membership') {
                            style = 'color: orange;';
                        } else if (membershipType === 'Friend Partner Membership') {
                            style = 'color: turquoise;';
                        } else if (membershipType === 'Honorary Life Membership') {
                            style = 'color: cyan;';
                        } else if (membershipType === 'Complementary Membership') {
                            style = 'color: magenta;';
                        }
                        // Wrap the text inside a span with the specified style
                        var formattedValue = '<span style="' + style + '">' + membershipType + '</span>';

                        // Return the formatted content
                        return formattedValue;
                    }
                },
                {
                    title: 'Membership Status',
                    field: 'membership_status.name',
                    hozAlign: "center",
                    vertAlign: "middle",
                    headerFilter: "select",
                    headerFilterPlaceholder: 'Filter by Membership Status',
                    headerFilterParams: {
                        values: membershipStatusOptions
                    },
                    formatter: function(cell, formatterParams, onRendered) {
                        // Access the cell value
                        var membershipStatus = cell.getValue();

                        // Add custom styling based on membership type
                        var style = '';
                        if (membershipStatus === 'New Applicant') {
                            style = 'color: green;';
                        } else if (membershipStatus === 'Active') {
                            style = 'color: magenta;';
                        } else if (membershipStatus === 'Resigned') {
                            style = 'color: turquoise;';
                        } else if (membershipStatus === 'Non-renewal') {
                            style = 'color: red;';
                        } else if (membershipStatus === 'Deceased') {
                            style = 'color: orange;';
                        }
                        // Wrap the text inside a span with the specified style
                        var formattedValue = '<span style="' + style + '">' + membershipStatus + '</span>';

                        // Return the formatted content
                        return formattedValue;
                    }
                }, {
                    title: "Actions",
                    field: "actions",
                    hozAlign: "center",
                    width: "8%",
                    vertAlign: "middle",
                    formatter: function(cell, formatterParams, onRendered) {
                        var id = cell.getData().id;
                        return '<div class="button-container">' +
                            '<button class="fa fa-eye view-button" onclick="redirectToView(' +
                            id +
                            ')"></button>' +
                            '</div>';
                    }
                }
            ],
            pagination: "local",
            paginationSize: 20,
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
