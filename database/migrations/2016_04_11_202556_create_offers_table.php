<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->index();
            $table->string('title');
            $table->string('image');
            $table->string('price');
            $table->string('specialisation');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->boolean('framed')->nullable();
            $table->text('information');
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
        Schema::drop('offers');
    }
}
