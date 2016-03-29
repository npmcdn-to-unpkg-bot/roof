<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialisations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('name');
        });
        Schema::create('company_specialisation', function (Blueprint $table) {
            $table->integer('company_id')->index();
            $table->integer('specialisation_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('specialisations');
        Schema::drop('company_specialisation');
    }
}
