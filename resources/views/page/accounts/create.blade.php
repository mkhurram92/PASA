{{-- resources/views/pages/accounts/create.blade.php --}}
@extends('layouts.app')

@section('content')
    <h2>Create Account</h2>
    <form action="{{ route('accounts.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="type">Type:</label>
            <select name="type" id="type" class="form-control" required>
                <option value="Asset">Asset</option>
                <option value="Liability">Liability</option>
                <option value="Equity">Equity</option>
                <option value="Income">Income</option>
                <option value="Expense">Expense</option>
            </select>
        </div>
        <div class="form-group">
            <label for="balance">Balance:</label>
            <input type="number" name="balance" id="balance" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Account</button>
    </form>
@endsection
