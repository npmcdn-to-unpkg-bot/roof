<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public static $rules = [
		'title' => 'required|min:5|max:100',
		'image' => 'required',
		'entry' => 'required|min:90|max:380',
		'content' => 'required|min:500',
    ];

    public static $messages = [
		'title.required' => 'Введите заголовок.',
		'title.min' => 'Заголовок должен быть не меньше 5 символов',
		'title.max' => 'Заголовок должен быть не больше 100 символов',
		'image.required' => 'Загрузите картинку.',
		'entry.required' => 'Заполните краткое содержание.',
		'entry.min' => 'Краткое содержание должно быть не меньше 90 символов.',
		'entry.max' => 'Краткое содержание должно быть не больше 380 символов.',
		'content.required' => 'Заполните текст.',
		'content.min' => 'Текст должен быть не меньше 300 символов.',
    ];

    protected $fillable = ['title','image','entry','content','company_id'];

    public function company () {
    	return $this->belongsTo('App\Models\Catalog\Company');
    }
}
