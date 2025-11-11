<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('wallet_transactions')) {
            Schema::create('wallet_transactions', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('wallet_id');
                $table->decimal('amount', 15, 2)->default(0)->nullable();
                $table->text('description')->nullable();
                $table->string('reference');
                $table->string('status')->default('pending');
                
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('wallet_transactions_translations')) {
            Schema::create('wallet__transactions_translations', function (Blueprint $table) {
                $table->string('lang_code');
                $table->foreignId('wallet__transactions_id');
                $table->string('name', 255)->nullable();

                $table->primary(['lang_code', 'wallet__transactions_id'], 'wallet__transactions_translations_primary');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('wallet_transactions');
        Schema::dropIfExists('wallet_transactions_translations');
    }
};
