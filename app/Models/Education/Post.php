<?php

namespace App\Models\Education;

use Validator;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

	protected $table = 'education_posts';

    public function categories () {
    	return $this->belongsToMany('App\Models\Education\Category','education_category_post','post_id','category_id');
    }

    public function tags () {
    	return $this->belongsToMany('App\Models\Tag','education_post_tag','post_id','tag_id');
    }

	protected $fillable = ['id','title','image','entry','content','meta_title','meta_description','price'];

    public static function validator ($fields) {
    	return Validator::make($fields,
		 	[
				'title' => 'required|max:255',
				'entry' => 'required|max:380',
				'price' => 'numeric'
		    ],[
				'title.required' => 'Введите заголовок записи.',
				'title.max' => 'Заголовок должен быть не больше 255 символов.',
				'entry.required' => 'Заполните краткое содержание записи.',
				'entry.max' => 'Краткое содержание должно быть не больше 380 символов.',
				'content.required' => 'Заполните текст записи.',
				'price.numeric' => 'Цена должна состоять только из цифр.'
		    ]);

    }

    public function prev(){
        $post = self::where('created_at', '<', $this->created_at)->orderBy('created_at','desc')->first();

        if (!$post)
            return false;

        return $post;
    }

    public function next(){
        $post = self::where('created_at', '>', $this->created_at)->orderBy('created_at','asc')->first();

        if (!$post)
            return false;
        
        return $post;
    }
}
