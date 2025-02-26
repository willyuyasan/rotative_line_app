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
        //
        Schema::table('rotativelines', function (Blueprint $table) {
            $table->date('payment_date')->nullable();
            $table->float('discount_rate')->nullable();
            $table->string('factoring_operation_id')->nullable();
            $table->string('issuer_tax_number')->nullable();
            $table->string('issuer_name')->nullable();
            $table->float('new_expected_payment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
