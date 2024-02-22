<!-- resources/views/page/transaction/create.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Create Transaction</h2>

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf
        {{-- Add your form fields for transaction creation --}}
        <button type="submit">Create Transaction</button>
    </form>
@endsection
