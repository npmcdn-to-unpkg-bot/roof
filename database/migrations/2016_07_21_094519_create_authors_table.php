<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors',function($table){
            $table->increments('id');
            $table->string('name');
            $table->string('image');
            $table->text('description');
        });

        Schema::table('articles',function($table){
            $table->integer('author_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('authors');

        Schema::table('articles',function($table){
            $table->dropColumn('author_id');
        });

    }
}
