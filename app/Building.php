<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    
	public function jobs () {
		return $this->hasMany('App\Job');
	}

	public function images () {
		return $this->belongsToMany('App\Images');
	}

	public function company () {
		return $this->belongsTo('App\Company');
	}

	public function country () {
		return $this->belongsTo('App\Country');
	}

	public function region () {
		return $this->belongsTo('App\Region');
	}

	public function city () {
		return $this->belongsTo('App\City');
	}

}
