<?php
namespace App\Http\Controllers;

use App\Models\CustomerScan;
use App\Models\Scan;

class ScanController extends Controller
{
    public function showCustomersPerScan($id)
    {
        $customerScans = CustomerScan::where('scanId', $id)->with('customer')->get();

        $customers = $customerScans->map(function ($customerScan) {
            return [
                'customerId' => $customerScan->customer->customerId,
                'bsn' => $customerScan->customer->bsn,
                'firstName' => $customerScan->customer->firstName,
                'lastName' => $customerScan->customer->lastName,
                'dateOfBirth' => $customerScan->customer->dateOfBirth,
                'phoneNumber' => $customerScan->customer->phoneNumber,
                'email' => $customerScan->customer->email,
                'tag' => $customerScan->customer->tag,
                'ipAddress' => $customerScan->customer->ipAddress,
                'iban' => $customerScan->customer->iban,
                'lastInvoiceDate' => $customerScan->customer->lastInvoiceDate,
                'lastLoginDateTime' => $customerScan->customer->lastLoginDateTime,
                'fraudReason' => $customerScan->fraudReason,
            ];
        })->toArray();
    
        return view('customers', compact('customers'));
    }

    public function showAllScans()
    {
        $scans = Scan::all();
        return view('scans', compact('scans'));
    }
}