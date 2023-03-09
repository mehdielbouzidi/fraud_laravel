<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $fillable = ['customerId', 'bsn', 'firstName', 'lastName', 'dateOfBirth', 'phoneNumber', 'email', 'tag', 'ipAddress', 'iban', 'lastInvoiceDate', 'lastLoginDateTime'];

    public function scans()
    {
        return $this->belongsToMany(Scan::class)->withPivot('fraudReason');
    }

    public function customerScans()
    {
        return $this->hasMany(CustomerScan::class);
    }
}
