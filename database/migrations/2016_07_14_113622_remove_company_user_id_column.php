<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;
use App\Models\Catalog\Company;

class RemoveCompanyUserIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        foreach (Company::all() as $company) {
            User::where('id',$company->user_id)
            ->update([
                'company_id' => $company->id
            ]);
        }

        Schema::table('catalog_companies', function($table){
            $table->dropColumn('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('catalog_companies', function($table){
            $table->integer('user_id')->index();
        });
    }
}
