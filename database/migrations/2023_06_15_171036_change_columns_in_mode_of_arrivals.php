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
        Schema::table('mode_of_arrivals', function (Blueprint $table) {
            $table->string("country_id")->nullable();
            $table->string("county_id")->nullable();
            $table->string("city_id")->nullable();
            $table->dropColumn("departure_from");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mode_of_arrivals', function (Blueprint $table) {
            $table->dropColumn("country_id");
            $table->dropColumn("county_id");
            $table->dropColumn("city_id");
            $table->string("departure_from")->nullable();
        });
    }
};
