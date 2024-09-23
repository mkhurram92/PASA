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
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="1000000">ALL</option>
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
    function nullToEmptyString(value) {
        return value === null ? '' : value;
    }

    var membersData = <?php echo json_encode($members); ?>;
    var membershipTypeOptions = <?php echo json_encode($membershipTypeOptions); ?>;
    var membershipStatusOptions = <?php echo json_encode($membershipStatusOptions); ?>;

    //Filter Ship Name - Year
    membersData = membersData.map(member => {
        member.shipNameYear = '';

        if (member.ancestors && member.ancestors.length > 0) {
            let ancestor = member.ancestors[0];

            if ((ancestor.source_of_arrival == 1 || ancestor.source_of_arrival == 2) && ancestor
                .mode_of_travel) {
                let shipName = ancestor.mode_of_travel.ship ? ancestor.mode_of_travel.ship.name_of_ship : '';
                let year = ancestor.mode_of_travel.year;
                member.shipNameYear = `${shipName} - ${year}`;
            }
        }

        if (member.journal === 0) {
            member.journalValue = 'Email';
        } else {
            member.journalValue = 'Post';
        }

        return member;
    });

    function mergeDateFields(value, data, type, params, component) {
        let year = data.additional_info.year_membership_approved || '';
        let month = data.additional_info.month_membership_approved || '';
        let day = data.additional_info.date_membership_approved || '';

        if (year && month && day) {
            if (month.length === 1) month = '0' + month;
            if (day.length === 1) day = '0' + day;
            return `${year}-${month}-${day}`;
        } else if (year && month) {
            if (month.length === 1) month = '0' + month;
            return `${year}-${month}`;
        } else if (year) {
            return `${year}`;
        } else {
            return '';
        }
    }

    function mergeDateFields1(value, data, type, params, component) {
        let year = data.additional_info.year_membership_end || '';
        let month = data.additional_info.month_membership_end || '';
        let day = data.additional_info.date_membership_end || '';

        if (year && month && day) {
            if (month.length === 1) month = '0' + month;
            if (day.length === 1) day = '0' + day;
            return `${year}-${month}-${day}`;
        } else if (year && month) {
            if (month.length === 1) month = '0' + month;
            return `${year}-${month}`;
        } else if (year) {
            return `${year}`;
        } else {
            return '';
        }
    }

    function volunteerYesNo(value, data, type, params, component) {
        let volunteer = data.additional_info.volunteer;

        if (volunteer === 1) {
            return "Yes";
        } else if (volunteer === 0) {
            return "No";
        } else {
            return '';
        }
    }

    function mergePhoneAndAreaCode(value, data, type, params, component) {
        let areaCode = data.contact.area_code;
        let phone = data.contact.phone;

        if (areaCode && phone) {
            return `(${areaCode}) ${phone}`;
        } else if (phone) {
            return phone;
        } else {
            return '';
        }
    }

    function mergeBirthDate(cell, formatterParams) {
        // Access the full row data
        let data = cell.getData();

        let year = data.year_of_birth || '';
        let month = data.month_of_birth || '';
        let day = data.date_of_birth || '';

        // The same logic for formatting
        if (year && month && day) {
            if (month.length === 1) month = '0' + month;
            if (day.length === 1) day = '0' + day;
            return `${year}-${month}-${day}`;
        } else if (year && month) {
            if (month.length === 1) month = '0' + month;
            return `${year}-${month}`;
        } else if (year) {
            return `${year}`;
        } else {
            return '';
        }
    }

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
                headerFilterPlaceholder: 'Filter by Membership No',
                mutator: nullToEmptyString
            },
            {
                title: 'Family Name',
                field: 'family_name',
                hozAlign: "left",
                vertAlign: "middle",
                headerFilter: "input",
                headerFilterPlaceholder: 'Filter by Family Name',
                mutator: nullToEmptyString
            },
            {
                title: 'Given Name/s',
                field: 'given_name',
                hozAlign: "left",
                vertAlign: "middle",
                headerFilter: "input",
                headerFilterPlaceholder: 'Filter by Given Name/s',
                mutator: nullToEmptyString
            },
            {
                title: "Birth Date",
                field: "date_of_birth_combined",
                mutator: function(value, data, type, params, component) {
                    let date = data.date_of_birth ? String(data.date_of_birth).padStart(2, '0') : "";
                    let month = data.month_of_birth ? String(data.month_of_birth).padStart(2, '0') : "";
                    let year = data.year_of_birth ? String(data.year_of_birth) : "";

                    if (year) {
                        if (month) {
                            if (date) {
                                return `${year}-${month}-${date}`;
                            } else {
                                return `${year}-${month}`;
                            }
                        } else {
                            return `${year}`;
                        }
                    } else {
                        return "";
                    }
                },
                visible: false,
                download: true
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
                },
                mutator: nullToEmptyString
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
                },
                mutator: nullToEmptyString
            },
            {
                title: 'Journal',
                field: 'journalValue',
                hozAlign: "left",
                vertAlign: "middle",
                headerFilter: "select",
                headerFilterParams: {
                    values: {
                        "Email": "Email",
                        "Post": "Post"
                    }
                },
                headerFilterPlaceholder: 'Filter by Journal',
                mutator: nullToEmptyString
            },
            {
                title: 'Email Address',
                field: 'contact.email',
                hozAlign: "left",
                vertAlign: "middle",
                headerFilter: "input",
                headerFilterPlaceholder: 'Filter by Email',
                mutator: nullToEmptyString
            },
            {
                title: 'Ship Name - Year',
                field: 'shipNameYear',
                hozAlign: "left",
                vertAlign: "middle",
                headerFilter: "input",
                headerFilterPlaceholder: 'Filter by Ship Name - Year',
                mutator: nullToEmptyString
            },
            {
                title: 'Approval Date',
                field: 'additional_info.date_membership_approved',
                hozAlign: "left",
                vertAlign: "middle",
                headerFilter: "input",
                headerFilterPlaceholder: 'Filter by Ship Name - Year',
                mutator: mergeDateFields,
                visible: false,
                download: true
            },
            {
                title: 'Date Membership Ended',
                field: 'additional_info.date_membership_end',
                mutator: mergeDateFields1,
                visible: false,
                download: true
            },
            {
                title: 'Address Line 1',
                field: 'address.unit_no',
                visible: false,
                download: true,
                mutator: nullToEmptyString
            },
            {
                title: 'Address Line 2',
                field: 'address.number_street',
                visible: false,
                download: true,
                mutator: nullToEmptyString
            },
            {
                title: 'City / Town / Suburb',
                field: 'address.suburb',
                visible: false,
                download: true,
                mutator: nullToEmptyString
            },
            {
                title: 'State',
                field: 'address.state.name',
                visible: false,
                download: true,
                mutator: nullToEmptyString
            },
            {
                title: 'Country',
                field: 'address.country.name',
                visible: false,
                download: true,
                mutator: nullToEmptyString
            },
            {
                title: 'Postcode',
                field: 'address.post_code',
                visible: false,
                download: true,
                mutator: nullToEmptyString
            },
            {
                title: 'Home Phone(Inc Area Code)',
                field: 'contact.area_code',
                mutator: mergePhoneAndAreaCode,
                visible: false,
                download: true,
            },
            {
                title: 'Mobile Phone',
                field: 'contact.mobile',
                visible: false,
                download: true,
                mutator: nullToEmptyString
            },
            {
                title: "Volunteer",
                field: "additional_info.volunteer",
                mutator: volunteerYesNo,
                visible: false,
                download: true
            },
            {
                title: 'General Notes',
                field: 'additional_info.general_notes',
                visible: false,
                download: true,
                mutator: nullToEmptyString
            },
            {
                title: "Action",
                field: "actions",
                hozAlign: "center",
                download: false,
                vertAlign: "middle",
                width: "7%",
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
            sheetName: "Member List"
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