<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $dates = ['created_at', 'updated_at', 'end', 'start'];

    public static $rules = [
		'title' => 'required|min:5|max:100',
		'image' => 'required',
		'entry' => 'required|max:65535',
		'content' => 'required|max:65535',
    ];

    public static $messages = [
		'title.required' => 'Введите заголовок.',
		'title.min' => 'Заголовок должен быть не меньше 5 символов',
		'title.max' => 'Заголовок должен быть не больше 100 символов',
		'image.required' => 'Загрузите картинку.',
		'entry.required' => 'Заполните краткое содержание.',
		'entry.max' => 'Краткое содержание должно быть не больше 65535 символов.',
		'content.required' => 'Заполните текст.',
		'content.max' => 'Текст должен быть не больше 65535 символов.',
    ];

    protected $fillable = ['title','image','entry','content','meta_title','meta_description', 'end', 'start','company_id'];

    public function company () {
    	return $this->belongsTo('App\Models\Catalog\Company');
    }
}
