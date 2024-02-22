<!-- resources/views/page/transaction/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Edit Transaction</h2>

    <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
        @csrf
        @method('PUT')
        {{-- Add your form fields for transaction editing --}}
        <button type="submit">Update Transaction</button>
    </form>
@endsection
