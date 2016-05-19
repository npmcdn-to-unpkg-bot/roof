<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJobTenderUserColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tenders', function (Blueprint $table){
            $table->integer('user_id')->index();
        });
        Schema::table('jobs', function (Blueprint $table){
            $table->integer('user_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tenders', function (Blueprint $table){
            $table->dropColumn('user_id');
        });
        Schema::table('jobs', function (Blueprint $table){
            $table->dropColumn('user_id');
        });
    }
}
