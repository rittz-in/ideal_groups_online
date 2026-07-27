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
            $table->string("sunday_to");
            $table->string("sunday_from");
            $table->string("monday_to");
            $table->string("monday_from");
            $table->string("tuesday_to");
            $table->string("tuesday_from");
            $table->string("wednesday_to");
            $table->string("wednesday_from");
            $table->string("thursday_to");
            $table->string("thursday_from");
            $table->string("friday_to");
            $table->string("friday_from");
            $table->string("saturday_to");
            $table->string("saturday_From");
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
