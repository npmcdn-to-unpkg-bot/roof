<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

	public $fillable = ['user_id','service_id'];

    public function orderable(){
    	return $this->morphTo();
    }
    public function service(){
    	return $this->belongsTo('App\Models\Service');
    }
    public function apply(){
    	$this->service->apply($this->orderable);
    	return $this;
    }
}
