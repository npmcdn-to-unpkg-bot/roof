<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
	protected $fillable = ['service_id','count'];

	public $timestamps = false;

    public function user () {
    	return $this->belongsTo('App\User');
    }

    public function service () {
    	return $this->belongsTo('App\Models\Service');
    }
}
