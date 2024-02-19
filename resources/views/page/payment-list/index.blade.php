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
                                 @if (isset($data))
                                     <div id="payment_list"></div>
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
         function customTotalFormatter(cell, formatterParams, onRendered) {
             return "Total Record : " + cell.getValue();
         }
         var myData = @json($data);
         var paymentType = @json($paymentTypeOptions);
         // Create Tabulator
         var table = new Tabulator("#payment_list", {
             data: myData,
             height: "500px",
             layout: "fitColumns",
             columns: [{
                     title: "Name",
                     field: "name",
                     headerFilter: "input",
                     hozAlign: "center",
                     vertAlign: "middle",
                     bottomCalc: "count",
                     headerFilterPlaceholder: 'Filter by Name'
                 },
                 {
                     title: "Email",
                     field: "email",
                     headerFilter: "input",
                     hozAlign: "center",
                     vertAlign: "middle",
                     headerFilterPlaceholder: 'Filter by Email'
                 },
                 {
                     title: "Payment Type",
                     field: "member_type",
                     headerFilter: "select",
                     hozAlign: "center",
                     vertAlign: "middle",
                     headerFilterPlaceholder: 'Filter by Payment Type',
                     headerFilterParams: {
                         values: paymentType
                     },
                     formatter: function(cell, formatterParams, onRendered) {
                         // Access the cell value
                         var membershipType = cell.getValue();

                         // Add custom styling based on membership type
                         var style = '';
                         if (membershipType === 'primary') {
                             style = 'color: magenta;';
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
                     title: "Amount Paid",
                     field: "amount",
                     headerFilter: "input",
                     hozAlign: "center",
                     vertAlign: "middle",
                     headerFilterPlaceholder: 'Filter by Amount'
                 },
                 {
                     title: 'Date of Transaction',
                     field: 'created',
                     hozAlign: "center",
                     headerFilterPlaceholder: 'Filter by Date',
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

                         var formattedDate = day + '/' + month + '/' + year + ' ' + hours + ':' + minutes +
                             ':' + seconds + ' ' + ampm;

                         return formattedDate;
                     }
                 },
                 {
                     title: "Payment Status",
                     field: "status",
                     headerFilter: "select",
                     headerFilterPlaceholder: 'Filter by Payment Status',
                     headerFilterParams: {
                         values: ["", "Payment Incomplete", "Payment Succeeded"]
                     },
                     hozAlign: "center",
                     vertAlign: "middle",
                     formatter: function(cell, formatterParams, onRendered) {
                         var value = cell.getValue();

                         // Define text colors based on values
                         var textColorMap = {
                             "": "", // Default color for empty value
                             "Payment Incomplete": "red", // Red color for Payment Incomplete text
                             "Payment Succeeded": "green" // Green color for Payment Succeeded text
                         };

                         // Apply text color to the cell
                         cell.getElement().style.color = textColorMap[value];

                         return value; // Return the original value for display
                     }
                 }
             ],
             pagination: "local",
             paginationSize: 20,
             placeholder: "No Data Available"
         });
         // Add Date Range Filter
         var dateRangePicker = flatpickr("#date-range", {
             mode: "range",
             dateFormat: "Y-m-d",
             onChange: function(selectedDates, dateStr) {
                 applyDateFilter(selectedDates);
             }
         });

         // Function to apply date filter to the table
         function applyDateFilter(selectedDates) {
             var dateFilter = selectedDates.map(function(date) {
                 return date.toISOString().split('T')[0];
             });
             table.setFilter([{
                     field: "created",
                     type: ">=",
                     value: dateFilter[0]
                 },
                 {
                     field: "created",
                     type: "<=",
                     value: dateFilter[1]
                 }
             ]);
         }

         // Add a reset button
         var resetButton = document.getElementById("reset-button");

         // Add a click event listener to the reset button
         resetButton.addEventListener("click", function() {
             dateRangePicker.clear(); // Clear the date range picker
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
             table.download("csv", "Payment List.csv");
         });

         //trigger download of data.xlsx file
         document.getElementById("download-xlsx").addEventListener("click", function() {
             table.download("xlsx", "Payment List.xlsx", {
                 sheetName: "PASA01"
             });
         });

         //trigger download of data.pdf file
         document.getElementById("download-pdf").addEventListener("click", function() {
             table.download("pdf", "Payment List.pdf", {
                 orientation: "landscape", //set page orientation to landscape
                 title: "Payment List", //add title to report
             });
         });
     </script>
 @endsection
 @include('layout.footer')
