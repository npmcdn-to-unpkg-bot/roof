<?php

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Filter120x120 implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(120,120);
    }
}