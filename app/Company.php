<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	protected $fillable = [
		'name', 'logo', 'adress', 'phone', 'entry', 'about', 'services'
	];

    protected $dates = ['created_at', 'updated_at', 'register'];

    protected $dateFormat ='d.m.Y';

	protected $table = 'companies';

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
