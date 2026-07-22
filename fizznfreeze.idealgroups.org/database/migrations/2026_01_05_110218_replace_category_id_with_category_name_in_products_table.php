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
        Schema::table('products', function (Blueprint $table) {
            // Drop foreign key first if it exists, assuming convention 'products_category_id_foreign'
            $table->dropForeign(['category_id']); 
            $table->dropColumn('category_id');
            $table->string('category_name')->nullable()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('category_name');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade');
        });
    }
};
