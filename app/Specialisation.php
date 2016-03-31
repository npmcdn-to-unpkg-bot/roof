<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialisation extends Model
{
	public function companies () {
		return $this->belongsToMany('App\Company');
	}
}
