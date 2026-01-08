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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
             $table->foreignId('order_id')->constrained()->cascadeOnDelete();

    $table->string('delivery_person')->nullable();
    $table->enum('delivery_status', [
        'PENDING',
        'OUT_FOR_DELIVERY',
        'DELIVERED'
    ])->default('PENDING');

    $table->timestamp('delivered_at')->nullable();
    $table->timestamps();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
