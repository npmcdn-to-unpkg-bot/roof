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
				'title' => 'required|max:255',
				'entry' => 'required|max:380',
				'content' => 'required|max:65535',
		    ],[
				'title.required' => 'Введите заголовок записи.',
				'title.max' => 'Заголовок должен быть не больше 255 символов.',
				'entry.required' => 'Заполните краткое содержание записи.',
				'entry.max' => 'Краткое содержание должно быть не больше 380 символов.',
				'content.required' => 'Заполните текст записи.',
				'content.max' => 'Текст записи должен быть не более 65535 символов.',
		    ]);

    }
}
