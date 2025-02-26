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
        Schema::create('paymentplanquotes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('quote');
            $table->unsignedInteger('quote_days')->nullable();
            $table->date('credit_term_init_date');
            $table->date('credit_term_end_date');
            $table->unsignedInteger('capital_fee_amount')->nullable();
            $table->unsignedInteger('interest_fee_amount')->nullable();
            $table->unsignedInteger('debt_balance')->nullable();
            $table->string('status');

            $table->foreignId('rotativeline_id')->constrained('rotativelines')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paymentplans');
    }
};
