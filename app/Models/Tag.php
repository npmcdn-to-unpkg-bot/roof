<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

	protected $fillable = ['name'];

	public $timestamps = false;

    public function articles(){
    	return $this->belongsToMany('App\Article','article_tag','tag_id','article_id');
    }

    public function library_posts(){
    	return $this->belongsToMany('App\Models\Library\Post','library_post_tag','tag_id','post_id');
    }

    public function education_posts(){
    	return $this->belongsToMany('App\Models\Education\Post','education_post_tag','tag_id','post_id');
    }
}
