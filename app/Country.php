<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    
    public function companies () {
    	return $this->hasMany('App\Company');
    }

    public function buildings () {
    	return $this->hasMany('App\Building');
    }

    public function regions () {
    	return $this->hasMany('App\Region');
    }

}
