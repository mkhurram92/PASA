{{-- resources/views/pages/accounts/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <h2>Accounts</h2>
    <a href="{{ route('accounts.create') }}" class="btn btn-success">Create Account</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Balance</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($accounts as $account)
                <tr>
                    <td>{{ $account->id }}</td>
                    <td>{{ $account->name }}</td>
                    <td>{{ $account->type }}</td>
                    <td>{{ $account->balance }}</td>
                    <td>
                        <a href="{{ route('accounts.show', $account->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('accounts.edit', $account->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('accounts.destroy', $account->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
