<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Comment extends Model
{
    public function commentable() {
    	return $this->morphTo();
    }

    protected $fillable = ['text','rating'];

    public function comments() {
    	return $this->morphMany('App\Models\Comment','commentable');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function printRating(){
    	$pattern = [
    		1 => '<span style="color: red">1 балл</span>',
    		2 => '<span style="color: red">2 балла</span>',
    		3 => '<span style="color: red">3 балла</span>',
    		4 => '<span style="color: orange">4 балла</span>',
    		5 => '<span style="color: orange">5 баллов</span>',
    		6 => '<span style="color: orange">6 баллов</span>',
    		7 => '<span style="color: #7dc691">7 баллов</span>',
    		8 => '<span style="color: #7dc691">8 баллов</span>',
    		9 => '<span style="color: #7dc691">9 баллов</span>',
    		10 => '<span style="color: #7dc691">10 балло</span>в'
    	];
    	return $pattern[$this->rating];
    }

    public static function validator ($fields) {
    	return Validator::make($fields,[
    			'text' => 'required',
    			'rating' => 'required|not_in:0',
    			'company_id' => 'required'
    		],[
    			'text.required' => 'Введите текст отзыва',
    			'rating.required' => 'Поставьте оценку',
    			'rating.not_in' => 'Поставьте оценку',
    			'company_id.required' => ''
    		]);
    }
}
