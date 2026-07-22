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
    Schema::table('order_items', function (Blueprint $table) {
      $table
        ->string('batch_group', 10)
        ->nullable()
        ->after('special_instructions');
      $table
        ->string('status', 20)
        ->default('pending')
        ->after('batch_group');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('order_items', function (Blueprint $table) {
      $table->dropColumn(['batch_group', 'status']);
    });
  }
};
