<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Member extends Model
{

	protected $table = 'catalog_members';

	protected $fillable = ['name','image','job','company_id'];

	public static function validator ($fields) {
		return Validator::make($fields,[
			'name' => 'required|max:255',
			'job' => 'required|max:255',
	    ],[
			'name.required' => 'Введите имя сотрудника.',
			'name.max' => 'Имя сотрудника должно быть не больше 255 символов.',
			'job.required' => 'Должность сотрудника обязательное поле.',
			'job.max' => 'Название должности должно быть не больше 255 символов.',
	    ]);
	}

	public function company () {
		return $this->belongsTo('App\Models\Catalog\Company');
	}
}
