<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{

	protected $fillable = [
        'title',
        'image',
        'price',
        'specialisation',
        'name',
        'email',
        'phone',
        'framed',
        'top',
        'information',
        'user_id',
        'lat',
        'lng',
        'city_id',
        'address'
    ];

	public static $rules = [
        'title' => 'required|min:10|max:255',
        'price' => 'required',
        'image' => 'required',
        'information' => 'required|min:50',
        'specialisation' => 'required|min:3|max:35',
        'name' => 'required|max:35',
        'email' => 'max:255',
        'phone' => 'required',
    ];

    public static $messages = [
        'title.required' => 'Введите заголовк объявления.',
        'title.min' => 'Заголовок должен быть не меньше 10 символов.',
        'title.max' => 'Заголовок должен быть не больше 255 символов.',
        'price.required' => 'Введите цену.',
        'image.required' => 'Загрузите картинку.',
        'information.required' => 'Это поле обязательно для заполнения.',
        'information.min' => 'Текст должен быть не меньше 50 символов.',
        'specialisation.required' => 'Введите специализацию.',
        'specialisation.min' => 'Текст специализации должен быть не меньше 3 символов.',
        'specialisation.max' => 'Текст специализации должен быть не больше 35 символов.',
        'name.required' => 'Введите имя',
        'name.max' => 'Имя должно быть не длинее 35 символов',
        'email.email' => 'Введите корректный email.',
        'email.max' => 'Email должен быть не длинее 255 символов.',
        'phone.required' => 'Введите телефон.',
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

    public function categories () {
    	return $this->belongsToMany('App\Category');
    }

    public function user () {
    	return $this->belongsTo('App\User');
    }
}
