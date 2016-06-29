<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVoteColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments',function($table){
            $table->float('rating')->change();
            $table->integer('rating_service');
            $table->integer('rating_prof');
            $table->integer('rating_quality');
            $table->integer('rating_resp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments',function($table){
            $table->integer('rating')->change();
            $table->dropColumn('rating_service');
            $table->dropColumn('rating_prof');
            $table->dropColumn('rating_quality');
            $table->dropColumn('rating_resp');
        });
    }
}
