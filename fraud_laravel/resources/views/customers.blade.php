@extends('layouts.app')
@section('title', 'Customers')

@section('content')
    <table class="text-sm text-left text-gray-500 dark:text-gray-400 mb-5">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th class="p-2">
                    ID
                </th>
                <th class="p-2">
                    BSN
                </th>
                <th class="p-2">
                    Name
                </th>
                <th class="p-2">
                    Last name
                </th>
                <th class="p-2">
                    DOB
                </th>
                <th class="p-2">
                    Phone number
                </th>
                <th class="p-2">
                    Email
                </th>
                <th class="p-2">
                    Tag
                </th>
                <th class="p-2">
                    IP Address
                </th>
                <th class="p-2">
                    Iban
                </th>
                <th class="p-2">
                    Last invoice date
                </th>
                <th class="p-2">
                    Last login date
                </th>
                <th class="p-2">
                    Fraud reason
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
                @include('partials.customer-row', ['customer' => $customer])
            @endforeach
        </tbody>
    </table>
@endsection
