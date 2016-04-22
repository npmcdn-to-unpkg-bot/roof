<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('image');
            $table->text('information');
            $table->date('start');
            $table->date('end');
            $table->string('founder');
            $table->string('website');
            $table->decimal('lat',7,5);
            $table->decimal('lng',7,5);
            $table->string('address');
            $table->integer('city_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events');
    }
}