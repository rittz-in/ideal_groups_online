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
        Schema::create('uses_coupon_codes', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('coupon_code')->nullable();
            $table->string('coupon_type')->nullable();
            $table->string('coupon_amount')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uses_coupon_codes');
    }
};
