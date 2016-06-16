<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Sale extends Model
{
	protected $table = 'catalog_sales';

	protected $fillable = ['title','image','entry','content','company_id','meta_title','meta_description'];

	public static function validator ($fields) {
		return Validator::make($fields,[
			'title' => 'required|max:255',
			'entry' => 'required|min:50|max:380',
			'image' => 'required',
			'content' => 'required|min:100',
	    ],[
			'title.required' => 'Введите заголовок акции.',
			'title.max' => 'Заголовок должен быть не больше 255 символов.',
			'image.required' => 'Загрузите картинку.',
			'entry.required' => 'Заполните краткое содержание акции.',
			'entry.min' => 'Краткое содержание должно быть не меньше 50 символов.',
			'entry.max' => 'Краткое содержание должно быть не больше 380 символов.',
			'content.required' => 'Заполните текст акции.',
			'content.min' => 'Текст акции должен быть не меньше 100 символов.',
	    ]);
	}

	public function company () {
		return $this->belongsTo('App\Models\Catalog\Company');
	}
}
