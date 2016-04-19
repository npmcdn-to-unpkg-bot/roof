<?php

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Filter175x200 implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(175,200);
    }
}