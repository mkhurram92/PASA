@include('layout.header')
@include('layout.sidebar')
<!-- app-content start-->
<div class="app-content main-content">
    <div class="side-app">
        <div class="container-fluid main-container">

            <!--Page header-->
            <div class="page-header d-flex justify-content-between">
                <div class="page-leftheader">
                    <h4 class="page-title">Dashboard</h4>
                </div>
                <div>
                    <h5 class="page-title">User : {{ Auth::user()->name }}</h5>
                </div>
            </div>
            
            <!--End Page header-->
            @if (Auth::user()->role->name == "Admin")

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <i class="fa fa-sitemap card-custom-icon text-success icon-dropshadow-success" style="font-size: 4rem"></i>
                            <p class="mb-2">Total Ancestors</p>
                            <h2 class="font-weight-bold mb-1" id="total_deals">{{ $numberOfAncestors }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <i class="fa fa-users card-custom-icon text-primary icon-dropshadow-primary"
                                style="font-size: 4rem"></i>
                            <p class="mb-2">Total Members</p>
                            <h2 class="font-weight-bold mb-1" id="total_customers">{{ $numberOfMembers }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <i class="fa fa-bank card-custom-icon text-info icon-dropshadow-info" style="font-size: 4rem"></i>
                            <p class="mb-2">Total Income</p>
                            <h2 class="font-weight-bold mb-1" id="total_referrers">{{ $incomeTransactions }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <i class="fa fa-money card-custom-icon text-purple icon-dropshadow-purple"
                                style="font-size: 4rem"></i>
                            <p class="mb-2">Total Expenses</p>
                            <h2 class="font-weight-bold mb-1" id="total_brokers">{{ $expenseTransactions }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- app-content end-->
@include('layout.footer')