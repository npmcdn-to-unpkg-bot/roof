<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetaTagsColumns extends Migration
{

    protected $tables = [
            'articles',
            'buildings',
            'catalog_companies',
            'catalog_posts',
            'catalog_sales',
            'education_posts',
            'library_posts',
            'pages',
            'tenders',
            'events',
            'offers',
            'sales'
        ];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        foreach ($this->tables as $table){
            Schema::table($table, function (Blueprint $table){
                $table->string('meta_title');
                $table->text('meta_description');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->tables as $table){
            Schema::table($table, function (Blueprint $table){
                $table->dropColumn('meta_title');
                $table->dropColumn('meta_description');
            });
        }
    }
}
