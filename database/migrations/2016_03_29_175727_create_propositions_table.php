<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propositions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('name');
        });
        Schema::create('company_proposition', function (Blueprint $table) {
            $table->integer('company_id')->index();
            $table->integer('proposition_id')->index();
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('propositions');
        Schema::drop('company_proposition');
    }
}
