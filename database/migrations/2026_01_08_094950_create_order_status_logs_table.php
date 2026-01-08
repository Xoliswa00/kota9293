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
        Schema::create('order_status_logs', function (Blueprint $table) {
            $table->id();
                     $table->foreignId('order_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('status'); // PENDING, PREPARING, READY, etc

            $table->foreignId('changed_by')
                ->nullable()
                ->constrained('users');

            $table->timestamp('changed_at');

            $table->timestamps();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_status_logs');
    }
};
