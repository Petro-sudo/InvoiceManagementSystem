<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id');
            $table->string('paymentreceiver');
            $table->date('invoicedate');
            $table->date('paydate');
            //$table->double('income_in_usd', 10, 2);
            $table->string('paidamount');
            $table->string('fullpaid');
            $table->string('paidwithin30days')->nullable();
            $table->longText('paymentComments')->nullable();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};