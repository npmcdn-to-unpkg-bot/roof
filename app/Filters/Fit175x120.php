<?php

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Fit175x120 implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(175,120);
    }
}