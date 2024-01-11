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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->string('orderscm')->unique();
            $table->date('orderdate');
            $table->string('supplyname');
            $table->string('companyreg');
            $table->string('supplycsd');
            $table->string('streetname');
            $table->string('town');
            $table->string('zipcode');
            $table->string('namesurname');
            $table->string('email');
            $table->string('cellnumber');
            $table->string('description');
            $table->string('qty');
            $table->string('orderamount');
            $table->longText('orderComments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};