<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Price extends Model
{
	protected $table = 'catalog_prices';

	protected $fillable = ['title','name','company_id'];

	public static function validator ($fields) {
		return Validator::make($fields,[
			'title' => 'required|max:255',
			'name' => 'required',
			'upload' => 'mimes:zip,pdf,doc,docx'
	    ],[
			'title.required' => 'Название прайс-листа.',
			'title.max' => 'Заголовок должен быть не больше 255 символов.',
			'name.required' => 'Загрузите файл прайс-листа.',
			'upload.mimes' => 'Прайс должен быть в формате zip, pdf, doc или docx'
	    ]);
	}

	public function company () {
		return $this->belongsTo('App\Models\Catalog\Company');
	}
}
