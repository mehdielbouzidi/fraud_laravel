<?php
namespace App\Http\Controllers;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class CustomerController extends Controller
{
    public function getCustomers()
    {
        try {
            $response = Http::get('http://localhost:8080/api/v1/customers');
            
            if ($response->successful()) {
                $customers = $response->json()['customers'];

                return $customers;
            } else {
                return response()->view('error', [
                    'message' => 'Unable to retrieve customers',
                    'description' => $response->body(),
                ], $response->status());
            }
        } catch (RequestException $e) {
            return back()->with('error', 'Failed to fetch customers: ' . $e->getMessage());
        }
    }
}
