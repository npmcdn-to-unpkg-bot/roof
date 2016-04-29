<?php

namespace App\Http\Controllers\ThePublic;

use Illuminate\Http\Request;
use Image;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{

	protected $paths = [ 'app/images/', 'app/temp/'	];

	protected $lifetime = 12000;

	protected function getImagePath($filename) {
        foreach ($this->paths as $path) {
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

    	$path = $this->getPath($name);

		$source = Image::cache( function($image) use ($width,$height,$path) {

    		$image->make($path)
	    		->fit($width,$height, function($constraint) {
		   			$constraint->upsize();
		   		});

		}, $this->lifetime);

		$image = Image::make($source);
    	return $image->response();
    }
}
