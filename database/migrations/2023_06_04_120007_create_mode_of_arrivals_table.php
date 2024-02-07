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
        Schema::create('mode_of_arrivals', function (Blueprint $table) {
            $table->id();
            $table->string('voyage')->nullable();
            $table->string('ship_id')->nullable();
            $table->string('year')->nullable();
            $table->string('departure_from')->nullable()->comment("counties ID");
            $table->date('date_of_departure')->nullable();
            $table->string('arrived_at')->nullable()->comment("ports ID");
            $table->date('date_of_arrival')->nullable();
            $table->string('ship_commander')->nullable();
            $table->string('embarkation_number')->nullable();
            $table->string('notes')->nullable();
            $table->string('ports_of_call')->nullable();
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
        Schema::dropIfExists('mode_of_arrivals');
    }
};
