<!-- resources/views/page/gl_codes/create.blade.php -->

@include('layout.header')
@include('layout.sidebar')

<!-- app-content start-->
<div class="app-content main-content">
    <div class="side-app">
        <style>
            /* Increase the size of the day cells */
            .ui-datepicker-calendar td {
                font-size: 22px;
                /* Adjust the padding as needed */
            }

            .ui-datepicker-calendar a {
                font-size: 22px !important;

                /* Adjust the padding as needed */
            }

            /* Increase the size of the month/year dropdowns */
            .ui-datepicker select.ui-datepicker-year,
            .ui-datepicker select.ui-datepicker-month {
                font-size: 22px;
                /* Adjust the font size as needed */
            }

            .ui-datepicker-calendar {
                width: 300px;
                height: 300px;
                /* Set the height to 100% */
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

            <!-- Row -->
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

                        <form class="form-horizontal" action="{{ route('gl_codes.store') }}" method="POST">
                            <div class="card-header justify-content-between">
                                <h3 class="card-title">Create G/L Code</h3>
                                <div class="text-right">
                                    <input type="submit" class="btn btn-primary btn-block"
                                        data-bs-effect="effect-slide-in-right" value="Save G/L Code">
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">

                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">GL Name<span
                                                        class="text-danger"></span></label>

                                                <div class="col-md-9">
                                                    <input class="form-control" type="text" placeholder="GL Name"
                                                        value="" id="name" name="name">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Parent G/L Code<span
                                                        class="text-danger"></span></label>

                                                <div class="col-md-9">
                                                    <select name="parent_id" id="parent_id" class="form-control">
                                                        <option value="">None</option>
                                                        @foreach ($parentGlCodes as $parentGlCode)
                                                            <option value="{{ $parentGlCode->id }}">
                                                                {{ $parentGlCode->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label" for="description">Description<span
                                                        class="text-danger"></span></label>

                                                <div class="col-md-9">
                                                    <textarea name="description" id="description" class="form-control">
                                                        </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layout.footer')
