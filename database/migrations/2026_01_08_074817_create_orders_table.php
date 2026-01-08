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
                $table->enum('order_source', ['IN_PERSON', 'ONLINE']);

                
    // HOW THE ORDER IS FULFILLED
    $table->enum('fulfilment_type', ['COLLECTION', 'DELIVERY']);
    $table->foreignId('user_id')->nullable()->constrained();

    // CUSTOMER (required for ONLINE)
    $table->string('customer_name')->nullable();
    $table->string('customer_phone')->nullable();

    // FINANCIALS
    $table->decimal('sub_total', 10, 2)->default(0);   // items only
    $table->decimal('delivery_fee', 10, 2)->default(0);
    $table->decimal('total_amount', 10, 2)->default(0);

    // STATUS
    $table->enum('order_status', [
        'PENDING',
        'PREPARING',
        'READY',
        'OUT_FOR_DELIVERY',
        'DELIVERED',
        'CANCELLED'
    ])->default('PENDING');

    $table->enum('payment_status', [
        'UNPAID',
        'PAID',
        'COD'
    ])->default('UNPAID');

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
