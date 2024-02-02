<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Order extends Model
{
    use HasFactory; //LogsActivity;
    protected $fillable = [
        'orderscm',
        'orderdate',
        'supplyname',
        'companyreg',
        'supplycsd',
        'streetname',
        'town',
        'zipcode',
        'namesurname',
        'email',
        'cellnumber',
        'description',
        'qty',
        'orderamount',
        'orderComments'
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'order_id', 'id');
    }

    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults()
    //         ->logOnly(['orderscm', 'orderdate', 'supplyname']);
    //     // Chain fluent methods for configuration options
    // }
}