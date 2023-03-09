<?php
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\CustomerController;

it('returns a list of customers', function () {
    $customers = [
        [
            'customerId' => 1,
            'bsn' => '123',
            'firstName' => 'John',
            'lastName' => 'Doe',
            'dateOfBirth' => '2000-01-01',
            'phoneNumber' => '0612345678',
            'email' => 'john.doe@example.com',
            'tag' => 'tag',
            'ipAddress' => '192.168.0.1',
            'iban' => 'NL91ABNA0417164300',
            'lastInvoiceDate' => '2022-02-01',
            'lastLoginDateTime' => '2022-02-15 13:45:00',
        ],
        [
            'customerId' => 2,
            'bsn' => '123',
            'firstName' => 'Jane',
            'lastName' => 'Doe',
            'dateOfBirth' => '1995-05-05',
            'phoneNumber' => '0612345678',
            'email' => 'jane.doe@example.com',
            'tag' => 'tag',
            'ipAddress' => '192.168.0.2',
            'iban' => 'NL91ABNA0417164300',
            'lastInvoiceDate' => '2022-02-01',
            'lastLoginDateTime' => '2022-02-15 14:30:00',
        ],
    ];

    Http::fake([
        'localhost:8081/api/v1/customers' => Http::response(['customers' => $customers], 200)
    ]);

    // Call the getCustomers method on the CustomerController
    $controller = new CustomerController;
    $customers = $controller->getCustomers();

    // Check that the response contains the expected data
    expect($customers)->toBeArray();
});

it('returns the error view when the API request fails', function () {
    Http::fake(['localhost:8081/api/v1/customers' => Http::response(['message' => 'Bad Request'], 404)]);

    // Call the getCustomers method on the CustomerController
    $controller = new CustomerController;
    $response = $controller->getCustomers();

    expect($response->status())->toBe(404);
});
