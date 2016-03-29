<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->index();
            $table->string('slug');
            $table->string('name');
            $table->string('logo');
            $table->string('adress');
            $table->string('email');            
            $table->string('phone');
            $table->boolean('privat');
            $table->boolean('association');
            $table->date('register');
            $table->text('entry');
            $table->text('about');
            $table->text('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('companies');
    }
}
