{{-- resources/views/transactions/create.blade.php --}}
@extends('layouts.app')

@section('content')
    <h2>Create Transaction</h2>

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" name="description" id="description" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="transaction_date">Transaction Date:</label>
            <input type="date" name="transaction_date" id="transaction_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Transaction</button>
    </form>
@endsection
