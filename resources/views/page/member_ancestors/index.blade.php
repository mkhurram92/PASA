@include('layout.header')
@include('layout.sidebar')

<div class="app-content main-content">
    <div class="side-app">
        <style>
            .form-group {
                display: flex;
                align-items: center;
                margin-bottom: 0.5rem;
            }

            .form-group label {
                margin-right: 1rem;
            }

            .form-group select {
                flex: 1;
            }

            .btn-primary {
                margin-top: 0;
            }
        </style>
        <div class="container-fluid main-container">
            <!--Page header-->
            <div class="page-header">
                <div class="page-leftheader">
                    <h4 class="page-title">Member Ancestors</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @elseif(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="card-body">
                            <form method="POST" action="{{ route('member_ancestors.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="member_id">Select Member:</label>
                                    <select id="member_id" name="member_id" class="form-control" required>
                                        <option value="">-- Select Member --</option>
                                        @foreach ($members as $member)
                                            <option value="{{ $member->id }}">{{ $member->given_name }} {{ $member->family_name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="ancestor_id">Select Ancestor:</label>
                                    <select id="ancestor_id" name="ancestor_id" class="form-control" required>
                                        <option value="">-- Select Ancestor --</option>
                                        @foreach ($ancestors as $ancestor)
                                            <option value="{{ $ancestor->id }}">{{ $ancestor->given_name }} {{ $ancestor->ancestor_surname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <!-- Align dropdowns and button in one line -->
                                <div class="form-group d-flex align-items-center">
                                    <div class="mr-2">
                                        <button type="submit" class="btn btn-primary">Add Ancestor</button>
                                    </div>
                                </div>
                                
                            </form>

                            <table class="table mt-3">
                                <thead>
                                    <tr>
                                        <th>Member</th>
                                        <th>Ancestor</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($memberAncestors as $member)
                                        @foreach ($member->ancestors as $ancestor)
                                            <tr>
                                                <td>{{ $member->given_name }} {{ $member->family_name }}</td>
                                                <td>{{ $ancestor->given_name }} {{ $ancestor->ancestor_surname }}</td>
                                                <td>
                                                    <form
                                                        action="{{ route('member_ancestors.destroy', [$member->id, $ancestor->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Remove</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layout.footer')
