<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public static $rules = [
		'title' => 'required|min:35|max:100',
		'image' => 'required',
		'entry' => 'required|min:120|max:1024',
		'content' => 'required|min:500',
    ];

    public static $messages = [
		'title.required' => 'Введите заголовок.',
		'title.min' => '',
		'title.max' => '',
		'image.required' => 'Загрузите картинку.',
		'entry.required' => 'Заполните краткое содержание.',
		'entry.min' => 'Краткое содержание должно быть не меньше 120 символов.',
		'entry.max' => 'Краткое содержание должно быть не больше 1024 символов.',
		'content.required' => 'Заполните текст.',
		'content.min' => 'Текст должен быть не меньше 300 символов.',
    ];

    protected $fillable = ['title','image','entry','content'];
}
