<?php

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Filter765x400 implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(765,400, function ($constraint) {
        	$constraint->upsize();
        });
    }
}