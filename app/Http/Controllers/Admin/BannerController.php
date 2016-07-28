<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Banner;
use App\Area;
use Validator;
use Storage;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{

    protected function fields (Banner $banner)  {
        if (!$banner->target) $banner->target = '_blank';
        return [
            [
                'name' => 'image',
                'type' => 'images',
                'label' => 'Картинка',
                'quantity' => 1,
                'values' => old() 
                    ? (array)old('image') 
                    : (array)$banner->image
            ],[
                'name'=>'href',
                'type'=>'text',
                'label'=>'Ссылка',
                'placeholder'=>'Вставьте ссылку',
                'value'=>old() ? old('href') : $banner->href
            ],[
                'name'=>'areas',
                'type'=>'select_multiple',
                'label'=>'Область вывода',
                'values'=> old() 
                    ? (array)old('areas')
                    : $banner->areas->lists('id')->all(),
                'options'=>Area::lists('name','id')
            ],[
                'name'=>'target',
                'type'=>'radio',
                'label'=>'Открыть в новой вкладке',
                'value' => old() ? old('target') : $banner->target,
                'options'=>[
                    '_blank' => 'Да',
                    '_self' => 'Нет',
                ],
            ]
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::paginate(15);
        $th = [
                [
                    'title'=>'id',
                    'width'=>'80px',
                ],[
                    'title'=>'Баннер',
                    'width'=>'auto',
                ],[
                    'title'=>'Ссылка',
                    'width'=>'auto',
                ],[
                    'title'=>'',
                    'width'=>'90px',
                ],
        ];
        $table=collect()->push($th);
        foreach ($banners as $banner){
            $table->push([
                [
                    'field'=>$banner->id,
                    'type'=>'text',
                ],[
                    'field'=>$banner->image,
                    'type'=>'image',
                ],[
                    'field'=>$banner->href,
                    'type'=>'text',
                ],[
                    'edit' => route('admin.banners.edit', $banner),
                    'delete' => route('admin.banners.destroy', $banner),
                    'type'=>'actions',
                ],
            ]);
        }
        return view('admin.universal.index', [
            'table' => $table,
            'items' => $banners,
            'title' => 'Баннеры',
            'pagination' => $banners->render()
        ]);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $banner = new Banner;

        return view('admin.universal.edit',[
            'title' => 'Добавить баннер',
            'action' => route('admin.banners.store'),
            'fields' => $this->fields($banner),
            'item' => $banner
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), Banner::$rules, Banner::$messages);
        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        
        $banner = Banner::firstOrNew(['id' => $request->id]);

        if (Storage::exists('temp/'.$request->image)&&!Storage::exists('images/'.$request->image)) 
            Storage::move('temp/'.$request->image,'images/'.$request->image);
        if ($banner->image&&$banner->image!==$request->image) 
            Storage::delete('images/'.$banner->image);

        $banner->target = $request->target;

        $banner
            ->fill($request->only('image','href'))
            ->save();

        Area::where(['banner_id' => $banner->id])
            ->update(['banner_id' => '0']);

        Area::whereIn('id', $request->areas)
            ->update(['banner_id' => $banner->id]);

        return redirect()->route('admin.banners.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $banner = Banner::find($id);

        return view('admin.universal.edit',[
            'title' => 'Редактировать баннер',
            'action' => route('admin.banners.store'),
            'fields' => $this->fields($banner),
            'item' => $banner
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Banner::find($id)->delete();

        return back();
    }
}
