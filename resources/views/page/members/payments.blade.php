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
                 <!--<div class="card-header d-flex justify-content-between align-items-center">
                     <a class="btn btn-primary" href="{{ route('transaction.create') }}" id="add-record">
                         <i class="fa fa-plus-circle" style="font-size:24px;"></i>
                     </a>
                 </div>-->
             </div>
             <div class="row">
                 <div class="col-md-12 p-12">
                     <div class="card">
                         <div class="card-body p-2">
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
         //var transaction = <?php echo json_encode($transaction); ?>;
         var gl_code_parent = <?php echo json_encode($gl_code_parent); ?>;
         var account_type = <?php echo json_encode($account_type); ?>;

         var table = new Tabulator("#transaction-table", {
             data: {!! json_encode($transaction->toArray()) !!},

             layout: "fitColumns",
             columns: [{
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
                         var formattedDate = moment(cell.getValue()).format('YYYY-MM-DD');
                         return formattedDate;
                     }
                 },
                 {
                     title: "Description",
                     field: "description",
                     hozAlign: "left",
                     vertAlign: "middle",
                     headerFilter: "input",
                     headerFilterPlaceholder: 'Search by Description',
                 }
             ],
             pagination: 'local',
             paginationSize: 20,
             placeholder: "No Data Available",
             initialSort: [{
                 column: "created_at",
                 dir: "desc"
             }]
         });
        
     </script>
 @endsection
 @include('layout.footer')
