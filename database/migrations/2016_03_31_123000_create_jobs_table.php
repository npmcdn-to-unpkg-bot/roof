<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('pay');
            $table->text('requirements');
            $table->text('duties');
            $table->text('conditions');
            $table->text('information');
            $table->string('phone');
            $table->string('email');
            $table->boolean('seasonality')->nullable();
            $table->integer('building_id')->index();
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
        Schema::drop('jobs');
    }
}
