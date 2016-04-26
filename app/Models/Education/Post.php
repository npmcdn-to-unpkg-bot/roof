<?php

namespace App\Models\Education;

use Validator;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

	protected $table = 'education_posts';

    public function categories () {
    	return $this->belongsToMany('App\Models\Education\Category','education_category_post','post_id','category_id');
    }

	protected $fillable = ['id','title','image','entry','content'];

    public static function validator ($fields) {
    	return Validator::make($fields,
		 	[
				'title' => 'required|min:35|max:255',
				'entry' => 'required|min:120|max:380',
				'content' => 'required|min:500',
		    ],[
				'title.required' => 'Введите заголовок записи.',
				'title.min' => 'Заголовок должен быть не меньше 35 символов.',
				'title.max' => 'Заголовок должен быть не больше 255 символов.',
				'entry.required' => 'Заполните краткое содержание записи.',
				'entry.min' => 'Краткое содержание должно быть не меньше 120 символов.',
				'entry.max' => 'Краткое содержание должно быть не больше 380 символов.',
				'content.required' => 'Заполните текст записи.',
				'content.min' => 'Текст записи должен быть не меньше 500 символов.',
		    ]);

    }
}
