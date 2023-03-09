<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scan extends Model
{
    protected $table = 'scans';

    public function customers()
    {
        return $this->belongsToMany(Customer::class)
            ->withPivot(['fraudReason'])
            ->withTimestamps();
    }

    public function customerScans()
    {
        return $this->hasMany(CustomerScan::class);
    }
}