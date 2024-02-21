{{-- resources/views/pages/entries/edit.blade.php --}}
@extends('layouts.app')

@section('content')
    <h2>Edit Entry</h2>

    <form action="{{ route('entries.update', $entry->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="account_id">Account:</label>
            <select name="account_id" id="account_id" class="form-control" required>
                @foreach ($accounts as $account)
                    <option value="{{ $account->id }}" {{ $entry->account_id == $account->id ? 'selected' : '' }}>
                        {{ $account->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="transaction_id">Transaction:</label>
            <select name="transaction_id" id="transaction_id" class="form-control" required>
                @foreach ($transactions as $transaction)
                    <option value="{{ $transaction->id }}" {{ $entry->transaction_id == $transaction->id ? 'selected' : '' }}>
                        {{ $transaction->description }}
                    </option>
                @endforeach
            </select>
        </div>
        <!-- Other form fields... -->
        <button type="submit" class="btn btn-primary">Update Entry</button>
    </form>
@endsection
