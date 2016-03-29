<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialisation extends Model
{
	protected $fillable = ['name'];

	public function companies () {
		return $this->belongsToMany('App\Company');
	}
}
