<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    
    public function companies () {
    	return $this->hasMany('App\Company');
    }

    public function buildings () {
    	return $this->hasMany('App\Building');
    }

}
