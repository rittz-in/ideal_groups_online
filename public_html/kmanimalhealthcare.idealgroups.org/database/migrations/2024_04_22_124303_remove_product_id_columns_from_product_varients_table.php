<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('product_varients', function (Blueprint $table) {

            $table->dropForeign('product_varients_product_id_foreign');
            $table->dropColumn('product_id');
            $table->dropColumn('quntity');
            $table->dropColumn('discount_price');
            $table->dropColumn('sku');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_varients', function (Blueprint $table) {
            //
        });
    }
};
