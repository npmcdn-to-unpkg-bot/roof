<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposition extends Model
{
	public function companies () {
		return $this->belongsToMany('App\Company');
	}
}
