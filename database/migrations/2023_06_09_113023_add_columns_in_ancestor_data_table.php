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
        Schema::table('ancestor_data', function (Blueprint $table) {
            $table->string('departure_country')->nullable();
            $table->string('departure_full_address')->nullable();
            $table->string('arrival_country')->nullable();
            $table->string('arrival_postcode')->nullable();
            $table->string('arrival_full_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ancestor_data', function (Blueprint $table) {
            $table->dropColumn('departure_country');
            $table->dropColumn('departure_full_address');
            $table->dropColumn('arrival_country');
            $table->dropColumn('arrival_postcode');
            $table->dropColumn('arrival_full_address');
        });
    }
};
