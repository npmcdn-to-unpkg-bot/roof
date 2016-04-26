<?php

namespace App\Models\Library;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'library_categories';

    public function posts () {
    	return $this->belongsToMany('App\Models\Library\Post','library_category_post','category_id','post_id');
    }
}
