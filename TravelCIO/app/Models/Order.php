<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'surname',
        'checkindate',
        'checkoutdate',
        'order_number',
        'reason',
        'branch'
    ];
 
}