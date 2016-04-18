<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polls', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('question');
        });
        Schema::create('votes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('poll_id')->index();
            $table->string('answer');
            $table->string('order');
        });
        Schema::create('user_vote', function (Blueprint $table) {
            $table->integer('user_id')->index();
            $table->integer('vote_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('polls');
        Schema::drop('votes');
        Schema::drop('user_vote');
    }
}
