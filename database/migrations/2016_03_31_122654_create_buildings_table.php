<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('type');
            $table->text('information');
            $table->date('start');
            $table->date('end');
            $table->boolean('published')->nullable();
            $table->integer('company_id')->index();
            $table->string('company_name')->nullable();
            $table->decimal('lat',7,5);
            $table->decimal('lng',7,5);
            $table->string('address');
            $table->integer('city_id')->index();
        });

        Schema::create('building_image', function (Blueprint $table) {
            $table->integer('building_id')->index();
            $table->integer('image_id')->index();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('buildings');
        Schema::drop('building_image');
    }
}
