{{-- resources/views/pages/entries/report.blade.php --}}
@extends('layouts.app')

@section('content')
    <h2>Report</h2>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Account</th>
                <th>Transaction</th>
                <th>Type</th>
                <th>Amount</th>
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
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
