<?php

namespace App\Models\Building;

use Validator;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{

	protected $fillable = [
		'name',
		'pay',
		'requirements',
		'duties',
		'conditions',
		'information',
		'email',
		'phone',
		'seasonality',
		'company_id',
		'speciality'
	];

    public function company () {
    	return $this->belongsTo('App\Models\Catalog\Company');
    }

    public function buildings () {
    	return $this->belongsToMany('App\Models\Building\Building');
    }

    public static function validator ($fields) {
    	return Validator::make($fields,[
			'name' => 'required|max:255',
			'pay' => 'max:255',
			'information' => 'required',
			'phone' => 'required',
		],[
			'name.required' => 'Название вакансии обязательное поле.',
			'name.max' => 'Назване вакансии должно быть не длинее 255 символов.',
			'pay.max' => 'Текст об оплате не должен превышать 255 символов.',
			'information.required' => 'Информация о вакансии обязательное поле.',
			'phone.required' => 'Телефон обязательное поле.',
		]);
    }

}
