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
             background-color: #0d6efd;
             color: white;
             cursor: pointer;
         }

         .custom-button:hover {
             background-color: #45a049;
         }
     </style>

     <div class="side-app">
         <div class="container-fluid main-container">
             <div class="page-header">
                 <div class="page-leftheader">
                     <h3 class="page-title">Payments List</h3>
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
                                 <div id="payment_list"></div>

                             </div>

                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 @section('scripts')
     <script>
         function customTotalFormatter(cell, formatterParams, onRendered) {
             return "Total Record : " + cell.getValue();
         }
         var paymentsData = @json($payments->data);

         console.log(paymentsData); // Check the browser console for this output

         var table = new Tabulator("#payment_list", {
             data: paymentsData,
             layout: "fitColumns",
             columns: [{
                     title: "Billing Name",
                     field: "billing_details.name",
                     hozAlign: "center",
                     sorter: "string"
                 },
                 {
                     title: "Amount",
                     field: "amount",
                     sorter: "number",
                     hozAlign: "center",
                     formatter: "money",
                     formatterParams: {
                         precision: 2,
                         symbol: "$",
                         symbolAfter: false
                     }
                 },
                 {
                     title: "Description",
                     field: "description",
                     hozAlign: "center",
                     sorter: "string"
                 },
                 {
                     title: "Card Last 4 Digits",
                     field: "payment_method_details.card.last4",
                     hozAlign: "center",
                     sorter: "string"
                 },
                 {
                     title: "Card Type",
                     field: "payment_method_details.card.brand",
                     hozAlign: "center",
                     sorter: "string",
                     formatter: function(cell, formatterParams, onRendered) {
                         var brand = cell.getValue();
                         if (brand) {
                             return brand.charAt(0).toUpperCase() + brand.slice(1);
                         }
                         return brand;
                     }
                 },
                 {
                     title: "Status",
                     field: "status",
                     hozAlign: "center",
                     sorter: "string",
                     formatter: function(cell, formatterParams, onRendered) {
                         var status = cell.getValue();
                         if (status === 'succeeded') {
                             cell.getElement().style.color = "green"; // Set text color to green
                             return 'Successful';
                         } else {
                             return status;
                         }
                     }
                 },
                 {
                     title: "Transaction Date",
                     field: "created",
                     hozAlign: "center",
                     sorter: "date",
                     formatter: function(cell, formatterParams, onRendered) {
                         var date = new Date(cell.getValue() * 1000);

                         var year = date.getFullYear();
                         var month = String(date.getMonth() + 1).padStart(2, '0');
                         var day = String(date.getDate()).padStart(2, '0');
                         var hours = String(date.getHours()).padStart(2, '0');
                         var minutes = String(date.getMinutes()).padStart(2, '0');

                         return `${year}/${month}/${day} ${hours}:${minutes}`;
                     }
                 },
             ],
             pagination: "local",
             paginationSize: 25,
             placeholder: "No Data Available"
         });
     </script>
 @endsection
 @include('layout.footer')
