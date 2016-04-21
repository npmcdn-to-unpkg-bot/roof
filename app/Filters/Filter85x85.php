<?php

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Filter85x85 implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->resize(85,85,function ($constraint) {
		    $constraint->aspectRatio();
		    $constraint->upsize();
		})->resizeCanvas(85, 85, 'center', false, 'ffffff');
    }
}