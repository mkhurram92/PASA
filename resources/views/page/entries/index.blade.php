{{-- resources/views/entries/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <h2>Entries</h2>
    <a href="{{ route('entries.create') }}" class="btn btn-success">Create Entry</a>
    <a href="{{ route('entries.report') }}">Generate Report</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Account</th>
                <th>Transaction</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($entries as $entry)
                <tr>
                    <td>{{ $entry->id }}</td>
                    <td>{{ $entry->account->name }}</td>
                    <td>{{ $entry->transaction->description }}</td>
                    <td>{{ $entry->type }}</td>
                    <td>{{ $entry->amount }}</td>
                    <td>
                        <a href="{{ route('entries.show', $entry->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('entries.edit', $entry->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('entries.destroy', $entry->id) }}" method="POST" style="display: inline;">
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
