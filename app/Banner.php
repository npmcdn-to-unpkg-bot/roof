<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{

    public $timestamps = false;

	protected $fillable = ['id','image','href']; 	

    public static $rules = [
    	'image' => 'required',
    	'href' => 'required',
    ];

    public static $messages = [
    	'image.required' => 'Загрузите картинку.',
    	'href.required' => 'Введите ссылку.',
    ];

    public function areas () {
    	return $this->hasMany('App\Area');
    }

}