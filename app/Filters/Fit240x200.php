<?php

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Fit240x200 implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(240,200);
    }
}