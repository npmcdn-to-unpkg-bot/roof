<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Image;

use Storage;

use Validator;

use Image as ImageWorker;

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
            'file' => 'required|image',
        ],[
            'file.required' => 'Нет файла',
            'file.image' => 'Формат картинки должен быть jpeg, png, bmp, gif, или svg',
        ]);

        if ($validator->fails())
            return response()
                ->json( $validator->errors()->first(), 400);

        $file = time().'-'
            .$request->file('file')->getClientOriginalName();
        ImageWorker::make($request->file('file'))
            ->fit(600, 500, function ($constraint) { $constraint->upsize(); })
            ->save(storage_path('uploads/images/').$file);

        $image = new Image;
        $image->image = $file;
        $image->save();

        return  response()->json([ 
            'id' => $image->id,
            'name' => $image->image
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Image::find($id);
        unlink(storage_path('uploads/images/').$image->image);
        $image->delete();
        return storage_path('uploads/images/').$image->image;
    }
}
