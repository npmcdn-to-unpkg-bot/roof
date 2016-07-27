<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanyIdColumnToOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reserves',function($table){
            $table->dropColumn('user_id');
            $table->integer('company_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('reserves',function($table){
            $table->dropColumn('company_id');
            $table->integer('user_id')->index();
        });
    }
}
