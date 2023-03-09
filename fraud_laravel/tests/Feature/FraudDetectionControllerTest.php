<?php
use App\Models\Scan;
use App\Models\Customer;
use App\Models\CustomerScan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Client\RequestException;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FraudDetectionController;
use Illuminate\Http\Client\Response;

it('should label a customer with SAME_IP if the customer has the same IP as another customer ', function () {
    // Given two customers with the same IP address
    $ipAddress = 'some-ip';
    $customer1 = Customer::factory()->create(['ipAddress' => $ipAddress]);
    $customer2 = Customer::factory()->create(['ipAddress' => $ipAddress]);

    $controller = new FraudDetectionController();
    $response = $controller->fraudCheck(new CustomerController(), [$customer1, $customer2]);

    $customers = $response->getData()['customers'];

    expect($customers[0]->fraudReason->name)->toBe('SAME_IP');
    expect($customers[1]->fraudReason->name)->toBe('SAME_IP');
});


it('should label a customer with SAME_IBAN if the customer has the same IBAN as another customer ', function () {
    // Given two customers with the same IP address
    $iban = 'some-iban';
    $customer1 = Customer::factory()->create(['iban' => $iban]);
    $customer2 = Customer::factory()->create(['iban' => $iban]);

    $controller = new FraudDetectionController();
    $response = $controller->fraudCheck(new CustomerController(), [$customer1, $customer2]);

    $customers = $response->getData()['customers'];

    expect($customers[0]->fraudReason->name)->toBe('SAME_IBAN');
    expect($customers[1]->fraudReason->name)->toBe('SAME_IBAN');
});

it('should label a customer with NON_NL_PHONE if the customer has a non Dutch phone number', function () {
    // Given a customer with a non-Dutch phone number
    $customer = Customer::factory()->create(['phoneNumber' => '+44123123']);

    $controller = new FraudDetectionController();
    $response = $controller->fraudCheck(new CustomerController(), [$customer]);

    $customers = $response->getData()['customers'];

    expect($customers[0]->fraudReason->name)->toBe('NON_NL_PHONE');
});

it('should label a customer with UNDERAGE if the customer has a non Dutch phone number', function () {
    // Given an underage customer
    $customer = Customer::factory()->create(['dateOfBirth' => fake()->dateTimeBetween('-17 years', '-1 day')->format('Y-m-d')]);


    $controller = new FraudDetectionController();
    $response = $controller->fraudCheck(new CustomerController(), [$customer]);

    $customers = $response->getData()['customers'];

    expect($customers[0]->fraudReason->name)->toBe('UNDERAGE');
});