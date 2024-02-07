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
        if(Schema::hasColumn('counties', 'code')){
            Schema::table('counties', function (Blueprint $table) {
                $table->dropColumn('code');
            });
        }
    }
};
