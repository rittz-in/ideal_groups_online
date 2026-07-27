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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->string('guest_id')->nullable();
            $table->string('card_type')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('auth_code')->nullable();
            $table->string('response_code')->nullable();
            $table->string('response_desc')->nullable();
            $table->string('payment_response')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('s_fname')->nullable();
            $table->string('s_lname')->nullable();
            $table->string('s_username')->nullable();
            $table->string('s_email')->nullable();
            $table->string('s_address1')->nullable();
            $table->string('s_address2')->nullable();
            $table->string('s_country')->nullable();
            $table->string('s_state')->nullable();
            $table->string('s_zip')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
