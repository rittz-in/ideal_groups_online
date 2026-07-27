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
        Schema::create('varients_types_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_id')->nullable()->constrained();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('varient_type_id')->nullable()->constrained();
            $table->foreign('varient_type_id')->references('id')->on('varients_types')->onDelete('cascade');
            $table->integer('price')->nullable();
            $table->longText('images')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Adds deleted_at column for soft delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('varients_types_details');
    }
};
