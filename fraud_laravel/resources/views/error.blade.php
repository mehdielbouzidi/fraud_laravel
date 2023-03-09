@extends('layouts.app')
@section('title', 'Error')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-red-500 text-2xl font-bold mb-4">{{ $message }}</h1>
        <p class="text-gray-500">{{ $description }}</p>
    </div>
@endsection