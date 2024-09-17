<script src="https://unpkg.com/tabulator-tables@5.4.3/dist/js/tabulator.min.js"></script>
<link href="https://unpkg.com/tabulator-tables@5.4.3/dist/css/tabulator.min.css" rel="stylesheet">

@include('layout.header')
@include('layout.sidebar')

<!-- app-content start-->
<div class="app-content main-content">
    <div class="side-app">
        <div class="container-fluid main-container">
            <!-- Page header -->
            <div class="page-header">
                <div class="page-leftheader">
                    <h4 class="page-title"></h4>
                </div>
            </div>
            <!-- End Page header -->

            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
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

                        <div class="card-header justify-content-between">
                            <h3 class="card-title">Member's Juniors</h3>
                        </div>

                        <!-- Junior Tabulator Table -->
                        <div class="table-responsive">
                            <div id="juniors-table"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var juniorsData = @json($juniors);

    var table = new Tabulator("#juniors-table", {
        data: juniorsData,
        layout: "fitColumns",
        columns: [
            { title: "Given Name", field: "given_name", headerFilter: "input" },
            { title: "Family Name", field: "family_name", headerFilter: "input" },
            { title: "Preferred Name", field: "preferred_name", headerFilter: "input" },
            { title: "Birth Date", field: "date_of_birth", headerFilter: "input" },
            { title: "Gender", field: "gender", headerFilter: "input",
              formatter: function(cell) {
                  const value = cell.getValue();
                  return value === 1 ? "Male" : "Female";
              }
            }
        ],
        pagination: "local",
        paginationSize: 25,
        placeholder: "No Data Available",
        headerFilterPlaceholder: 'Filter...',
        headerFilterLiveFilter: true,
    });
</script>


@include('layout.footer')
