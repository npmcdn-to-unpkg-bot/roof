<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{

    public function company () {
    	return $this->belongsTo('App\Company');
    }

    public function building () {
    	return $this->belongsTo('App\Building');
    }
}
