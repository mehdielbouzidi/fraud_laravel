@extends('layouts.app', ['scans' => $scans])
@section('title', 'Scans')

@section('content')
    <div class="mx-auto container py-5">
        <h2 class="text-3xl">Welcome,</h2>
        <p> On this page you will find your scans </p>
        <table class="text-left text-gray-500 dark:text-gray-400 w-full mt-5">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Id
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created at
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($scans as $scan)
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-800 cursor-pointer" onclick="window.location='{{ url('scan', $scan->id) }}'">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $scan->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $scan->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection