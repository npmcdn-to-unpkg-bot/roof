<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Option;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fields = [
            [
                'name' => 'email_1',
                'type' => 'text',
                'label' => 'Email',
                'placeholder' => '',
                'value' => old() ? old('email_1') : Option::firstOrNew(['name'=>'email_1'])->value
            ],[
                'name' => 'email_2',
                'type' => 'text',
                'label' => 'Email',
                'placeholder' => '',
                'value' => old() ? old('email_2') : Option::firstOrNew(['name'=>'email_2'])->value
            ],[
                'name' => 'phone',
                'type' => 'text',
                'label' => 'Телефон',
                'placeholder' => '',
                'value' => old() ? old('phone') : Option::firstOrNew(['name'=>'phone'])->value
            ],[
                'name' => 'address',
                'type' => 'text',
                'label' => 'Адрес',
                'placeholder' => '',
                'value' => old() ? old('address') : Option::firstOrNew(['name'=>'address'])->value
            ],[
                'name' => 'map',
                'type' => 'textarea',
                'label' => 'Карта',
                'placeholder' => '',
                'value' => old() ? old('map') : Option::firstOrNew(['name'=>'map'])->value
            ],[
                'name' => 'facebook',
                'type' => 'text',
                'label' => 'Facebook',
                'placeholder' => 'http://facebook.com/',
                'value' => old() ? old('facebook') : Option::firstOrNew(['name'=>'facebook'])->value
            ],[
                'name' => 'youtube',
                'type' => 'text',
                'label' => 'YouTube',
                'placeholder' => 'http://youtube.com/',
                'value' => old() ? old('youtube') : Option::firstOrNew(['name'=>'youtube'])->value
            ],[
                'name' => 'instagram',
                'type' => 'text',
                'label' => 'Instagram',
                'placeholder' => 'http://instagram.com/',
                'value' => old() ? old('instagram') : Option::firstOrNew(['name'=>'instagram'])->value
            ],[
                'name' => 'linkedin',
                'type' => 'text',
                'label' => 'LinkedIn',
                'placeholder' => 'http://linkedin.com/',
                'value' => old() ? old('linkedin') : Option::firstOrNew(['name'=>'linkedin'])->value
            ],
        ];

        return view('admin.universal.edit',[
            'title' => 'Настройки данных',
            'action' => route('admin.options.store'),
            'fields' => $fields
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Option::firstOrCreate(['name'=>'email_1'])->update(['value'=>$request->email_1]);
        Option::firstOrCreate(['name'=>'email_2'])->update(['value'=>$request->email_2]);
        Option::firstOrCreate(['name'=>'phone'])->update(['value'=>$request->phone]);
        Option::firstOrCreate(['name'=>'address'])->update(['value'=>$request->address]);
        Option::firstOrCreate(['name'=>'map'])->update(['value'=>$request->map]);

        Option::firstOrCreate(['name'=>'facebook'])->update(['value'=>$request->facebook]);
        Option::firstOrCreate(['name'=>'youtube'])->update(['value'=>$request->youtube]);
        Option::firstOrCreate(['name'=>'instagram'])->update(['value'=>$request->instagram]);
        Option::firstOrCreate(['name'=>'linkedin'])->update(['value'=>$request->linkedin]);
        return back();
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
        //
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
        //
    }
}
