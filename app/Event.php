<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Event extends Model
{
    protected $fillable = [
    	'id',
    	'name',
    	'image',
    	'information',
    	'start',
    	'end',
    	'founder',
    	'lat',
    	'lng',
    	'city_id',
    	'address',
    	'website'
    ];

	public function printAddress () {
		if ($this->city){
			return $this->city->country->name.', г. '
			.$this->city->name.', '
			.$this->address;
		}else{
			return false;
		}
	}

	public function city () {
		return $this->belongsTo('App\City');
	}

	protected $dates = ['created_at', 'updated_at', 'start', 'end'];

	public static function validator ($fields) {
		return Validator::make($fields,
			[
				'name' => 'required|max:255',
				'image' => 'required',
				'information' => 'required',
				'founder' => 'required',
				'website' => 'required',
				'start' => 'required|date_format:"d.m.Y"',
				'end' => 'required|date_format:"d.m.Y"|after:'.Carbon::parse($fields['start'])->subDay()->format('d.m.Y'),
			],[
				'name.required' => 'Введите название события.',
				'name.max' => 'Название события не должно быть длинее 255 символов.',
				'image.required' => 'Картика обязательное поле.',
				'information.required' => 'Инофрмация о событии обязательное поле.',
				'founder.required' => 'Название оргазинатора обязательное поле.',
				'website.required' => 'Сайт обязательное поле.',
				'start.required' => 'Начало события обязательное поле.',
				'start.date_format' => 'Неверный формат даты, выберите дату из календаря.',
				'end.required' => 'Конец события обязательное поле',
				'end.date_format' => 'Неверный формат даты, выберите дату из календаря.',
				'end.after' => 'Дата окончания должна быть не раньше начала.',
			]);
	}

}
