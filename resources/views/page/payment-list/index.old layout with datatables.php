@include('layout.header')
@include('layout.sidebar')
<div class="app-content main-content">
    <div class="side-app">
        <div class="container-fluid main-container">
            <div class="page-header">
                <div class="page-leftheader">
                    <h3 class="page-title">Payments List</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label" style="font-size: 16px;">Name</label>
                                        <input type="text" class="form-control" style="font-size: 16px;"
                                            placeholder="Name" id="search-name">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label" style="font-size: 16px;">E-Mail</label>
                                        <input type="text" class="form-control"
                                            style="font-size: 16px;"placeholder="Email" id="search-email">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label" style="font-size: 16px;">Membership Types</label>
                                        <select class="form-control" style="font-size: 16px;" id="search-member-type">
                                            <option value="">Select Type</option>
                                            <option value="primary">Primary</option>
                                            <option value="junior">Junior</option>
                                            <option value="partner">Partner</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label" style="font-size: 16px;">Payment Status</label>
                                        <select class="form-control" style="font-size: 16px;" id="search-status">
                                            <option value="">Select Status</option>
                                            <option value="Payment Incomplete">Incomplete</option>
                                            <option value="Payment Succeeded">Succeeded</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label" style="font-size: 16px;">Payment From Date</label>
                                        <input type="date" class="form-control" style="font-size: 16px;"
                                            id="search-from-date">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label" style="font-size: 16px;">Payment To Date</label>
                                        <input type="date" class="form-control" style="font-size: 16px;"
                                            id="search-to-date">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label" style="font-size: 16px;">&nbsp;</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="button" style="width: 100%;" class="btn btn-secondary"
                                                    id="clear-filters">Clear Filters</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                        <div class="card-body p-12">
                            <div class="table-responsive">
                                @if (isset($data))
                                    <table class="table table-light" id="payment_list" style="font-size: 16px;">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>name</th>
                                                <th>email</th>
                                                <th>membership type</th>
                                                <th>amount paid</th>
                                                <th>date of transaction</th>
                                                <th>payment status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $payment)
                                                <tr>
                                                    <td style="background-color: white">{{ $payment['name'] }}</td>
                                                    <td style="background-color: white">{{ $payment['email'] }}</td>
                                                    <td style="background-color: white">
                                                        @if ($payment['member_type'] == 'primary')
                                                            <span
                                                                class='badge bg-success'>{{ Str::ucfirst($payment['member_type']) }}</span>
                                                        @elseif ($payment['member_type'] == 'junior')
                                                            <span
                                                                class='badge bg-info'>{{ Str::ucfirst($payment['member_type']) }}</span>
                                                        @elseif ($payment['member_type'] == 'partner')
                                                            <span
                                                                class='badge bg-primary'>{{ Str::ucfirst($payment['member_type']) }}</span>
                                                        @else
                                                            <span
                                                                class='badge bg-primary'>{{ Str::ucfirst($payment['member_type']) }}</span>
                                                        @endif
                                                    </td>
                                                    <td style="background-color: white">{{ $payment['amount'] }}</td>
                                                    <td style="background-color: white">
                                                        {{ date('d-m-Y h:i:s A', strtotime($payment['created'])) }}
                                                    </td>                                                                                                      
                                                    <td style="background-color: white">{!! $payment['status'] !!}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>name</th>
                                                <th>email</th>
                                                <th>membership type</th>
                                                <th>amount paid</th>
                                                <th>date of transaction</th>
                                                <th>payment status</th>
                                            </tr>
                                        </tfoot>
                                    </table>
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
        var paymentListTable = $("#payment_list").DataTable({
            order: [
                [4, 'desc']
            ],
            ordering: false,
            dom: '<"row mx-2"' +
                            '<"col-md-2"<"me-3"l>>' +
                            '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"B>>' +
                            '>t' +
                            '<"row mx-2"' +
                            '<"col-sm-12 col-md-6"i>' +
                            '<"col-sm-12 col-md-6"p>' +
                            '>',
                            paging: true,
        });
        $('#payment_list_wrapper .row').css('justify-content', 'flex-end');
        var filterInputs = ['#search-name', '#search-email', '#search-member-type', '#search-from-date', '#search-to-date', '#search-status'];

        $('#clear-filters').on('click', function() {
            filterInputs.forEach(function(input) {
                $(input).val('');
            });

            paymentListTable.search('').columns().search('').draw();
        });

        $(filterInputs.join(',')).on('input change', function() {
            paymentListTable.search(
                $('#search-name').val() + ' ' +
                $('#search-email').val() + ' ' +
                $('#search-member-type').val() + ' ' +
                $('#search-from-date').val() + ' ' +
                $('#search-to-date').val() + ' ' +
                $('#search-status').val()
            ).draw();
        });
        $('#export-filters').on('click', function() {
            paymentListTable.button('.buttons-excel').trigger();
        });
    </script>
@endsection

<style>
    #payment_list_length label {
        font-size: 16px;
    }

    #payment_list_length select {
        font-size: 16px !important;
        line-height: 1 !important;
        height: auto !important;
        padding: 10px !important;
    }
</style>
<!-- Add these links to include DataTables Buttons and JSZip libraries -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js">
</script>
<script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js">
</script>

@include('layout.footer')
