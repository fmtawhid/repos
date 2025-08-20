<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorCustomer extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'customer_id', 'vendor_id', 'branch_id','order_times'
    ];
}
