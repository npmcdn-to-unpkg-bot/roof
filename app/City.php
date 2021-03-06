<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    
    protected $fillable = ['id','name'];

    public function companies () {
    	return $this->hasMany('App\Models\Catalog\Company');
    }

    public function buildings () {
    	return $this->hasMany('App\Models\Building\Building');
    }

    public function events () {
    	return $this->hasMany('App\Event');
    }

    public function offers () {
    	return $this->hasMany('App\Offer');
    }

    public function country () {
    	return $this->belongsTo('App\Country');
    }

}
