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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('payer_id')
                ->constrained('users')->onDelete('cascade');

            $table->float('amount');
            $table->float('amount_remaining_unpaid');
            $table->float('total');
            $table->date('due_on');
            $table->boolean('is_vat_inclusive')->default(1);
            $table->float('vat_percentage')->nullable();
            $table->enum('status',['paid','outstanding','overdue'])->default('outstanding');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
