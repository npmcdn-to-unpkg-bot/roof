<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeskCategory extends Model
{
    protected $table = 'desk_categories';

    public function offers () {
    	return $this->belongsToMany('App\Offer');
    }
}
