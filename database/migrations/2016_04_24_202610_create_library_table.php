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
        Schema::create('library_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('image');
            $table->string('title');
            $table->text('entry');
            $table->longtext('content');
        });
        Schema::create('library_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('order');
        });
        Schema::create('library_category_post', function (Blueprint $table) {
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
        Schema::drop('library_posts');
        Schema::drop('library_categories');
        Schema::drop('library_category_post');
    }
}
