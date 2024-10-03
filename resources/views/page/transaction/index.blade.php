 <!-- External CSS -->
 <link href="https://unpkg.com/tabulator-tables@5.1.5/dist/css/tabulator.min.css" rel="stylesheet">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

 <!-- External JavaScript Libraries -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://unpkg.com/tabulator-tables@5.1.5/dist/js/tabulator.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
 <script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.20/jspdf.plugin.autotable.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

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
                     <h3 class="page-title">Transactions</h3>
                 </div>
                 <div class="card-header d-flex justify-content-between align-items-center">
                     <a class="btn btn-primary" href="{{ route('transaction.create') }}" id="add-record">
                         <i class="fa fa-plus-circle" style="font-size:24px;"></i>
                     </a>
                 </div>
             </div>
             <div class="row">
                 <div class="col-md-12 p-12">
                     <div class="card">
                         <div class="card-body p-2">
                             <div class="tabulator-toolbar">
                                 Show 
                                 <select style="padding:10px;" id="pageSizeDropdown">
                                     <option value="25">25</option>
                                     <option value="50">50</option>
                                     <option value="100">100</option>
                                     <option value="1000000">ALL</option>
                                 </select>
                                 <label style="padding: 10px;" for="start-date">Start Date:</label>
                                 <input style="padding: 10px 20px;" type="text" id="start-date" placeholder="YYYY-MM-DD">
                                 <label style="padding: 10px;" for="end-date">End Date:</label>
                                 <input style="padding: 10px 20px;" type="text" id="end-date" placeholder="YYYY-MM-DD">
                                 <button class="custom-button" id="apply-date-filter">Apply Date Filter</button>
                                 <button class="custom-button" id="printTable" onclick="printData()">Print</button>
                                 <button class="custom-button" id="download-csv">Download CSV</button>
                                 <button class="custom-button" id="download-xlsx">Download EXCEL</button>
                                 <button class="custom-button" id="download-pdf">Download PDF</button>
                                 <button class="custom-button" id="reset-button">Reset Filter</button>
                             </div>
                             <div id="transaction-table"></div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 @section('scripts')
     <script>
        function nullToEmptyString(value) {
                return value === null ? '' : value;
            }

         // Initializing Flatpickr for date range filtering
         flatpickr("#start-date", {
             dateFormat: "Y-m-d"
         });

         flatpickr("#end-date", {
             dateFormat: "Y-m-d"
         });

         var transactionData = {!! json_encode($transactions->toArray()) !!};
         
         // Format the created_at field using moment.js before passing it to Tabulator
         transactionData = transactionData.map(function(transaction) {
             if (transaction.created_at) {
                 transaction.created_at = moment(transaction.created_at).format('YYYY-MM-DD');
             }
             return transaction;
         });

         var gl_code_parent = <?php echo json_encode($gl_code_parent); ?>;
         var transaction_type = <?php echo json_encode($transaction_type); ?>;
         var account_type = <?php echo json_encode($account_type); ?>;

         var table = new Tabulator("#transaction-table", {
             data: transactionData,
             layout: "fitColumns",
             columns: [
                 {
                     title: "Account",
                     field: "gl_codes_parent.name",
                     hozAlign: "left",
                     vertAlign: "middle",
                     headerFilter: "select",
                     headerFilterPlaceholder: 'Filter by Account',
                     headerFilterParams: {
                         values: gl_code_parent
                     },
                     formatter: function(cell, formatterParams, onRendered) {
                         var gl_code_parent = cell.getData().gl_codes_parent;
                         return gl_code_parent ? gl_code_parent.name : 'No Parent';
                     }
                 },
                 {
                     title: "Type",
                     field: "transaction_type.name",
                     hozAlign: "left",
                     vertAlign: "middle",
                     headerFilter: "select",
                     headerFilterPlaceholder: 'Filter by Transaction Type',
                     headerFilterParams: {
                         values: transaction_type
                     },
                     formatter: function(cell, formatterParams, onRendered) {
                         var transaction_type = cell.getValue();
                         var style = '';
                         if (transaction_type === 'Income') {
                             style = 'color: green;';
                         } else if (transaction_type === 'Expenditure') {
                             style = 'color: red;';
                         }
                         return '<span style="' + style + '">' + transaction_type + '</span>';
                     }
                 },
                 {
                     title: "Amount",
                     field: "amount",
                     hozAlign: "left",
                     vertAlign: "middle",
                     headerFilter: "input",
                     headerFilterPlaceholder: 'Search by Amount',
                     formatter: "money",
                     formatterParams: {
                         decimal: ".",
                         thousand: ",",
                         symbol: "$",
                         symbolAfter: false,
                         precision: 2
                     }
                 },
                 {
                     title: "Transaction Account",
                     field: "account.name",
                     hozAlign: "left",
                     vertAlign: "middle",
                     headerFilter: "select",
                     headerFilterPlaceholder: 'Filter by Transaction Account',
                     headerFilterParams: {
                         values: account_type
                     }
                 },
                 {
                     title: "Transaction Date",
                     field: "created_at",
                     hozAlign: "left",
                     vertAlign: "middle",
                     headerFilter: "input",
                     headerFilterPlaceholder: 'Search by Creation Date',
                     formatter: function(cell) {
                         return cell.getValue();
                     }
                 },
                 {
                    title: "Payee Name", 
                    field: "related_name",
                    hozAlign: "left",
                    vertAlign: "middle",
                    headerFilter: "input",
                    headerFilterPlaceholder: 'Filter by Name',
                    formatter: function(cell, formatterParams, onRendered) {
                        return cell.getValue() || 'N/A';
                    },                    
                    mutator: nullToEmptyString
                },
                 {
                     title: "Description",
                     field: "description",
                     hozAlign: "left",
                     vertAlign: "middle",
                     headerFilter: "input",
                     headerFilterPlaceholder: 'Search by Description',
                     mutator: nullToEmptyString
                 },
                 {
                     title: "Action",
                     field: "actions",
                     hozAlign: "center",
                     vertAlign: "middle",
                     width: "8%",
                     download: false,
                     print: false,
                     formatter: function(cell, formatterParams, onRendered) {
                         var id = cell.getData().id;
                         return '<div class="button-container">' +
                             '<button class="fa fa-eye view-button" onclick="redirectToView(' +
                             id +
                             ')"> </button>' +
                             '</div>';
                     }
                 }
             ],
             pagination: 'local',
             placeholder: "No Data Available",
             initialSort: [{ column: "created_at", dir: "desc" }]
         });

         // Date range filter logic
         document.getElementById("apply-date-filter").addEventListener("click", function() {
             var startDate = document.getElementById("start-date").value;
             var endDate = document.getElementById("end-date").value;

             if (startDate && endDate) {
                 table.setFilter([
                     { field: "created_at", type: ">=", value: startDate },
                     { field: "created_at", type: "<=", value: endDate }
                 ]);
             } else if (startDate) {
                 table.setFilter("created_at", ">=", startDate);
             } else if (endDate) {
                 table.setFilter("created_at", "<=", endDate);
             } else {
                 table.clearFilter();
             }
         });

         // Add reset button functionality to clear filters
         var resetButton = document.getElementById("reset-button");
         resetButton.addEventListener("click", function() {
             document.getElementById("start-date").value = "";
             document.getElementById("end-date").value = "";
             table.clearFilter();
             table.clearHeaderFilter();
         });

         $("#pageSizeDropdown").on("change", function() {
             var selectedPageSize = parseInt($(this).val(), 25);
             table.setPageSize(selectedPageSize);
         });

         //trigger download of data.xlsx file
         document.getElementById("download-xlsx").addEventListener("click", function() {
             table.download("xlsx", "Transaction List.xlsx", {
                 sheetName: "PASA01"
             });
         });

         //trigger download of data.pdf file
         document.getElementById("download-pdf").addEventListener("click", function() {
             table.download("pdf", "Transaction List.pdf", {
                 orientation: "landscape",
                 title: "Transaction List",
             });
         });

         function redirectToView(id) {
             var currentPath = window.location.pathname;
             window.location.href = currentPath + '/' + id;
         }
     </script>
 @endsection
 @include('layout.footer')
