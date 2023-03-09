<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerScan extends Model
{
    protected $table = 'customer_scan';
    public $timestamps = false;
    protected $fillable = [
        'customerId',
        'scanId',
        'fraudReason',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerId');
    }

    public function scan()
    {
        return $this->belongsTo(Scan::class, 'scanId');
    }
}
