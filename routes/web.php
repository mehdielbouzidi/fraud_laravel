<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FraudDetectionController;
use App\Http\Controllers\ScanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ScanController::class, 'showAllScans'])
    ->name('scans.show');

Route::get('/customers', [FraudDetectionController::class, 'fraudCheck'])
    ->name('customers.show');

Route::get('/scan/{id}', [ScanController::class, 'showCustomersPerScan'])
    ->name('customersPerScan.show');
