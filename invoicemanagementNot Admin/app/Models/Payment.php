<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'paymentreceiver',
        'invoicedate',
        'paydate',
        'paidamount',
        'paidwithin30days',
        'paymentComments',
        'fullpaid',
    ];
}