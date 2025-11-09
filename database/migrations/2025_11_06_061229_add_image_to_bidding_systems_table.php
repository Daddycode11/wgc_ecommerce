<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('bidding_systems', function (Blueprint $table) {
            $table->string('image')->nullable()->after('min_bid_increment'); // Add the image column
        });
    }

    public function down(): void
    {
        Schema::table('bidding_systems', function (Blueprint $table) {
            $table->dropColumn('image'); // Remove column on rollback
        });
    }
};
