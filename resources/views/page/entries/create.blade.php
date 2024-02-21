{{-- resources/views/page/entries/create.blade.php --}}
@extends('layouts.app')

@section('content')
    <h2>Create Entry</h2>

    <form action="{{ route('entries.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="account_id">Account:</label>
            <select name="account_id" id="account_id" class="form-control" required>
                @foreach ($accounts as $account)
                    <option value="{{ $account->id }}">{{ $account->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="transaction_id">Transaction:</label>
            <select name="transaction_id" id="transaction_id" class="form-control" required>
                @foreach ($transactions as $transaction)
                    <option value="{{ $transaction->id }}">{{ $transaction->description }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="type">Type:</label>
            <select name="type" id="type" class="form-control" required>
                <option value="debit">Debit</option>
                <option value="credit">Credit</option>
            </select>
        </div>
        <div class="form-group">
            <label for="amount">Amount:</label>
            <input type="text" name="amount" id="amount" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Entry</button>
    </form>
@endsection
