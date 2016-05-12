<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class Specialisation extends Model
{

	protected $table = 'catalog_specialisations';

	public $timestamps = false;

	protected $fillable = ['id'];

	public function companies () {
		return $this->belongsToMany(
			'App\Models\Catalog\Company',
			'catalog_company_specialisation',
			'specialisation_id',
			'company_id'
		);
	}
}
