<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [

        'order_id',
        'invoicedate',
        'typepayment',
        'invoicescm',
        'invoiceamount',
        'invoicereceiver',
        'disputedinvoice',
        'invoiceComments',
        'supplyname'
    ];
    public function orders()
    {
        return $this->belongsTo(Order::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'invoice_id', 'id');
    }
}
