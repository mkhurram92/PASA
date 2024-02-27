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
             background-color: #3498db;
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
                     <h3 class="page-title">Transaction List</h3>
                 </div>
                 <div class="card-header d-flex justify-content-between align-items-center">
                     <a class="btn btn-primary" href="{{ route('transaction.create') }}" id="add-record">
                         <i class="fa fa-plus-circle" style="font-size:24px;"> Add a Transaction</i>
                     </a>
                 </div>
             </div>
             <div class="row">
                 <div class="col-md-12 p-12">
                     <div class="card">
                         <div class="card-body p-2">
                             <div class="tabulator-toolbar">
                                 Show <select style="padding:10px;" id="pageSizeDropdown">
                                     <option value="10">10</option>
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
         var gl_Codes = <?php echo json_encode($transaction); ?>;

         console.log("Transaction Data:", gl_Codes);

         var table = new Tabulator("#transaction-table", {
             data: gl_Codes,
             layout: "fitColumns",
             columns: [{
                     title: "Parent Account",
                     field: "gl_code.gl_codes_parent.name",
                     hozAlign: "center",
                     vertAlign: "middle",
                     headerFilter: "select"
                 },
                 {
                     title: "Sub Account",
                     field: "gl_code.name",
                     hozAlign: "center",
                     vertAlign: "middle",
                     headerFilter: "select"
                 },
                 {
                     title: "Transaction Type",
                     field: "transaction_type.name",
                     hozAlign: "center",
                     vertAlign: "middle",
                     headerFilter: "select"
                 },
                 {
                     title: "Amount",
                     field: "amount",
                     hozAlign: "center",
                     vertAlign: "middle",
                     headerFilter: "input"
                 },
                 {
                     title: "Transaction Account",
                     field: "account.name",
                     hozAlign: "center",
                     vertAlign: "middle",
                     headerFilter: "select"
                 },
                 {
                     title: "Description",
                     field: "description",
                     hozAlign: "center",
                     vertAlign: "middle",
                     headerFilter: "input"
                 },
                 {
                     title: "Creation Date",
                     field: "created_at",
                     hozAlign: "center",
                     vertAlign: "middle",
                     headerFilter: "input"
                 },
                 {
                     title: "Action",
                     field: "actions",
                     hozAlign: "center",
                     vertAlign: "middle",
                     width: "8%",
                     formatter: function(cell, formatterParams, onRendered) {
                         var id = cell.getData().id;

                         // Add buttons for each row
                         return '<div class="button-container">' +
                             '<button class="fa fa-eye view-button" id="view-record" data-id="' + id +
                             '"></button>' +
                             '</div>';
                     }
                 }

             ],
             pagination: 'local',
             paginationSize: 20,
             placeholder: "No Data Available"
         });
     </script>
 @endsection
 @include('layout.footer')
