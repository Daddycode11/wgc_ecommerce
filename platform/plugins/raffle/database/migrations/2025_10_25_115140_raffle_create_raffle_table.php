<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        // Main raffles table
        Schema::create('raffles', function (Blueprint $table) {
            $table->id();

            // Basic event info
            $table->string('event_name'); // Raffle event title

            // Entry and cutoff dates
            $table->dateTime('entry_date'); // When entry opens
            $table->dateTime('end_date');   // When entry closes
            $table->dateTime('draw_date')->nullable(); // When raffle draw happens

            // Prize info
            $table->enum('prize_type', ['item', 'coupon', 'voucher'])->default('item');
            $table->text('prize_description')->nullable();
            $table->string('prize_image')->nullable(); // Prize image path (uploads)

            // Ticket info
            $table->integer('number_of_tickets')->default(0);
            $table->decimal('ticket_price', 10, 2)->default(0);

            // Active / inactive status
            $table->string('status', 60)->default('published'); // Botble prefers string-based enums

            $table->timestamps();
        });

        // Translation table for multilingual support
        Schema::create('raffles_translations', function (Blueprint $table) {
            $table->string('lang_code');
            $table->foreignId('raffle_id')->constrained('raffles')->onDelete('cascade');
            $table->string('event_name')->nullable();
            $table->text('prize_description')->nullable();

            $table->primary(['lang_code', 'raffle_id'], 'raffles_translations_primary');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('raffles_translations');
        Schema::dropIfExists('raffles');
    }
};
