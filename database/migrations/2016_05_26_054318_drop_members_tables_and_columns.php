<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropMembersTablesAndColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('catalog_members'))
            Schema::drop('catalog_members');

        Schema::table('users',function($table){
            $table->integer('company_id')->index();
            $table->integer('join_company_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users',function($table){
            $table->dropColumn('company_id');
            $table->dropColumn('join_company_id');
        });
    }
}
