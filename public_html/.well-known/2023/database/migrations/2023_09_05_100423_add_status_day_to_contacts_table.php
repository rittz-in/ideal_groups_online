<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->boolean('mondayStatus')->default(false);
            $table->boolean('Tuesdaystatus')->default(false);
            $table->boolean('Wednesdaystatus')->default(false);
            $table->boolean('wednesday_status')->default(false);
            $table->boolean('Thursdaystatus')->default(false);
            $table->boolean('fridaystatus')->default(false);
            $table->boolean('Saturdaystatus')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            //
        });
    }
};
