{{-- resources/views/entries/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <h2>Entry Details</h2>
    <p><strong>ID:</strong> {{ $entry->id }}</p>
    <p><strong>Account:</strong> {{ $entry->account->name }}</p>
    <p><strong>Transaction:</strong> {{ $entry->transaction->description }}</p>
    <p><strong>Type:</strong> {{ $entry->type }}</p>
    <p><strong>Amount:</strong> {{ $entry->amount }}</p>
    <p><strong>Created At:</strong> {{ $entry->created_at }}</p>
    <p><strong>Updated At:</strong> {{ $entry->updated_at }}</p>
    <a href="{{ route('entries.index') }}" class="btn btn-primary">Back to Entries</a>
@endsection
