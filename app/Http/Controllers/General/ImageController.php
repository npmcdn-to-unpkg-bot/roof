<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use Image;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{

	protected function paths () {
		return [ 
			storage_path('app/images'),
			storage_path('app/temp')
		];
	}

	protected $lifetime = 12000;

	protected function getImagePath($filename) {

        foreach ($this->paths() as $path) {
            // don't allow '..' in filenames
            $image_path = $path.'/'.str_replace('..', '', $filename);
            if (file_exists($image_path) && is_file($image_path)) {
                // file found
                return $image_path;
            }
        }

        // file not found
        abort(404);
	}

    public function fit ($width, $height, $name) {

    	$path = $this->getImagePath($name);

		$source = Image::cache( function($image) use ($width,$height,$path) {

    		$image->make($path);
	    	$image->fit($width,$height, function($constraint) {
		   			$constraint->upsize();
		   		});

		}, $this->lifetime);

		$image = Image::make($source);

    	return $image->response();
    }

    public function resize ($width, $height, $name) {

    	$path = $this->getImagePath($name);
		$source = Image::cache( function($image) use ($width,$height,$path) {

	        $image->make($path);
	        $image->resize($width,$height,function ($constraint) {
			    $constraint->aspectRatio();
			    $constraint->upsize();
			});
			$image->resizeCanvas($width, $height, 'center', false, 'rgba(255,255,255,0)');
		}, $this->lifetime);

		$image = Image::make($source);
		
    	return $image->response();
    }


    public function width ($width, $name) {

    	$path = $this->getImagePath($name);

		$source = Image::cache( function($image) use ($width,$path) {

			$image->make($path);
	        $image->resize($width,null,function ($constraint) {
			    $constraint->aspectRatio();
			    $constraint->upsize();
			});

		}, $this->lifetime);

		$image = Image::make($source);
		
    	return $image->response();
    }

    public function height ($height, $name) {

    	$path = $this->getImagePath($name);

		$source = Image::cache( function($image) use ($height,$path) {

			$image->make($path);
	        $image->resize(null,$height,function ($constraint) {
			    $constraint->aspectRatio();
			    $constraint->upsize();
			});

		}, $this->lifetime);

		$image = Image::make($source);
		
    	return $image->response();
    }

    public function full ($name) {

    	$path = $this->getImagePath($name);

		$image = Image::make($path);
		
    	return $image->response();
    }

}
