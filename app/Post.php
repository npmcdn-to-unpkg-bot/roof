<?php

namespace App;
use Validator;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = ['id','title','image','entry','content'];
	
    public function libraries () {
    	return $this->belongsToMany('App\Library');
    }

    public static function validator ($fields) {
    	return Validator::make($fields,
		 	[
				'title' => 'required|min:35|max:255',
				'entry' => 'required|min:120|max:380',
				'content' => 'required|min:500',
		    ],[
				'title.required' => 'Введите заголовок записи.',
				'title.min' => 'Заголовок должен быть не меньше 3 символов.',
				'title.max' => 'Заголовок должен быть не больше 255 символов.',
				'entry.required' => 'Заполните краткое содержание записи.',
				'entry.min' => 'Краткое содержание должно быть не меньше 120 символов.',
				'entry.max' => 'Краткое содержание должно быть не больше 380 символов.',
				'content.required' => 'Заполните текст записи.',
				'content.min' => 'Текст записи должен быть не меньше 500 символов.',
		    ]);

    }
}
