@include('layout.header')
@include('layout.sidebar')
<!-- app-content start-->
<div class="app-content main-content">
    <div class="side-app">
        <style>
            .row {
                margin-bottom: 1rem;
            }

            .form-control-label {
                font-size: 16px;
                font-weight: 500;
            }

            .form-control[:read-only] {
                font-size: 16px;
            }

            .col-md-2 {
                margin-top: 1rem;
            }
        </style>
        <div class="container-fluid main-container">
            <!--Page header-->
            <div class="page-header">
                <div class="page-leftheader">
                    <h4 class="page-title"></h4>
                </div>
            </div>
            <!--End Page header-->

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

                        @if (count($member->pedigree) > 0)
                            <div class="card-header justify-content-between">
                                <h3 class="card-title">Pioneer Member's Pedigree Chart</h3>
                                <div>
                                    <a class="btn btn-danger" href="{{ route('members.index') }}">
                                        <i class="fa fa-home" style="font-size:20px;"> Home</i>
                                    </a>
                                    <a class="btn btn-success mr-2" href="">
                                        <i class="pe-7s-pen btn-icon-wrapper" style="font-size:20px;"> Edit</i>
                                    </a>
                                    <a class="btn btn-info" href="{{ url()->current() }}/edit" id="view-members">
                                        <i class="fa fa-arrow-circle-left" style="font-size:20px;"> Back</i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="card-body">
                                    @foreach ($member->pedigree as $pedigree)
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <a class="form-control-label" style="color: #022ff8; font-size:16px">Generation x {{ $pedigree->pedigree_level + 1 }}</a>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-2">
                                                <label class="form-control-label">Father Name</label>
                                                <input
                                                    class="form-control @if ($pedigree->pioneer_parents == 1) text-danger @endif"
                                                    value="{{ $pedigree->f_name }}" required="" type="text"
                                                    readonly disabled>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Birth Date</label>
                                                <input class="form-control" type="text" placeholder="Birth Date"
                                                    value="{{ $pedigree->date_of_birth ?? '' }}" readonly disabled>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Birth Place</label>
                                                <input class="form-control" type="text" placeholder="Birth Place"
                                                    value="{{ $pedigree->place_of_birth ?? '' }}" readonly disabled>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Death Date</label>
                                                <input class="form-control" type="text" placeholder="Death Date"
                                                    value="{{ $pedigree->date_of_death ?? '' }}" readonly disabled>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Death Place</label>
                                                <input class="form-control" type="text" placeholder="Death Place"
                                                    value="{{ $pedigree->place_of_death ?? '' }}" readonly disabled>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Marriage Date</label>
                                                <input class="form-control" type="text" placeholder="Marriage Date"
                                                    value="{{ $pedigree->date_of_marriage ?? '' }}" readonly disabled>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Mother Name</label>
                                                <input
                                                    class="form-control @if ($pedigree->pioneer_parents == 0) text-danger @endif"
                                                    id="email" value="{{ $pedigree->m_name }}" required=""
                                                    type="text" readonly disabled>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Birth Date</label>
                                                <input class="form-control" type="text" placeholder="Birth Date"
                                                    value="{{ $pedigree->m_birth_date ?? '' }}" readonly disabled>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Birth Place</label>
                                                <input class="form-control" type="text" placeholder="Birth Place"
                                                    value="{{ $pedigree->m_birth_place ?? '' }}" readonly disabled>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Death Date</label>
                                                <input class="form-control" type="text" placeholder="Death Date"
                                                    value="{{ $pedigree->m_death_date ?? '' }}" readonly disabled>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Death Place</label>
                                                <input class="form-control" type="text" placeholder="Death Place"
                                                    value="{{ $pedigree->m_death_place ?? '' }}" readonly disabled>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label">Marriage Place</label>
                                                <input class="form-control" type="text" placeholder="Marriage Place"
                                                    value="{{ $pedigree->place_of_marriage ?? '' }}" readonly disabled>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                    @endforeach
                                </div>
                            </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h3 class="card-title">No Pedigrees Available</h3>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- MODAL EFFECTS -->
<div id="crud"></div>
@section('scripts')
    @include('plugins.select2')
    <script>
        document.getElementById('view-members').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default behavior of the link

            // Extract the current URL and the id from it
            var currentUrl = window.location.href;
            var id = currentUrl.substring(currentUrl.lastIndexOf('/') + 1);

            // Construct the new URL for editing
            var newUrl = currentUrl.replace('/view-pedigree/', '/view-member/');

            // Redirect to the new URL
            window.location.href = newUrl;
        });
    </script>
@endsection
<!-- app-content end-->
@include('layout.footer')
