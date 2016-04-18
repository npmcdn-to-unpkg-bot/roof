<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Banner;
use App\Area;
use Validator;
use Image;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{

    protected $table = [
        [
            'field'=>'id',
            'type'=>'text',
            'width'=>'80px',
            'title'=>'id'
        ],[
            'field'=>'image',
            'type'=>'image',
            'width'=>'auto',
            'title'=>'Банер'
        ],[
            'field'=>'href',
            'type'=>'text',
            'width'=>'auto',
            'title'=>'Ссылка'
        ],[
            'field'=>'id',
            'type'=>'actions',
            'width'=>'90px',
            'title'=>''
        ],
    ];

    protected function fields (Banner $banner)  {
        return [
            [
                'name'=>'image',
                'type'=>'image',
                'label'=>'Банер',
                'value'=>old() ? old('image') : $banner->image
            ],[
                'name'=>'href',
                'type'=>'text',
                'label'=>'Ссылка',
                'placeholder'=>'Вставьте ссылку',
                'value'=>old() ? old('href') : $banner->href
            ],[
                'name'=>'areas',
                'type'=>'taxonomy',
                'label'=>'Область вывода',
                'values'=> old() ? old('areas') : $banner->areas->map(function ($area) {return $area->id;})->all(),
                'taxonomy'=>Area::all()
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

        return view('admin.table', [
            'table' => $this->table,
            'items' => $banners,
            'title' => 'Опросы',
            'links' => [
                'show' => 'admin.banners.show',
                'edit' => 'admin.banners.edit',
                'delete' => 'admin.banners.destroy'
            ]
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

        return view('admin.form',[
            'title' => 'Добавить банер',
            'action' => 'admin.banners.store',
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

        if ($request->hasFile('upload')) {
            $extension = $request->file('upload')->getClientOriginalExtension();
            $name = $request->file('upload')->getClientOriginalName();
            $name = str_slug( str_replace ( $extension, '', $name ) );
            $image = time() . '-' . $name . '.' . $extension;
            Image::make($request
                ->file('upload'))
                ->resize(1600, 1024, function ($constraint) { $constraint->upsize(); })
                ->save(storage_path('app/images/').$image);
            $request->merge(['image' => $image]);
        }        

        $validator = Validator::make($request->all(), Banner::$rules, Banner::$messages);

        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        
        $banner = Banner::firstOrNew(['id' => $request->id])
            ->fill($request->only('image','href'));
        $banner->save();

        Area::where([
            'banner_id' => $banner->id,
        ])->update([
            'banner_id' => '0',
        ]);

        Area::whereIn('id', $request->areas)
        ->update([
            'banner_id' => $banner->id,
        ]);

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

        return view('admin.form',[
            'title' => 'Редактировать банер',
            'action' => 'admin.banners.store',
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
