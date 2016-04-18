<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{

	public $timestamps = false;

    public function banner () {
    	return $this->belongsTo('App\Banner');
    }
}
