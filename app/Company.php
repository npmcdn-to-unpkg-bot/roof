<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

	protected $table = 'companies';

    protected $dates = ['created_at', 'updated_at', 'register'];

    public function user () {
    	return $this->belongsTo('App\User');
    }

    public function propositions () {
    	return $this->belongsToMany('App\Proposition');
    }

    public function specialisations () {
    	return $this->belongsToMany('App\Specialisation');
    }    
}
