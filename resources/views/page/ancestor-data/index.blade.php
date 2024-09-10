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
                     <h3 class="page-title">Ancestors</h3>
                 </div>
                 <div class="card-header d-flex justify-content-between align-items-center">
                     <a class="btn btn-primary" href="{{ route('ancestor-data.create') }}" id="add-record">
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
                                 @if (isset($ancestor))
                                     <div id="ancestor-data-table"></div>
                                 @else
                                     {{ $dataTable->table() }}
                                 @endif
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

         function nullToEmptyString(value) {
             return value === null ? '' : value;
         }

         var ancestorData = @json($ancestor);
         var state = @json($state);
         var occulation = @json($occupation);
         var gender_name = @json($gender_name);
         var country = @json($country);
         var ship = @json($ship);
         var source_of_arrival = @json($source_of_arrivals);

         var table = new Tabulator("#ancestor-data-table", {
             data: ancestorData,
             layout: "fitColumns",
             columns: [
                {
                     title: "Gender",
                     field: "gender.name",
                     mutator: nullToEmptyString, 
                     download: true,
                     visible:false
                 },
                {
                     title: "Family Name",
                     field: "ancestor_surname",
                     hozAlign: "left",
                     vertAlign: "middle",
                     headerFilter: "input",
                     headerFilterPlaceholder: 'Search by Surname',
                     mutator: nullToEmptyString
                 },
                 {
                     title: "Given Name",
                     field: "given_name",
                     hozAlign: "left",
                     vertAlign: "middle",
                     headerFilter: "input",
                     headerFilterPlaceholder: 'Search by Given Name',
                     mutator: nullToEmptyString
                 },
                 {
                     title: "Preferred Name",
                     field: "maiden_surname",
                     mutator: nullToEmptyString, 
                     download: true,
                     visible:false
                 },
                 {
                     title: "Mode of Travel",
                     field: "source_of_arrival.name",
                     hozAlign: "left",
                     vertAlign: "middle",
                     headerFilter: "select",
                     headerFilterPlaceholder: 'Search by Mode of Travel',
                     headerFilterParams: {
                         values: source_of_arrival
                     },
                     mutator: nullToEmptyString
                 },
                 {
                     title: "Ship Name - Year",
                     field: "ship_name_year",
                     hozAlign: "left",
                     vertAlign: "middle",
                     headerFilter: "input",
                     mutator: function(value, data, type, params, component) {
                         // Constructing "Ship Name - Year"
                         if (data.mode_of_travel) {
                             let shipName = data.mode_of_travel.ship ? data.mode_of_travel.ship
                                 .name_of_ship : '';
                             let year = data.mode_of_travel.year;
                             if (shipName && year) {
                                 return `${shipName} - ${year}`;
                             } else if (shipName) {
                                 return `${shipName}`;
                             } else if (year) {
                                 return `${year}`;
                             }
                         }
                         return ""; // Return empty if conditions are not met
                     }
                 },
                 {
                     title: "Birth Date",
                     field: "date_of_birth_combined",
                     hozAlign: "left",
                     vertAlign: "middle",
                     headerFilter: "input",
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
                     }
                 },
                 {
                     title: "Birth Place",
                     field: "place_of_birth",
                     mutator: nullToEmptyString, 
                     download: true,
                     visible:false
                 },
                 {
                     title: "Birth Details",
                     field: "notes.0.birth_details",
                     mutator: nullToEmptyString, 
                     download: true,
                     visible:false
                 },
                 {
                     title: "Death Date",
                     field: "date_of_death_combined",
                     mutator: function(value, data, type, params, component) {
                         let date = data.date_of_death ? String(data.date_of_death).padStart(2, '0') : "";
                         let month = data.month_of_death ? String(data.month_of_death).padStart(2, '0') : "";
                         let year = data.year_of_death ? String(data.year_of_death) : "";

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
                     //mutator: nullToEmptyString, 
                     download: true,
                     visible:false
                 },
                 {
                     title: "Death Place",
                     field: "place_of_death",
                     mutator: nullToEmptyString, 
                     download: true,
                     visible:false
                 },
                 {
                     title: "Death Details",
                     field: "notes.0.death_details",
                     mutator: nullToEmptyString, 
                     download: true,
                     visible:false
                 },
                 {
                     title: "General Notes",
                     field: "notes.0.notes",
                     mutator: nullToEmptyString, 
                     download: true,
                     visible:false
                 },
                 {
                     title: "Marriage Date",
                     field: "date_of_marriage_combined",
                     mutator: function(value, data, type, params, component) {
                         let date = data.spouse_details.marriage_date ? String(data.spouse_details.marriage_date).padStart(2, '0') : "";
                         let month = data.spouse_details.marriage_month ? String(data.spouse_details.marriage_month).padStart(2, '0') : "";
                         let year = data.spouse_details.marriage_year ? String(data.spouse_details.marriage_year) : "";

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
                     download: true,
                     visible:false
                 },          
                 {
                     title: "Spouse Family Name",
                     field: "spouse_details.spouse_family_name",
                     hozAlign: "left",
                     vertAlign: "middle",
                     headerFilter: "select",
                     headerFilterPlaceholder: 'Search by Spouse Family Name',
                     mutator: nullToEmptyString
                 },
                 {
                     title: "Spouse Given Name/s",
                     field: "spouse_details.spouse_given_name",
                     hozAlign: "left",
                     vertAlign: "middle",
                     headerFilter: "select",
                     headerFilterPlaceholder: 'Search by Spouse Given Name/s',
                     mutator: nullToEmptyString
                 },
                 {
                     title: "Spouse Birth Date",
                     field: "spouse_date_of_birth_combined",
                     mutator: function(value, data, type, params, component) {
                         let date = data.spouse_details.spouse_birth_date ? String(data.spouse_details.marriage_date).padStart(2, '0') : "";
                         let month = data.spouse_details.spouse_birth_month ? String(data.spouse_details.spouse_birth_month).padStart(2, '0') : "";
                         let year = data.spouse_details.spouse_birth_year ? String(data.spouse_details.spouse_birth_year) : "";

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
                     download: true,
                     visible:false
                 },
                 {
                     title: "Spouse Birth Place",
                     field: "spouse_details.spouse_birth_place",
                     mutator: nullToEmptyString,
                     download: true,
                     visible:false
                 },
                 {
                     title: "Spouse Death Date",
                     field: "spouse_date_of_death_combined",
                     mutator: function(value, data, type, params, component) {
                         let date = data.spouse_details.spouse_death_date ? String(data.spouse_details.marriage_date).padStart(2, '0') : "";
                         let month = data.spouse_details.spouse_death_month ? String(data.spouse_details.spouse_death_month).padStart(2, '0') : "";
                         let year = data.spouse_details.spouse_death_year ? String(data.spouse_details.spouse_death_year) : "";

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
                     download: true,
                     visible:false
                 },
                 {
                     title: "Spouse Death Place",
                     field: "spouse_details.spouse_death_place",
                     mutator: nullToEmptyString,
                     download: true,
                     visible:false
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

         function printData() {
             table.print(false, true);
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

         //trigger download of data.csv file
         document.getElementById("download-csv").addEventListener("click", function() {
             table.download("csv", "Ancestor List.csv");
         });

         //trigger download of data.xlsx file
         document.getElementById("download-xlsx").addEventListener("click", function() {
             table.download("xlsx", "Ancestor List.xlsx", {
                 sheetName: "Ancestor List",
             });
         });

         //trigger download of data.pdf file
         document.getElementById("download-pdf").addEventListener("click", function() {
             table.download("pdf", "Ancestor List.pdf", {
                 orientation: "landscape",
                 title: "Ancestor List",
             });
         });
     </script>
 @endsection
 <!-- app-content end-->
 @include('layout.footer')
