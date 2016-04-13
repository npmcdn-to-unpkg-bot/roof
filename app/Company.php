<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

	protected $table = 'companies';

    protected $fillable = [ 'name', 'logo', 'address', 'email', 'phone', 'entry', 'about', 'services' ];

    protected $dates = ['created_at', 'updated_at', 'register'];

    public function user () {
    	return $this->belongsTo('App\User');
    }

    public function buildings () {
        return $this->hasMany('App\Building');
    }

    public function jobs () {
        return $this->hasMany('App\Job');
    }

    public function propositions () {
    	return $this->belongsToMany('App\Proposition');
    }

    public function specialisations () {
    	return $this->belongsToMany('App\Specialisation');
    }    
}
