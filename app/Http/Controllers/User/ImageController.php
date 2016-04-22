<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Storage;
use Validator;
use Image;

class ImageController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'file' => 'image',
        ],[
            'file.image' => 'Формат картинки должен быть jpeg, png, bmp, gif, или svg',
        ]);

        if ($validator->fails())
            return response()->json( $validator->errors()->first(), 400);

        $extension = $request->file('file')->getClientOriginalExtension();
        $name = $request->file('file')->getClientOriginalName();
        $name = str_slug( str_replace ( $extension, '', $name ) );
        $name = time() . '-' . $name . '.' . $extension;

        Image::make($request->file('file'))
            ->resize(1600, 1024, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            })->save(storage_path('app/temp/').$name);

        return  response()->json($name, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($name)
    {
        Storage::delete('temp/'.$name);
        return response()->json($name,200);
    }
}
