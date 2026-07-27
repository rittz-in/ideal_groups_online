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
        Schema::create('product_varients', function (Blueprint $table) {
            $table->id();

            $table->string('varient_name')->nullable();
            $table->unsignedBigInteger('product_id')->nullable()->constrained();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('quntity')->nullable();
            $table->string('price')->nullable();
            $table->string('discount_price')->nullable();
            $table->string('sku')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_varients');
    }
};
