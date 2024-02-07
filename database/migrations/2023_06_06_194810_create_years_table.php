<?php

use App\Models\Year;
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
        Schema::create('years', function (Blueprint $table) {
            $table->id();
            $table->string("year");
            $table->timestamps();
        });
        // seed year
        $currentYear = date('Y');
        $startYear = 1800;
        $years = array();

        for ($year = $startYear; $year <= $currentYear; $year++) {
            $years[] = ["year"=> $year];
        }
        Year::truncate();
        Year::insert($years);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('years');
    }
};
