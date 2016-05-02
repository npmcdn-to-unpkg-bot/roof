<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Sale extends Model
{
	protected $table = 'catalog_sales';

	protected $fillable = ['title','image','entry','content','company_id'];

	public static function validator ($fields) {
		return Validator::make($fields,[
			'title' => 'required|max:255',
			'entry' => 'required|min:120|max:380',
			'content' => 'required|min:500',
	    ],[
			'title.required' => 'Введите заголовок акции.',
			'title.max' => 'Заголовок должен быть не больше 255 символов.',
			'entry.required' => 'Заполните краткое содержание акции.',
			'entry.min' => 'Краткое содержание должно быть не меньше 120 символов.',
			'entry.max' => 'Краткое содержание должно быть не больше 380 символов.',
			'content.required' => 'Заполните текст акции.',
			'content.min' => 'Текст акции должен быть не меньше 500 символов.',
	    ]);
	}

	public function company () {
		return $this->belongsTo('App\Models\Catalog\Company');
	}
}
