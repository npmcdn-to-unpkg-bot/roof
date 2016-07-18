<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags',function($table){
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('article_tag',function($table){
            $table->integer('article_id')->index();
            $table->integer('tag_id')->index();
        });

        Schema::create('education_post_tag',function($table){
            $table->integer('post_id')->index();
            $table->integer('tag_id')->index();
        });

        Schema::create('library_post_tag',function($table){
            $table->integer('post_id')->index();
            $table->integer('tag_id')->index();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropTable('tags');
        Schema::dropTable('article_tag');
        Schema::dropTable('education_post_tag');
        Schema::dropTable('library_post_tag');
    }
}
