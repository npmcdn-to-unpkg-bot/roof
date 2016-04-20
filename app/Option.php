<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    public $timestamps = false;

    protected $fillable = ['name','value'];

    public static function firstValue ($name) {
    	$option = self::where('name', $name)->first();
    	return $option ? $option->value : false;
    }

}
