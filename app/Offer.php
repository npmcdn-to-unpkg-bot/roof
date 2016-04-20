<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{

	protected $fillable = ['title','image','price','specialisation','name','email','phone','framed'];

	public static $rules = [
        'title' => 'required|min:10|max:55',
        'price' => 'required',
        'image' => 'required',
        'information' => 'max:1024',
        'specialisation' => 'required|min:3|max:35',
        'name' => 'max:35',
        'email' => 'email|max:255',
        'phone' => 'numeric',
    ];

    public static $messages = [
        'title.required' => 'Введите заголовк объявления.',
        'title.min' => 'Заголовок должен быть не меньше 10 символов.',
        'title.max' => 'Заголовок должен быть не больше 55 символов.',
        'price.required' => 'Введите цену.',
        'image.required' => 'Загрузите картинку.',
        'information.max' => 'Текст должен быть не больше 1024 символов.',
        'specialisation.required' => 'Введите специализацию.',
        'specialisation.min' => 'Текст специализации должен быть не меньше 3 символов.',
        'specialisation.max' => 'Текст специализации должен быть не больше 35 символов.',
        'name.max' => 'Имя должно быть не длинее 35 символов',
        'email.email' => 'Введите корректный email.',
        'email.max' => 'Email должен быть не длинее 255 символов.',
        'phone.numeric' => 'Телефон должен состоять из цифр.',
    ];

    public function deskcategories () {
    	return $this->belongsToMany('App\DeskCategory');
    }

    public function user () {
    	return $this->belongsTo('App\User');
    }
}
