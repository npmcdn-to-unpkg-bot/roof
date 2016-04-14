<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public static $rules = [
		'title' => 'required|min:35|max:100',
		'entry' => 'required|min:120|max:380',
		'content' => 'required|min:500',
    ];

    public static $messages = [
		'title.required' => 'Введите заголовок статьи.',
		'title.min' => '',
		'title.max' => '',
		'entry.required' => 'Заполните краткое содержание статьи.',
		'entry.min' => 'Краткое содержание должно быть не меньше 120 символов.',
		'entry.max' => 'Краткое содержание должно быть не больше 380 символов.',
		'content.required' => 'Заполните текст статьи.',
		'content.min' => 'Текст статьи должен быть не меньше 500 символов.',
    ];

    protected $fillable = ['title','image','entry','content','market'];

}
