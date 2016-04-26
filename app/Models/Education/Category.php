<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'education_categories';

    public function posts () {
    	return $this->belongsToMany('App\Models\Education\Post','education_category_post','category_id','post_id');
    }
}
