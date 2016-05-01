<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class Proposition extends Model
{

	protected $table = 'catalog_propositions';

	public function companies () {
		return $this->belongsToMany(
			'App\Models\Catalog\Company',
			'catalog_company_proposition',
			'proposition_id',
			'company_id'
		);
	}
}
