<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Image;
use Illuminate\Support\Str;
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

        $extension = $request->file('file')->getClientOriginalExtension();
        $name = $request->file('file')->getClientOriginalName();
        $name = Str::slug( str_replace ( $extension, '', $name ) );
        $name = time() . '-' . $name . '.' . $extension;

        ImageWorker::make($request->file('file'))
            ->resize(1600, 1024, function ($constraint) { $constraint->upsize(); })
            ->save(storage_path('app/temp/').$name);

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
