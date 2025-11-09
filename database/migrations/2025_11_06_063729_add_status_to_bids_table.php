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
        Schema::table('bids', function (Blueprint $table) {

            // Add bidding_system_id if it doesn't exist
            if (!Schema::hasColumn('bids', 'bidding_system_id')) {
                $table->unsignedBigInteger('bidding_system_id')->nullable()->after('id');
                $table->foreign('bidding_system_id')->references('id')->on('bidding_systems')->onDelete('cascade');
            }

            // Add amount column if missing
            if (!Schema::hasColumn('bids', 'amount')) {
                $table->decimal('amount', 10, 2)->default(0)->after('bidding_system_id');
            }

            // Add status column if missing
            if (!Schema::hasColumn('bids', 'status')) {
                $table->enum('status', ['published', 'draft'])->default('published')->after('amount');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bids', function (Blueprint $table) {
            if (Schema::hasColumn('bids', 'status')) {
                $table->dropColumn('status');
            }

            if (Schema::hasColumn('bids', 'amount')) {
                $table->dropColumn('amount');
            }

            if (Schema::hasColumn('bids', 'bidding_system_id')) {
                $table->dropForeign(['bidding_system_id']);
                $table->dropColumn('bidding_system_id');
            }
        });
    }
};
