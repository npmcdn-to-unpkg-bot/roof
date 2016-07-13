<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Comment extends Model
{
    public function commentable() {
    	return $this->morphTo();
    }

    protected $fillable = ['text','rating','rating_service','rating_prof','rating_quality','rating_resp'];

    public function comments() {
    	return $this->morphMany('App\Models\Comment','commentable');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function printRating(){
        $color = '#7dc691';
        if ($this->rating < 6)
            $color = 'orange';
        if ($this->rating < 3)
            $color = 'red';
        return '<span style="color: '.$color.'">'.$this->rating.'</span>';
    }

    public static function validator ($fields) {
    	return Validator::make($fields,[
    			'text' => 'required',
                'rating_service' => 'required|not_in:0',
                'rating_prof' => 'required|not_in:0',
                'rating_quality' => 'required|not_in:0',
                'rating_resp' => 'required|not_in:0',
    			'company_id' => 'required'
    		],[
    			'text.required' => 'Введите текст отзыва',
                'rating_service.required' => 'Поставьте оценку',
                'rating_prof.required' => 'Поставьте оценку',
                'rating_quality.required' => 'Поставьте оценку',
                'rating_resp.required' => 'Поставьте оценку',
                'rating_service.not_in' => 'Поставьте оценку',
                'rating_prof.not_in' => 'Поставьте оценку',
                'rating_quality.not_in' => 'Поставьте оценку',
                'rating_resp.not_in' => 'Поставьте оценку',
    			'company_id.required' => ''
    		]);
    }
}
