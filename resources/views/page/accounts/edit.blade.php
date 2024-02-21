{{-- resources/views/pages/accounts/edit.blade.php --}}
@extends('layouts.app')

@section('content')
    <h2>Edit Account</h2>
    <form action="{{ route('accounts.update', $account->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $account->name }}" required>
        </div>
        <div class="form-group">
            <label for="type">Type:</label>
            <select name="type" id="type" class="form-control" required>
                <option value="Asset" {{ $account->type === 'Asset' ? 'selected' : '' }}>Asset</option>
                <option value="Liability" {{ $account->type === 'Liability' ? 'selected' : '' }}>Liability</option>
                <option value="Equity" {{ $account->type === 'Equity' ? 'selected' : '' }}>Equity</option>
                <option value="Income" {{ $account->type === 'Income' ? 'selected' : '' }}>Income</option>
                <option value="Expense" {{ $account->type === 'Expense' ? 'selected' : '' }}>Expense</option>
            </select>
        </div>
        <div class="form-group">
            <label for="balance">Balance:</label>
            <input type="number" name="balance" id="balance" class="form-control" value="{{ $account->balance }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Account</button>
    </form>
@endsection
