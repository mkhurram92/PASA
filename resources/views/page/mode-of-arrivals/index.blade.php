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

 @include('layout.header')
 @include('layout.sidebar')
 <div class="app-content main-content">
     <div class="side-app">
         <div class="container-fluid main-container">
             <div class="page-header">
                 <div class="page-leftheader">
                     <h3 class="page-title">Journey to South Australia</h3>
                 </div>
                 <div class="card-header d-flex justify-content-between align-items-center">
                     <a class="btn btn-primary @if (Route::is('mode-of-arrivals.create')) active @endif"
                         href="{{ route('mode-of-arrivals.create') }}" id="add-record">
                         <i class="fa fa-plus-circle" style="font-size:24px;"> Add New</i>
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
                             <div class="table-responsive">
                                 <div id="modeofarrivals-table"></div>
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
         // Function to handle "Edit" button click
         function redirectToEdit(id) {
             var currentPath = window.location.pathname;
             window.location.href = currentPath + '/' + id + '/edit';
         }

         // Function to handle "View" button click
         function redirectToView(id) {
             var currentPath = window.location.pathname;
             window.location.href = currentPath + '/' + id;
         }

         var myData = @json($mode_of_arrival);
         var shipName = @json($shipNames);
         var arrivalAt = @json($arrivalAt);

         var table = new Tabulator("#modeofarrivals-table", {
             data: myData,
             layout: "fitColumns",
             columns: [{
                     title: "ID",
                     field: "id",
                     width: "8%",
                     hozAlign: "center",
                     vertAlign: "middle",
                     headerFilter: "input",
                     headerFilterPlaceholder: 'Search by ID'
                 },
                 {
                     title: "Ship Name",
                     field: "ship.name_of_ship",
                     hozAlign: "center",
                     vertAlign: "middle",
                     headerFilter: "select",
                     headerFilterPlaceholder: 'Search by Name',
                     headerFilterParams: {
                         values: shipName
                     },
                     formatter: function(cell, formatterParams, onRendered) {
                         var rowShipName = cell.getValue();
                         return rowShipName;
                     }
                 },
                 {
                     title: "Year",
                     field: "year",
                     hozAlign: "center",
                     vertAlign: "middle",
                     width: "10%",
                     headerFilter: "input",
                     headerFilterPlaceholder: 'Search by Year'
                 },
                 {
                     title: "Departure Place",
                     field: "location",
                     hozAlign: "center",
                     vertAlign: "middle",
                     headerFilter: "input",
                     headerFilterPlaceholder: 'Search by Departure Place',
                     formatter: function(cell, formatterParams, onRendered) {
                         var city = cell.getData().city ? cell.getData().city.name : "";
                         var county = cell.getData().county ? cell.getData().county.name :
                             "";
                         var country = cell.getData().country ? cell.getData().country.name :
                             "";
                         return city + ", " + county + ", " + country;
                     }
                 },
                 {
                     title: "Departure Date",
                     field: "date_of_departure",
                     hozAlign: "center",
                     vertAlign: "middle",
                     headerFilter: "input",
                     headerFilterPlaceholder: 'Search by Departure Date'
                 },
                 {
                     title: "Arrival Date in SA",
                     field: "date_of_arrival",
                     hozAlign: "center",
                     vertAlign: "middle",
                     headerFilter: "input",
                     headerFilterPlaceholder: 'Search by Arrival Date in SA'
                 },
                 {
                     title: "Arrival Place in SA",
                     field: "port.name",
                     hozAlign: "center",
                     vertAlign: "middle",
                     headerFilter: "select",
                     headerFilterPlaceholder: 'Search by Arrival Place in SA',
                     headerFilterParams: {
                         values: arrivalAt
                     }
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
                             //'<button class="pe-7s-pen btn-icon-wrapper edit-button" onclick="redirectToEdit(' +
                             //id +
                             //')"></button>' +
                             '<button class="fa fa-eye view-button" onclick="redirectToView(' +
                             id +
                             ')"></button>' +
                             '</div>';
                     }
                 }
             ],
             pagination: 'local',
             paginationSize: 10,
             placeholder: "No Data Available"
         });


         var resetButton = document.getElementById("reset-button");

         // Add a click event listener to the reset button
         resetButton.addEventListener("click", function() {
             table.clearFilter(); // Clear the table filter
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
             table.download("csv", "Journey to South Australia.csv");
         });

         //trigger download of data.xlsx file
         document.getElementById("download-xlsx").addEventListener("click", function() {
             table.download("xlsx", "Journey to South Australia.xlsx", {
                 sheetName: "PASA01"
             });
         });

         //trigger download of data.pdf file
         document.getElementById("download-pdf").addEventListener("click", function() {
             table.download("pdf", "Journey to South Australia.pdf", {
                 orientation: "landscape", //set page orientation to landscape
                 title: "Journey to South Australia", //add title to report
             });
         });
     </script>
 @endsection

 <!-- app-content end-->
 @include('layout.footer')
