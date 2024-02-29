<!-- resources/views/page/gl_codes/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Edit G/L Code</h2>

    <form action="{{ route('gl-codes.update', $glCode->id) }}" method="POST">
        @csrf
        @method('PUT')
        {{-- Add your form fields for G/L code editing --}}
        <button type="submit">Update G/L Code</button>
    </form>
@endsection
