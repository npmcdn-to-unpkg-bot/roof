<?php

namespace App\Models\Library;

use Validator;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

	protected $table = 'library_posts';

	protected $fillable = ['id','title','image','entry','content'];
	
    public function categories () {
    	return $this->belongsToMany('App\Models\Library\Category','library_category_post','post_id','category_id');
    }

    public static function validator ($fields) {
    	return Validator::make($fields,
		 	[
				'title' => 'required|max:255',
				'entry' => 'required|min:120|max:380',
				'content' => 'required|min:500',
		    ],[
				'title.required' => 'Введите заголовок записи.',
				'title.max' => 'Заголовок должен быть не больше 255 символов.',
				'entry.required' => 'Заполните краткое содержание записи.',
				'entry.min' => 'Краткое содержание должно быть не меньше 120 символов.',
				'entry.max' => 'Краткое содержание должно быть не больше 380 символов.',
				'content.required' => 'Заполните текст записи.',
				'content.min' => 'Текст записи должен быть не меньше 500 символов.',
		    ]);

    }
}
