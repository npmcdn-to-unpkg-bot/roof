<?php

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Filter370x200 implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(370,200);
    }
}