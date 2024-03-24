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
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('invoice_no');
            $table->date('order_date');
            $table->decimal('total_price', 12, 2);
            $table->float('discount')->nullable();
            $table->float('shipping_charge')->nullable();
            $table->float('pay_amount')->nullable();
            $table->date('delivery_date')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->text('note')->nullable();
            $table->string('payment_method')->nullable();
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
