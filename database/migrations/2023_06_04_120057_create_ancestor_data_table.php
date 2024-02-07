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
        Schema::create('ancestor_data', function (Blueprint $table) {
            $table->id();
            $table->string('ancestor_surname')->nullable()->default('text');
            $table->string('maiden_surname')->nullable()->default('text');
            $table->string('given_name')->nullable()->default('text');
            $table->string('mode_of_travel_native_bith')->nullable()->default('text');
            $table->string('from')->nullable()->default('text');
            $table->string('first_date')->nullable()->default('text');
            $table->string('res1')->nullable()->default('text');
            $table->string('res2')->nullable()->default('text');
            $table->string('res3')->nullable()->default('text');
            $table->string('date_of_birth')->nullable()->default('text');
            $table->string('b_p_1')->nullable()->default('text');
            $table->string('b_p_2')->nullable()->default('text');
            $table->string('b_p_3')->nullable()->default('text');
            $table->string('notes')->nullable()->default('text');
            $table->string('emigrant_no')->nullable()->default('text');
            $table->string('field1')->nullable()->default('text');
            $table->string('occupation')->nullable()->default('text');
            $table->string('census1841')->nullable()->default('text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ancestor_data');
    }
};
