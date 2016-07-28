<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Validator;
use Storage;
use Auth;
use App\Models\Catalog\Company;
use App\Models\Catalog\Post;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostController extends Controller
{

    protected function fields (Post $post) {

        return [
            [
                'name'=>'title',
                'type'=>'text',
                'placeholder'=>'Введите заголовок статьи',
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
                'placeholder'=>'Введите краткое содержание статьи',
                'label'=>'Краткое содержание',
                'value'=>old() ? old('entry') : $post->entry
            ],[
                'name'=>'content',
                'type'=>'ckeditor',
                'label'=>'Текст статьи',
                'value'=>old() ? old('content') : $post->content
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

        $posts = Auth::user()->company->posts()->paginate(15);

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
            ]
        ];
        $table = collect()->push($th);
        foreach ($posts as $post) {
            $table->push([
                [
                    'type'=>'image',
                    'field'=>$post->image,
                ],[
                    'type'=>'text',
                    'field'=>$post->title,
                ],[
                    'type'=>'actions',
                    'edit' => route('user.company.blog.edit',$post),
                    'delete' => route('user.company.blog.destroy',$post),
                ]
            ]);
        }

        return view('admin.universal.index', [
            'title' => 'Блог',
            'table' => $table,
            'pagination' => $posts->render(),
            'add' => route('user.company.blog.create')
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
            'title' => 'Добавить новость',
            'action' => route('user.company.blog.store'),
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

        $post = Auth::user()
            ->company
            ->posts()
            ->firstOrNew(['id' => $request->id]);

        if (Storage::exists('temp/'.$request->image)&&!&&Storage::exists('images/'.$request->image)) 
            Storage::move('temp/'.$request->image,'images/'.$request->image);

        if ($post->image&&$post->image!==$request->image) 
            Storage::delete('images/'.$post->image);

        $post
            ->fill($request->only('title','image','entry','content'))
            ->save();

        return redirect()->route('user.company.blog.index');
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

        $post = Auth::user()->company->posts()->where('id', $id)->first();
        if (!$post) return redirect()->route('user.company.blog.create');

        return view('admin.universal.edit',[
            'title' => 'Редактировать новость',
            'action' => route('user.company.blog.store'),
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
        Auth::user()->company->posts()->where('id', $id)->delete();
        return back();
    }
}
