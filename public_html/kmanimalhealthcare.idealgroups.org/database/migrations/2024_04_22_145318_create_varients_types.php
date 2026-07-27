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
        Schema::create('varients_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('varient_id')->nullable()->constrained();
            $table->foreign('varient_id')->references('id')->on('product_varients')->onDelete('cascade');
            $table->string('variant_sizes')->nullable();
            $table->boolean('status')->default(true)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('varients_types');
    }
};
