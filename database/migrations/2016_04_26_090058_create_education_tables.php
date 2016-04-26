<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('image');
            $table->string('title');
            $table->text('entry');
            $table->text('content');
        });
        Schema::create('education_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
        Schema::create('education_category_post', function (Blueprint $table) {
            $table->integer('category_id')->index();
            $table->integer('post_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('education_posts');
        Schema::drop('education_categories');
        Schema::drop('education_category_post');
    }
}
