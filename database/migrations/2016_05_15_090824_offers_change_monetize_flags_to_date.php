<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OffersChangeMonetizeFlagsToDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function (Blueprint $table){
            $table->date('framed')->nullable(false)->change();
            $table->date('top')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offers', function (Blueprint $table){
            $table->boolean('framed')->nullable()->change();
            $table->boolean('top')->nullable()->change();
        });
    }
}
