<link href="https://unpkg.com/tabulator-tables@5.0.7/dist/css/tabulator.min.css" rel="stylesheet">
<!-- Tabulator JS -->
<script src="https://unpkg.com/tabulator-tables@5.0.7/dist/js/tabulator.min.js"></script>
<!-- Axios for AJAX requests -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

@include('layout.header')
@include('layout.sidebar')

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
                    <h3 class="page-title">Login Logs</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        
                        <div class="table-responsive">
                            <div id="login-log-table"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script>
    var table = new Tabulator("#login-log-table", {
        layout: "fitColumns",
        pagination: "local",
        paginationSize: 25,
        columns: [{
                title: "ID",
                field: "user.id",
                sorter: "number",
                hozAlign: "center"
            },
            {
                title: "Email",
                field: "user.email",
                sorter: "string",
                hozAlign: "center"
            },
            {
                title: "IP Address",
                field: "ip_address",
                sorter: "string",
                hozAlign: "center"
            },
            {
                title: "User Agent",
                field: "user_agent",
                sorter: "string",
                hozAlign: "center"
            },
            {
                title: "Login Time",
                field: "login_at",
                sorter: "datetime",
                hozAlign: "center"
            },
        ],
    });

    // Fetch data from the server and load it into Tabulator
    axios.get("{{ route('login.logs.data') }}")
        .then(function (response) {
            table.setData(response.data);
        })
        .catch(function (error) {
            console.error("Error fetching login logs:", error);
        });
</script>
@endsection

@include('layout.footer')