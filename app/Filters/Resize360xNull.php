<?php

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Resize360xNull implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->resize(360,null,function ($constraint) {
		    $constraint->aspectRatio();
		    $constraint->upsize();
		});
    }
}