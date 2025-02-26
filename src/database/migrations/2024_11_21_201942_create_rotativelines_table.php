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
        Schema::create('rotativelines', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('number_line');
            $table->date('disbursement_date');
            $table->string('status');
            $table->unsignedInteger('financed_amount')->nullable();
            $table->unsignedInteger('capital_paid_amount')->nullable();
            $table->unsignedInteger('amount_to_have_today')->nullable();

            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rotativelines');
    }
};
