<?php

namespace App\Http\Controllers\Admin\Catalog;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Catalog\Specialisation;

class SpecialisationController extends Controller
{

    protected function fields ($taxonomy) {

        $values = [];
        if ( old() ) {
            foreach ( array_filter(old('taxonomy')) as $key => $term )
                $values[] = ['id'=>old('taxonomy_id')[$key],'value'=>$term];
        } else {
            foreach ($taxonomy as $term)
                $values[] = ['id'=> $term->id,'value'=>$term->name];
        }
        $values[]=['id'=>'','value'=>''];

        return [
            [
                'name'=>'taxonomy',
                'type'=>'text_multi',
                'label'=>'Категории',
                'placeholder'=>'Название категории',
                'values'=> $values
            ],
        ];
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $taxonomy = Specialisation::orderBy('order','asc')->get();

        return view('admin.universal.edit',[
            'title' => 'Редактировать специализаций',
            'action' => '',
            'fields' => $this->fields($taxonomy),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company)
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
    	Specialisation::whereNotIn('id',$request->taxonomy_id)->delete();
    	$order = 1;
        foreach (array_filter($request->taxonomy) as $key => $name) {
            $term = Specialisation::firstOrNew(['id'=>$request->taxonomy_id[$key]]);
            $term->name = $name;
            $term->order = $order;
            $term->save();
            $order++;
        }

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
    public function edit($company, $id)
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
