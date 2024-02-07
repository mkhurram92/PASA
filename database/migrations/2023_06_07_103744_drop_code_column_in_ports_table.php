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
        if (Schema::hasColumn('ports', 'code')) {
            Schema::table('ports', function (Blueprint $table) {
                $table->dropColumn('code');
            });
        }
    }
};
