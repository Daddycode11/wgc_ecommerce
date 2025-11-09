<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bidding_systems', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('product_id');
            $table->decimal('starting_price', 10, 2);
            $table->decimal('min_bid_increment', 10, 2);
            $table->boolean('is_published')->default(false);
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('ec_products')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bidding_systems');
    }
};
