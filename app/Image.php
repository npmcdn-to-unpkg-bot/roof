<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

	protected $fillable = ['name','order'];

	public $timestamps = false;
}
