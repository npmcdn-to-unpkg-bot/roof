<?php

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Filter85x85 implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(85,85);
    }
}