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
        Schema::create('temp_addcarts', function (Blueprint $table) {
            $table->id();
            $table->string('guest_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('product_id')->nullable();
            $table->string('variant_size')->nullable();
            $table->string('quntity')->nullable();
            $table->string('amount')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('order_status')->nullable();
            $table->string('cartDate')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_addcart');
    }
};
