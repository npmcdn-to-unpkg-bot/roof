<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Example extends Model
{
    protected $table = "catalog_examples";

	protected $fillable = ['title','image','content','company_id'];

	public static function validator ($fields) {
		return Validator::make($fields,[
			'title' => 'required|max:255',
			'content' => 'required',
			'image' => 'required',
	    ],[
			'title.required' => 'Введите название примера работ.',
			'title.max' => 'Название должно быть не больше 255 символов.',
			'content.required' => 'Описание обязательное поле.',
			'image.required' => 'Загрузите фотографию.',
	    ]);
	}

	public function company () {
		return $this->belongsTo('App\Models\Catalog\Company');
	}

}
