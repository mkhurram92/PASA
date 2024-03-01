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
                     <h3 class="page-title">Sub G/L List</h3>
                 </div>
                 <div class="card-header d-flex justify-content-between align-items-center">
                     <a class="btn btn-primary" href="javascript:void(0)" id="create-record">
                         <i class="fa fa-plus-circle" style="font-size:24px;"> Add a Sub G/L</i>
                     </a>
                 </div>
             </div>
             <div class="row">
                 <div class="col-md-12 p-12">
                     <div class="card">
                         <div class="card-body p-2">
                             <div class="tabulator-toolbar">
                                 Show <select style="padding:10px;" id="pageSizeDropdown">
                                     <option value="20">20</option>
                                     <option value="40">40</option>
                                     <option value="60">60</option>
                                     <option value="80">80</option>
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
                             <div id="gl-code-table"></div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <div id="crud"></div>
 @section('scripts')
     <script>
         var gl_Codes = <?php echo json_encode($glCodes); ?>;
         var gl_code_parent = <?php echo json_encode($gl_code_parent); ?>;
         var gl_code_sub = <?php echo json_encode($gl_code_sub); ?>;

         var table = new Tabulator("#gl-code-table", {
             data: gl_Codes,
             layout: "fitColumns",
             columns: [{
                     title: "Sub G/L Name",
                     field: "name",
                     hozAlign: "center",
                     vertAlign: "middle",
                     headerFilter: "select",
                     headerFilterParams: {
                         values: gl_code_sub
                     }
                 }, {
                     title: "Parent G/L Name",
                     field: "gl_codes_parent.name",
                     hozAlign: "center",
                     vertAlign: "middle",
                     headerFilter: "select",
                     headerFilterParams: {
                         values: gl_code_parent
                     }
                 },
                 {
                     title: "Description",
                     field: "description",
                     hozAlign: "center",
                     vertAlign: "middle",
                     headerFilter: "input"
                 },
                 {
                     title: "Created Date",
                     field: "created_at",
                     hozAlign: "center",
                     vertAlign: "middle",
                     headerFilter: "input",
                     formatter: function(cell) {
                         var formattedDate = moment(cell.getValue()).format('YYYY-MM-DD HH:mm:ss');
                         return formattedDate;
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
                             '<button class="fa fa-eye view-button" id="view-record" data-id="' + id +
                             '"></button>' +
                             '<button class="fa fa-edit edit-button" data-id="' + id + '"></button>' +
                             '</div>';
                     }
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
             table.download("csv", "Sub GL List.csv");
         });

         //trigger download of data.xlsx file
         document.getElementById("download-xlsx").addEventListener("click", function() {
             table.download("xlsx", "Sub GL List.xlsx", {
                 sheetName: "PASA01"
             });
         });

         //trigger download of data.pdf file
         document.getElementById("download-pdf").addEventListener("click", function() {
             table.download("pdf", "Sub GL List.pdf", {
                 orientation: "landscape",
                 title: "Sub GL List",
             });
         });

         $('#create-record').click(function() {
             $.get("{{ route('gl-codes.create') }}", form => {
                 $('#crud').html(form.html);
                 $('#crud').find(".modal").modal('show');
             });
         });

         document.getElementById('gl-code-table').addEventListener("click", function(e) {
             if (e.target.classList.contains("view-button")) {
                 var glcodeId = e.target.getAttribute("data-id");
                 openViewModal(glcodeId);
             }
         });

         // Function to open the view modal
         function openViewModal(glcodeId) {
             $.get("{{ route('gl-codes.show', ['gl_code' => '__glcodeId__']) }}".replace('__glcodeId__', glcodeId), function(
                 response) {
                 $('#crud').html(response.html);
                 $('#crud').find(".modal").modal('show');
             });
         }
     </script>
 @endsection
 @include('layout.footer')
