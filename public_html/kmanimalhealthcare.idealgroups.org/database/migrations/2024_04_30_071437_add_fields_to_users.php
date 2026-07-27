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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('firstname')->nullable()->after('name');
            $table->string('lastname')->nullable()->after('firstname');
            $table->string('address2')->nullable()->after('address');
            $table->string('country')->nullable()->after('address2');
            $table->string('state')->nullable()->after('country');
            $table->string('zip')->nullable()->after('state');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
