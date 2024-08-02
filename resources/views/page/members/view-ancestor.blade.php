@include('layout.header')
@include('layout.sidebar')

<div class="app-content main-content">
    <div class="side-app">
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: center;
            }

            th {
                background-color: #f2f2f2;
                text-align: center;
            }
        </style>
        <div class="container-fluid main-container">
            <!--Page header-->
            <div class="page-header">
                <div class="page-leftheader">
                    <h4 class="page-title"></h4>
                </div>
            </div>
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

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">{{ $member->given_name }} {{ $member->family_name }} Ancestor Details </h3>
                            <div>
                                <a class="btn btn-success mr-2" href="{{ url()->current() }}/edit" id="editLink">
                                    <i class="pe-7s-pen btn-icon-wrapper" style="font-size:20px;"> Edit</i>
                                </a>

                                <a class="btn btn-info" href="{{ route('members.index') }}">
                                    <i class="fa fa-arrow-circle-left" style="font-size:20px;"> Back</i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="card-body">
                                <div class="row">
                                    @if ($member->ancestors->isEmpty())
                                        <p>No ancestors found for this member.</p>
                                    @else
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Gender</th>
                                                    <th>Surname</th>
                                                    <th>Given Name</th>
                                                    <th>Birth Date</th>
                                                    <th>Birth Place</th>
                                                    <th>Death Date</th>
                                                    <th>Death Place</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($member->ancestors as $ancestor)
                                                    <tr>
                                                        <td>{{ $ancestor->gender }}</td>
                                                        <td>{{ $ancestor->ancestor_surname }}</td>
                                                        <td>{{ $ancestor->given_name }}</td>
                                                        <td>
                                                            @php
                                                                $birthDate = [];
                                                                if ($ancestor->year_of_birth) {
                                                                    $birthDate[] = str_pad($ancestor->year_of_birth, 4, '0', STR_PAD_LEFT);
                                                                }
                                                                if ($ancestor->month_of_birth) {
                                                                    $birthDate[] = str_pad($ancestor->month_of_birth, 2, '0', STR_PAD_LEFT);
                                                                }
                                                                if ($ancestor->date_of_birth) {
                                                                    $birthDate[] = str_pad($ancestor->date_of_birth, 2, '0', STR_PAD_LEFT);
                                                                }
                                                                echo implode('-', $birthDate);
                                                            @endphp
                                                        </td>
                                                        <td>{{ $ancestor->place_of_birth }}</td>
                                                        <td>
                                                            @php
                                                                $deathDate = [];
                                                                if ($ancestor->year_of_death) {
                                                                    $deathDate[] = str_pad($ancestor->year_of_death, 4, '0', STR_PAD_LEFT);
                                                                }
                                                                if ($ancestor->month_of_death) {
                                                                    $deathDate[] = str_pad($ancestor->month_of_death, 2, '0', STR_PAD_LEFT);
                                                                }
                                                                if ($ancestor->date_of_death) {
                                                                    $deathDate[] = str_pad($ancestor->date_of_death, 2, '0', STR_PAD_LEFT);
                                                                }
                                                                echo implode('-', $deathDate);
                                                            @endphp
                                                        </td>
                                                        <td>{{ $ancestor->place_of_death }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layout.footer')
