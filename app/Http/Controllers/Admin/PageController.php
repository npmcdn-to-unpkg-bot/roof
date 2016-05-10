<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Page;

class PageController extends Controller
{

    protected function fields (Page $page) {

        return [
            [
                'name'=>'name',
                'type'=>'text',
                'placeholder'=>'Введите заголовок страницы',
                'label'=>'Заголовок',
                'value'=>old() ? old('name') : $page->name
            ],[
                'name'=>'content',
                'type'=>'ckeditor',
                'label'=>'Текст статьи',
                'value'=>old() ? old('content') : $page->content
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

        $pages = Page::paginate(15);
        $th = [
                [
                    'title'=>'Заголовок',
                    'width'=>'auto',
                ],[
                    'title'=>'',
                    'width'=>'90px',
                ],
        ];
        $table=collect()->push($th);
        foreach ($pages as $page){
            $table->push([
                [
                    'field'=>$page->name,
                    'type'=>'text',
                ],[
                    'edit' => route('admin.pages.edit', $page),
                    'delete' => route('admin.pages.destroy', $page),
                    'type'=>'actions',
                ],
            ]);
        }

        return view('admin.universal.index', [
            'table' => $table,
            'items' => $pages,
            'title' => 'Страницы',
            'pagination' => $pages->render()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $page = new Page;

        return view('admin.universal.edit',[
            'title' => 'Добавить страницу',
            'action' => route('admin.pages.store'),
            'fields' => $this->fields($page),
            'item' => $page
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
        $validator = Page::validator($request->all());
        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        $page = Page::firstOrNew(['id' => $request->id]);
        $page->fill($request->only('name', 'content'));
        $page->save();

        return redirect()->route('admin.pages.index');
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

        $page = Page::find($id);

        return view('admin.universal.edit',[
            'title' => 'Редактировать страницу',
            'action' => route('admin.pages.store'),
            'fields' => $this->fields($page),
            'item' => $page
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
        Page::find($id)->delete();

        return back();
    }
}
