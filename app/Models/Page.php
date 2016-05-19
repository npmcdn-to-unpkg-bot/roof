<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Page extends Model
{
    public static function validator ($fields) {
    	return Validator::make($fields,[
				'name' => 'required|max:255',
				'content' => 'required|max:65536',
    		],[
				'name.required' => 'Введите заголовок статьи.',
				'name.max' => 'Заголовок должен быть не больше 255 символов.',
				'content.required' => 'Заполните текст статьи.',
				'content.max' => 'Текст статьи должен быть не больше 65536 символов.',
    		]);
    }

    protected $fillable = ['name','content','slug'];
}
