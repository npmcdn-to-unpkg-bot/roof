<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibraryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('image');
            $table->string('title');
            $table->text('entry');
            $table->text('content');
        });
        Schema::create('libraries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
        Schema::create('library_post', function (Blueprint $table) {
            $table->integer('library_id')->index();
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
        Schema::drop('posts');
        Schema::drop('library');
        Schema::drop('library_post');
    }
}
