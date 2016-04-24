<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Post;
use App\Library;
use Storage;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LibraryController extends Controller
{

    protected $table = [
        [
            'field'=>'image',
            'type'=>'image',
            'width'=>'40px',
            'title'=>'Картинка'
        ],[
            'field'=>'title',
            'type'=>'text',
            'width'=>'auto',
            'title'=>'Заголовок'
        ],[
            'field'=>'id',
            'type'=>'actions',
            'width'=>'90px',
            'title'=>''
        ],
    ];

    protected function fields (Post $post) {

        return [
            [
                'name'=>'title',
                'type'=>'text',
                'placeholder'=>'Введите заголовок записи',
                'label'=>'Заголовок',
                'value'=>old() ? old('title') : $post->title
            ],[
                'name' => 'image',
                'type' => 'images',
                'label' => 'Картинка',
                'quantity' => 1,
                'values' => old() 
                    ? (array)old('image') 
                    : (array)$post->image
            ],[
                'name'=>'entry',
                'type'=>'textarea',
                'placeholder'=>'Введите краткое содержание записи',
                'label'=>'Краткое содержание',
                'value'=>old() ? old('entry') : $post->entry
            ],[
                'name'=>'content',
                'type'=>'ckeditor',
                'label'=>'Текст записи',
                'value'=>old() ? old('content') : $post->content
            ],[
                'name' => 'library',
                'type' => 'select_multiple',
                'label' => 'Разделы',
                'values' => old() ? (array)old('library') : $post->libraries->lists('id')->all(),
                'options' => Library::lists('name','id')
            ],
        ];
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::paginate(15);

        return view('admin.table', [
            'table' => $this->table,
            'items' => $posts,
            'title' => 'Записи',
            'links' => [
                'show' => 'admin.library.show',
                'edit' => 'admin.library.edit',
                'delete' => 'admin.library.destroy'
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

        $post = new Post;

        return view('admin.form',[
            'title' => 'Добавить запись',
            'action' => 'admin.library.store',
            'fields' => $this->fields($post),
            'item' => $post
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
        $validator = Post::validator($request->all());
        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        $post = Post::firstOrNew(['id' => $request->id]);

        if (Storage::exists('temp/'.$request->image)) 
            Storage::move('temp/'.$request->image,'images/'.$request->image);
        if ($post->image&&$post->image!==$request->image) 
            Storage::delete('images/'.$company->image);

        $post->fill($request->only('title','image','entry','content'));
        $post->save();
        $post->libraries()->sync($request->library);

        return redirect()->route('admin.library.index');
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

        $post = Post::find($id);

        return view('admin.form',[
            'title' => 'Редактировать новость',
            'action' => 'admin.library.store',
            'fields' => $this->fields($post),
            'item' => $post
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
        Post::find($id)->delete();
        return back();
    }
}
