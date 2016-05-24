<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Post extends Model
{
	protected $table = 'catalog_posts';

	protected $fillable = ['id','title','image','entry','content','company_id','meta_title','meta_description'];

	public static function validator ($fields) {
		return Validator::make($fields,[
			'title' => 'required|max:255',
			'entry' => 'required|min:120|max:380',
			'content' => 'required|min:500',
	    ],[
			'title.required' => 'Введите заголовок статьи.',
			'title.max' => 'Заголовок должен быть не больше 255 символов.',
			'entry.required' => 'Заполните краткое содержание статьи.',
			'entry.min' => 'Краткое содержание должно быть не меньше 120 символов.',
			'entry.max' => 'Краткое содержание должно быть не больше 380 символов.',
			'content.required' => 'Заполните текст статьи.',
			'content.min' => 'Текст статьи должен быть не меньше 500 символов.',
	    ]);
	}

	public function company () {
		return $this->belongsTo('App\Models\Catalog\Company');
	}
}
