<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	protected $fillable = [
		'name', 'logo', 'adress', 'phone', 'register', 'entry', 'about', 'services'
	];

	protected $table = 'companies';

    public function user () {
    	return $this->belongsTo('App\User');
    }

    public function propositions () {
    	return $this->belongsToMany('App\Propositions');
    }

    public function specialistions () {
    	return $this->belongsToMany('App\Specialistions');
    }    
}
