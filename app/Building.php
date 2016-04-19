<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    
	protected $fillable = ['id','name','type','information','published','start','end'];

	public static $rules = [
        'name' => 'required|min:3|max:33',
        'type' => 'required|min:3|max:33',
        'images' => 'required',
        'information' => 'required|min:50|max:1024',
        'start' => 'required|date_format:"m Y"',
        'end' => 'required|date_format:"m Y"',
    ];

    public static $messages = [
        'name.required' => 'Введите название объекта',
        'name.max' => 'Название должно быть не больше 33 символов',
        'name.min' => 'Название должно быть не меньше 3 символов',
        'type.required' => 'Введите тип обхекта',
        'type.max' => 'Тип объекта должен быть не больше 33 символов',
        'type.min' => 'Тип объекта должен быть не меньше 3 символов',
        'images.required' => 'Загрузите изображения',
        'information.required' => 'Введите инофрмация об объекте',
        'information.min' => 'Описание должно быть не менее 50 символов',
        'information.max' => 'Описание должно быть не более 255 символов',
        'start.required'=> 'Это поле обязательно.',
        'end.required'=> 'Это поле обязательно.',
    ];

	protected $dates = ['created_at', 'updated_at', 'start', 'end'];

	public function jobs () {
		return $this->hasMany('App\Job');
	}

	public function images () {
		return $this->belongsToMany('App\Image');
	}

	public function company () {
		return $this->belongsTo('App\Company');
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
