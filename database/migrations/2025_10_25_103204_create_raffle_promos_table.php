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
        Schema::create('raffle_promos', function (Blueprint $table) {
            $table->id();

            // Basic event info
            $table->string('event_name'); // Name of the raffle event

            // Entry and cutoff dates
            $table->dateTime('entry_date'); // When entry opens
            $table->dateTime('end_date'); // When entry closes
            $table->dateTime('draw_date')->nullable(); // Date when raffle is drawn

            // Prize information
            $table->enum('prize_type', ['item', 'coupon', 'voucher'])->default('item');
            $table->text('prize_description')->nullable(); // Description of prize
            $table->string('prize_image')->nullable(); // Image for the prize

            // Ticket info
            $table->integer('number_of_tickets')->default(0);
            $table->decimal('ticket_price', 10, 2)->default(0);

            // Status (active or not)
            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raffle_promos');
    }
};
