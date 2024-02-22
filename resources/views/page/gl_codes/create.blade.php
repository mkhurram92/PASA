<!-- resources/views/page/gl_codes/create.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Create G/L Code</h2>

    <form action="{{ route('gl-codes.store') }}" method="POST">
        @csrf
        {{-- Add your form fields for G/L code creation --}}
        <button type="submit">Create G/L Code</button>
    </form>
@endsection
