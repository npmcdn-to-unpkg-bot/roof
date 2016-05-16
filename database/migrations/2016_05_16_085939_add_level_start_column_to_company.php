<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLevelStartColumnToCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catalog_companies', function (Blueprint $table){
            $table->integer('max_level_ever');
            $table->date('max_level_start');
            $table->date('level_end');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('catalog_companies', function (Blueprint $table){
            $table->dropColumn('max_level_ever');
            $table->dropColumn('max_level_start');
            $table->dropColumn('level_end');
        });
    }
}
