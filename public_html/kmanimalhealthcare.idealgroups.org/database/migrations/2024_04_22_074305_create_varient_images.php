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
        Schema::create('varient_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('varient_id')->nullable()->constrained();
            $table->foreign('varient_id')->references('id')->on('product_varients')->onDelete('cascade');
            $table->string('images')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('varient_images');
    }
};
