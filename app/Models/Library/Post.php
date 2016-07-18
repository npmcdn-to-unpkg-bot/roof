<?php

namespace App\Models\Library;

use Validator;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

	protected $table = 'library_posts';

	protected $fillable = ['id','title','image','entry','content','meta_title','meta_description'];
	
    public function categories () {
    	return $this->belongsToMany('App\Models\Library\Category','library_category_post','post_id','category_id');
    }

    public function tags () {
    	return $this->belongsToMany('App\Models\Tag','library_post_tag','post_id','tag_id');
    }

    public static function validator ($fields) {
    	return Validator::make($fields,
		 	[
				'title' => 'required|max:255',
				'entry' => 'required|min:20|max:380',
		    ],[
				'title.required' => 'Введите заголовок записи.',
				'title.max' => 'Заголовок должен быть не больше 255 символов.',
				'entry.required' => 'Заполните краткое содержание записи.',
				'entry.min' => 'Краткое содержание должно быть не меньше 20 символов.',
				'entry.max' => 'Краткое содержание должно быть не больше 380 символов.',
				'content.required' => 'Заполните текст записи.',
		    ]);

    }
}
