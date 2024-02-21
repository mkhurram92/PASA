{{-- resources/views/pages/accounts/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <h2>Account Details</h2>
    <p><strong>Name:</strong> {{ $account->name }}</p>
    <p><strong>Type:</strong> {{ $account->type }}</p>
    <p><strong>Balance:</strong> ${{ $account->balance }}</p>
    <a href="{{ route('accounts.index') }}" class="btn btn-primary">Back to Accounts</a>
@endsection
