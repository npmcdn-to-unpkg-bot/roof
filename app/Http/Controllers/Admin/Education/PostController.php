<?php

namespace App\Http\Controllers\Admin\Education;

use Illuminate\Http\Request;
use App\Models\Education\Post;
use App\Models\Education\Category;
use Storage;
use App\Models\Tag;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostController extends Controller
{

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
                'name' => 'categories',
                'type' => 'select_multiple',
                'label' => 'Разделы',
                'values' => old() ? (array)old('categories') : $post->categories->lists('id')->all(),
                'options' => Category::lists('name','id')
            ],[
                'name'=>'meta_title',
                'type'=>'text',
                'label'=>'Введите meta title',
                'placeholder'=>'',
                'value'=>old() ? old('meta_title') : $post->meta_title
            ],[
                'name'=>'meta_description',
                'type'=>'textarea',
                'label'=>'Введите meta description',
                'placeholder'=>'',
                'value'=>old() ? old('meta_description') : $post->meta_description
            ],[
                'name'=>'tags',
                'type' => 'select_multiple',
                'label'=>'Теги',
                'settings' => 'tags: true,',
                'values'=>old() ? (array)old('tags') : $post->tags->lists('name')->all(),
                'options'=> Tag::lists('name', 'name')
            ],[
                'name'=>'price',
                'type'=>'text',
                'placeholder'=>'Цена (грн)',
                'label'=>'Цена (грн)',
                'value'=>old() ? old('price') : $post->price
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

        $posts = Post::orderBy('created_at','DESC')->paginate(15);
        $th = [
                [
                    'title'=>'Картинка',
                    'width'=>'40px',
                ],[
                    'title'=>'Заголовок',
                    'width'=>'auto',
                ],[
                    'title'=>'',
                    'width'=>'90px',
                ],
        ];
        $table=collect()->push($th);
        foreach ($posts as $post){
            $table->push([
                [
                    'field'=>$post->image,
                    'type'=>'image',
                ],[
                    'field'=>$post->title,
                    'type'=>'text',
                ],[
                    'edit' => route('admin.education.edit', $post),
                    'delete' => route('admin.education.destroy', $post),
                    'type'=>'actions',
                ],
            ]);
        }
        return view('admin.universal.index', [
            'table' => $table,
            'items' => $posts,
            'title' => 'Записи в обучении',
            'pagination' => $posts->render()
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

        return view('admin.universal.edit',[
            'title' => 'Добавить запись',
            'action' => route('admin.education.store'),
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
            Storage::delete('images/'.$post->image);

        $post->fill($request->only('title','image','entry','content','meta_title','meta_description','price'));
        $post->save();
        $post->categories()->sync((array)$request->categories);

        $tags = collect();
        foreach((array)$request->tags as $name) {
            $tag = Tag::firstOrCreate(['name'=>$name]);
            $tags->push($tag);
        }

        $post->tags()->sync($tags->lists('id')->all());

        return redirect()->route('admin.education.index');
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

        return view('admin.universal.edit',[
            'title' => 'Редактировать новость',
            'action' => route('admin.education.store'),
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
