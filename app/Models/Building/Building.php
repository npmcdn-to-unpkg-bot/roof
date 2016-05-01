<?php

namespace App\Models\Building;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Building extends Model
{
    
	protected $fillable = [
		'id',
		'name',
		'type',
		'information',
		'published',
		'start',
		'end',
		'company_id',
		'company_name',
		'lat',
		'lng',
		'city_id',
		'address'
	];

	public static function validator ($fields) {
		return Validator::make($fields,[
		        'name' => 'required|min:3|max:255',
		        'type' => 'required|min:3|max:255',
		        'images' => 'required',
		        'information' => 'required|min:50',
		        'start' => 'required|date_format:"m Y"',
		        'end' => 'required|date_format:"m Y"',
		    ],[
		        'name.required' => 'Введите название объекта',
		        'name.max' => 'Название должно быть не больше 255 символов',
		        'name.min' => 'Название должно быть не меньше 3 символов',
		        'type.required' => 'Введите тип обхекта',
		        'type.max' => 'Тип объекта должен быть не больше 255 символов',
		        'type.min' => 'Тип объекта должен быть не меньше 3 символов',
		        'images.required' => 'Загрузите изображения',
		        'information.required' => 'Введите инофрмация об объекте',
		        'information.min' => 'Описание должно быть не менее 50 символов',
		        'start.required'=> 'Это поле обязательно.',
		        'end.required'=> 'Это поле обязательно.',
		    ]);
	}

	protected $dates = ['created_at', 'updated_at', 'start', 'end'];

	public function printAddress () {
		if ($this->city){
			return $this->city->country->name.', г. '
			.$this->city->name.', '
			.$this->address;
		}
		return false;
	}

	public function jobs () {
		return $this->belongsToMany('App\Models\Building\Job');
	}

	public function images () {
		return $this->belongsToMany('App\Image')->orderBy('order');
	}

	public function company () {
		return $this->belongsTo('App\Models\Catalog\Company');
	}

	public function country () {
		return $this->belongsTo('App\Country');
	}

	public function region () {
		return $this->belongsTo('App\Region');
	}

	public function city () {
		return $this->belongsTo('App\City');
	}

	public function quarter ($quarter) {
		return str_replace(
			['1','2','3','4'],
			['I','II','III','IV'],
			$this->{$quarter}->quarter
		);
	}

	public function calendar () {
		return $this->quarter('start').' Кв-л '
				.$this->start->year.' г. '
				.'— '
				.$this->quarter('end').' Кв-л '
				.$this->start->year.' г.';
	}

}
