<?php

namespace App;

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
		'building_id',
		'company_id',
	];

    public function company () {
    	return $this->belongsTo('App\Company');
    }

    public function building () {
    	return $this->belongsTo('App\Building');
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
