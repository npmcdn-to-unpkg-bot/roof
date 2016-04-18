<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable = ['question'];

    public function votes () {
    	return $this->hasMany('App\Vote')->orderBy('order');
    }

    public function count () {
        return $this->votes->sum(function ($vote) {
            return $vote->count();
        });
    }

    public static $rules = [
    	'question' => 'required|min:50|max:255'
    ];

    public static $messages = [
    	'question.required' => 'Введите вопрос.',
    	'question.min' => 'Вопрос должен быть не короче 50 символов.',
    	'question.max' => 'Вопрос должен быть не длинее 255 символов.',
    ];
}
