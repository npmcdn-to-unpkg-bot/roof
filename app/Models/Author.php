<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Author extends Model
{
	protected $fillable = ['name', 'image', 'description'];
	
	public $timestamps = false;

    public function articles() {
    	return $this->hasMany('App\Article');
    }

    public static function validator ($fields) {
    	return Validator::make($fields,
		 	[
				'name' => 'required|max:255',
		    ],[
				'name.required' => 'Введите имя автора.',
				'name.max' => 'Имя автора должно быть не больше 255 символов.',
		    ]);

    }
}
