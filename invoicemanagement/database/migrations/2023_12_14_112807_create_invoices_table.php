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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->unsignedBigInteger('order_id');
            $table->date('invoicedate');
            $table->string('invoicescm')->unique();
            $table->string('invoiceamount');
            $table->string('tax');
            $table->string('invoicereceiver');
            $table->string('disputedinvoice')->nullable();
            $table->string('invoiceComments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};