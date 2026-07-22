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
        try {
            Schema::table('categories', function (Blueprint $table) {
                // Try dropping unique index
                $table->dropUnique(['slug']);
            });
        } catch (\Exception $e) {}

        try {
            Schema::table('categories', function (Blueprint $table) {
                // Try dropping normal index
                $table->dropIndex(['slug']);
            });
        } catch (\Exception $e) {}

        try {
            Schema::table('products', function (Blueprint $table) {
                $table->dropUnique(['slug']);
            });
        } catch (\Exception $e) {}

        try {
            Schema::table('products', function (Blueprint $table) {
                $table->dropIndex(['slug']);
            });
        } catch (\Exception $e) {}
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Re-adding isn't strictly necessary if it's already there or if we don't care about the rollback failing
    }
};


