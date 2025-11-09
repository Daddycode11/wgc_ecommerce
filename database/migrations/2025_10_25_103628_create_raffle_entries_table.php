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
        Schema::create('raffle_entries', function (Blueprint $table) {
            $table->id();

            // Foreign key to raffle promo
            $table->foreignId('raffle_promo_id')
                ->constrained('raffle_promos')
                ->cascadeOnDelete();

            // Foreign key to customer (Botble eCommerce uses ec_customers table)
            $table->foreignId('customer_id')
                ->constrained('ec_customers')
                ->cascadeOnDelete();

            // Optional unique raffle ticket or entry code
            $table->string('entry_code')->unique()->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raffle_entries');
    }
};
