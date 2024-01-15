<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_number',
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
}

// $table->string('')->unique();
// $table->string('')->unique();
// $table->date('');
// $table->string('');
// $table->string('');
// $table->string('');
// $table->string('');
// $table->string('');
// $table->string('');
// $table->string('');
// $table->string('');
// $table->string('');
// $table->string('');
// $table->string('');
// $table->string('');
// $table->string('orderComments')->nullable();