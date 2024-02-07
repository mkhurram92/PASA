@include('layout.header')
@include('layout.sidebar')
<!-- app-content start-->
<div class="app-content main-content">
    <div class="side-app">
        <div class="container-fluid main-container mt-5">
            <div class="row my-5">
                <div class="col-12">
                    @if (session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                </div>
                <div class="col-md-12">
                    <a href="{{ route('JuniorForm') }}" class="btn btn-primary" target="_blank">Add Junior</a>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class=" tab-menu-heading p-0 bg-light">
                    <div class="tabs-menu1 ">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs">
                            @if ($juniors->isNotEmpty())
                                <li><a href="#juniorTab" class="active" data-bs-toggle="tab">Juniors</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body">
                    <div class="tab-content">
                        @if ($juniors->isNotEmpty())
                            <table class="table table-light" id="juniorsTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Date of birth</th>
                                        <th>Gender</th>
                                        <th>Start date</th>
                                        <th>End date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($juniors as $index => $junior)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $junior->given_name ?? 'N/A' }}</td>
                                            <td>{{ $junior->date_of_birth ?? 'N/A' }}</td>
                                            <td>{{ ucwords($junior->withGender->name ?? 'N/A') }}</td>
                                            <td>{{ $junior->withSubscription?->start_date ?? 'N/A' }}</td>
                                            <td>{{ $junior->withSubscription?->end_date ?? 'N/A' }}</td>
                                            <td>
                                                <a href="" class="btn btn-primary btn-sm">Edit</a>
                                                <a href="{{ route('JuniorSiblings', ['junior' => $junior?->id]) }}"
                                                    class="btn btn-primary btn-sm show-siblings">Siblings</a>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Date of birth</th>
                                        <th>Gender</th>
                                        <th>Start date</th>
                                        <th>End date</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="crud"></div>
@section('scripts')
    <script>
        $("#juniorsTable").DataTable({
            "order": []
        });
        $(document).on("click", ".show-siblings", function(e) {
            e.preventDefault();
            $.ajax($(e.target).attr("href"), {
                    type: "GET"
                })
                .done(res => {
                    if (res?.html) {
                        $("#crud").html(res?.html)
                        $("#crud").find(".modal:not(.show)").modal("show");
                    }
                })
        })
    </script>
@endsection
<!-- app-content end-->
@include('layout.footer')
