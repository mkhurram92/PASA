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
        Schema::table('member_pedigrees', function (Blueprint $table) {
            $table->integer("pedigree_level")->after('full_name')->nullable();
            $table->string("gender")->after('pedigree_level')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('member_pedigrees', function (Blueprint $table) {
            $table->dropColumn("pedigree_level");
            $table->dropColumn("gender");
        });
    }
};
