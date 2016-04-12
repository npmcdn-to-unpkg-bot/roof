<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    public function deskcategories () {
    	return $this->belongsToMany('App\DeskCategory');
    }

    public function user () {
    	return $this->belongsTo('App\User');
    }
}
