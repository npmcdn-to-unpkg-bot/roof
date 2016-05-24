<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenders', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('image')->nullable();
            $table->integer('company_id')->index();
            $table->string('company_name')->nullable();
            $table->string('budget')->nullable();
            $table->string('person')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->date('end');
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tenders');
    }
}
