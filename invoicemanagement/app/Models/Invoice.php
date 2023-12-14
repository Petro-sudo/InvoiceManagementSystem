<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [

        'invoice_number',
        'order_id',
        'invoicedate',
        'invoicescm',
        'invoiceamount',
        'invoicereceiver',
        'disputedinvoice',
        'invoiceComments',
    ];
    public function orders()
    {
        return $this->belongsTo(Order::class);
    }
}
