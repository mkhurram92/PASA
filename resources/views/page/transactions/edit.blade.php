{{-- resources/views/transactions/edit.blade.php --}}
@extends('layouts.app')

@section('content')
    <h2>Edit Transaction</h2>

    <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" name="description" id="description" class="form-control" value="{{ $transaction->description }}" required>
        </div>
        <div class="form-group">
            <label for="transaction_date">Transaction Date:</label>
            <input type="date" name="transaction_date" id="transaction_date" class="form-control" value="{{ $transaction->transaction_date }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Transaction</button>
    </form>
@endsection
