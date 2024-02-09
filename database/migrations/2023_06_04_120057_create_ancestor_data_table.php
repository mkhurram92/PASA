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
            $table->string('date_of_birth')->nullable()->default('text');
            $table->string('notes')->nullable()->default('text');
            $table->string('occupation')->nullable()->default('text');
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
