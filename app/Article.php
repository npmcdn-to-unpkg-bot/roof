<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Article extends Model
{

    public static function validator ($fields) {
    	return Validator::make($fields,[
				'title' => 'required|max:255',
				'entry' => 'required|min:120|max:380',
				'content' => 'required|min:500',
    		],[
				'title.required' => 'Введите заголовок статьи.',
				'title.max' => 'Заголовок должен быть не больше 255 символов.',
				'entry.required' => 'Заполните краткое содержание статьи.',
				'entry.min' => 'Краткое содержание должно быть не меньше 120 символов.',
				'entry.max' => 'Краткое содержание должно быть не больше 380 символов.',
				'content.required' => 'Заполните текст статьи.',
				'content.min' => 'Текст статьи должен быть не меньше 500 символов.',
    		]);
    }

    protected $fillable = ['title','image','entry','content','meta_title','meta_description','author_id'];

    public function prev(){
        $article = self::where('created_at', '<', $this->created_at)->orderBy('created_at','desc')->first();

        if (!$article)
            return false;

        return $article;
    }

    public function next(){
    	$article = self::where('created_at', '>', $this->created_at)->orderBy('created_at','asc')->first();

        if (!$article)
            return false;
        
        return $article;
    }

    public function author() {
        return $this->belongsTo('App\Models\Author');
    }

    public function tags () {
    	return $this->belongsToMany('App\Models\Tag','article_tag','article_id','tag_id');
    }

}
