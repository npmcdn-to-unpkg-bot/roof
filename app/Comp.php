<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comp extends Model
{
	protected $fillable = [
		'name', 'logo', 'adress', 'phone', 'register', 'entry', 'about', 'services'
	];

    public function user () {
    	return $this->belongsTo('App\User');
    }
}
