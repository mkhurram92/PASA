{{-- resources/views/transactions/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <h2>Transaction Details</h2>
    <p><strong>Description:</strong> {{ $transaction->description }}</p>
    <p><strong>Transaction Date:</strong> {{ $transaction->transaction_date }}</p>
    <p><strong>Created At:</strong> {{ $transaction->created_at }}</p>
    <p><strong>Updated At:</strong> {{ $transaction->updated_at }}</p>
    <a href="{{ route('transactions.index') }}" class="btn btn-primary">Back to Transactions</a>
@endsection
