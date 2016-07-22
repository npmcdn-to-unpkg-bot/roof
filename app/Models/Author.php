<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Author extends Model
{
	protected $fillable = ['name', 'image'];
	
	public $timestamps = false;

    public function library_posts() {
    	return $this->hasMany('App\Library\Posts');
    }

    public function education_posts() {
    	return $this->hasMany('App\Education\Posts');
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
