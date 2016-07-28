<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Storage;
use App\Models\Catalog\Company;
use App\Article;
use App\Models\Tag;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Author;

class ArticleController extends Controller
{

    protected function fields (Article $article) {

        return [
            [
                'name'=>'title',
                'type'=>'text',
                'placeholder'=>'Введите заголовок статьи',
                'label'=>'Заголовок',
                'value'=>old() ? old('title') : $article->title
            ],[
                'name' => 'image',
                'type' => 'images',
                'label' => 'Картинка',
                'quantity' => 1,
                'values' => old() 
                    ? (array)old('image') 
                    : (array)$article->image
            ],[
                'name'=>'entry',
                'type'=>'textarea',
                'placeholder'=>'Введите краткое содержание статьи',
                'label'=>'Краткое содержание',
                'value'=>old() ? old('entry') : $article->entry
            ],[
                'name'=>'content',
                'type'=>'ckeditor',
                'label'=>'Текст статьи',
                'value'=>old() ? old('content') : $article->content
            ],[
                'name'=>'meta_title',
                'type'=>'text',
                'label'=>'Введите meta title',
                'placeholder'=>'',
                'value'=>old() ? old('meta_title') : $article->meta_title
            ],[
                'name'=>'meta_description',
                'type'=>'textarea',
                'label'=>'Введите meta description',
                'placeholder'=>'',
                'value'=>old() ? old('meta_description') : $article->meta_description
            ],[
                'name'=>'tags',
                'type' => 'select_multiple',
                'label'=>'Теги',
                'settings' => 'tags: true,',
                'values'=>old() ? (array)old('tags') : $article->tags->lists('name','name')->all(),
                'options'=> Tag::lists('name','name')
            ],[
                'name'=>'author_id',
                'type'=>'select',
                'settings'=>'',
                'label'=>'Автор',
                'value'=>old() 
                    ? old('author_id') 
                    : ($article->author ? $article->author->id : ''),
                'options'=>Author::lists('name','id')
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

        $articles = Article::paginate(15);
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
        foreach ($articles as $article){
            $table->push([
                [
                    'field'=>$article->image,
                    'type'=>'image',
                ],[
                    'field'=>$article->title,
                    'type'=>'text',
                ],[
                    'edit' => route('admin.news.edit', $article),
                    'delete' => route('admin.news.destroy', $article),
                    'type'=>'actions',
                ],
            ]);
        }

        return view('admin.universal.index', [
            'table' => $table,
            'items' => $articles,
            'title' => 'Новости',
            'pagination' => $articles->render()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $article = new Article;

        return view('admin.universal.edit',[
            'title' => 'Добавить новость',
            'action' => route('admin.news.store'),
            'fields' => $this->fields($article),
            'item' => $article
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
        $validator = Article::validator($request->all());
        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        $article = Article::firstOrNew(['id' => $request->id]);

        if ($request->image&&Storage::exists('temp/'.$request->image)&&!&&Storage::exists('images/'.$request->image)) 
            Storage::move('temp/'.$request->image,'images/'.$request->image);

        if ($article->image&&$article->image!==$request->image) 
            Storage::delete('images/'.$article->image);

        $article->fill($request->only('title','image','entry','content','meta_title','meta_description','author_id'));
        $article->save();

        $tags = collect();
        foreach((array)$request->tags as $name) {
            $tag = Tag::firstOrCreate(['name'=>$name]);
            $tags->push($tag);
        }

        $article->tags()->sync($tags->lists('id')->all());

        return redirect()->route('admin.news.index');
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

        $article = Article::find($id);

        return view('admin.universal.edit',[
            'title' => 'Редактировать новость',
            'action' => route('admin.news.store'),
            'fields' => $this->fields($article),
            'item' => $article
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
        Article::find($id)->delete();

        return back();
    }
}
