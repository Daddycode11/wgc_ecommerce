<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('bidding_systems', function (Blueprint $table) {
            $table->timestamp('end_time')->nullable()->after('is_published');
            $table->unsignedBigInteger('winner_id')->nullable()->after('end_time');
        });
    }

    public function down(): void
    {
        Schema::table('bidding_systems', function (Blueprint $table) {
            $table->dropColumn(['end_time', 'winner_id']);
        });
    }
};
