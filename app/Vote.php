<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = ['answer', 'poll_id', 'order'];

    public $timestamps = false;

    public function poll () {
    	return $this->belongsTo('App\Poll');
    }

    public function users () {
    	return $this->belongsToMany('App\User');
    }

    public function count () {
        return $this->users()->count();
    }

    public function progress () {
        return round($this->count()*$this->poll->count()*100);
    }

    public static $rules = [
    	'answer' => 'min:2|max:255'
    ];

    public static $messages = [
    	'answer.min' => 'Вопрос должен быть не короче 2 символов.',
    	'answer.max' => 'Вопрос должен быть не длинее 255 символов.',
    ];

}
