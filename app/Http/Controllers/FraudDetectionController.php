<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Customer;
use App\Models\Scan;
use App\Models\CustomerScan;

enum FraudReason: string {
    case SAME_IP = 'Same IP as other customer';
    case SAME_IBAN = 'Same IBAN as other customer';
    case NON_NL_PHONE = 'Non-Dutch phone number';
    case UNDERAGE = 'Customer is under 18';
}

class FraudDetectionController extends Controller
{
    public function fraudCheck(CustomerController $customerController, array $customers)
    {
        $customers = $customers ?? $customerController->getCustomers();
        $customerCollection = collect($customers);

        $scan = tap(new Scan())->save();

        $customerCollection->transform(function ($customer) use ($customerCollection, $scan) {
            // Check for customers with the same IP address
            $sameIpCustomers = $customerCollection->where('ipAddress', $customer['ipAddress'])->except($customer['customerId']);
            // Check for customers with the same IBAN
            $sameIbanCustomers = $customerCollection->where('iban', $customer['iban'])->except($customer['customerId']);

            switch (true) {
                case (count($sameIpCustomers) > 1):
                    $customer['fraudReason'] = FraudReason::SAME_IP;
                    break;
                case (count($sameIbanCustomers) > 1):
                    $customer['fraudReason'] = FraudReason::SAME_IBAN;
                    break;
                case substr($customer['phoneNumber'], 0, 3) !== '+31':
                    $customer['fraudReason'] = FraudReason::NON_NL_PHONE;
                    break;
                case (new DateTime($customer['dateOfBirth']))->diff(new DateTime('now'))->y < 18:
                    $customer['fraudReason'] = FraudReason::UNDERAGE;
                    break;
                default:
                    $customer['fraudReason'] = null;
            }

            $checkedCustomer = new Customer([
                'customerId' => $customer['customerId'],
                'bsn' => $customer['bsn'],
                'firstName' => $customer['firstName'],
                'lastName' => $customer['lastName'],
                'dateOfBirth' => date('y-m-d', strtotime($customer['dateOfBirth'])),
                'phoneNumber' => $customer['phoneNumber'],
                'email' => $customer['email'],
                'tag' => $customer['tag'],
                'ipAddress' => $customer['ipAddress'],
                'iban' => $customer['iban'],
                'lastInvoiceDate' => date('y-m-d', strtotime($customer['lastInvoiceDate'])),
                'lastLoginDateTime' => date('y-m-d H:i:s', strtotime($customer['lastLoginDateTime'])),
            ]);

            $checkedCustomer->save();

            $customerScan = new CustomerScan([
                'customerId' => $checkedCustomer->id,
                'scanId' => $scan->id,
                'fraudReason' => $customer['fraudReason'] ? $customer['fraudReason']->name : null,
            ]);

            $customerScan->save();


            return $customer;
        });

        $customers = $customerCollection;

        // Return a list of customers
        return view('customers', compact('customers'));
    }
}

