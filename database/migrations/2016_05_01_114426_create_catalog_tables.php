<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_companies', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->index();
            $table->string('slug');
            $table->string('name');
            $table->string('logo');
            $table->string('email');            
            $table->string('phone');
            $table->boolean('privat')->nullable();
            $table->boolean('association')->nullable();
            $table->text('entry');
            $table->text('about');
            $table->text('services');
            $table->decimal('lat',7,5);
            $table->decimal('lng',7,5);
            $table->string('address');
            $table->integer('city_id')->index();
        });
        Schema::create('catalog_propositions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('name');
        });
        Schema::create('catalog_company_proposition', function (Blueprint $table) {
            $table->integer('company_id')->index();
            $table->integer('proposition_id')->index();
        });
        Schema::create('catalog_specialisations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('name');
        });
        Schema::create('catalog_company_specialisation', function (Blueprint $table) {
            $table->integer('company_id')->index();
            $table->integer('specialisation_id')->index();
        });
        Schema::create('catalog_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('image');
            $table->string('title');
            $table->text('entry');
            $table->text('content');
        });
        Schema::create('catalog_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('image');
            $table->string('title');
            $table->text('entry');
            $table->text('content');
        });
        Schema::create('catalog_members', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('image');
            $table->string('name');
            $table->string('job');
        });
        Schema::create('catalog_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title');
            $table->string('name');
            $table->string('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('catalog_companies');
        Schema::drop('catalog_propositions');
        Schema::drop('catalog_company_proposition');
        Schema::drop('catalog_specialisations');
        Schema::drop('catalog_company_specialisation');
    }
}
