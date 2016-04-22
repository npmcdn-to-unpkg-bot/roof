<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Validator;
use Storage;
use App\Company;
use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
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
                'name'=>'market',
                'type'=>'checkbox',
                'label'=>'Поместить новость в разделе "НОВОСТИ РЫНКА"',
                'value'=>old() ? old('market') : $article->market
            ],[
                'name'=>'company_id',
                'type'=>'select',
                'settings'=>'',
                'label'=>'Комания',
                'value'=>old() 
                    ? old('company_id') 
                    : ($article->company ? $article->company->id : ''),
                'options'=>Company::lists('name','id')
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

        return view('admin.table', [
            'table' => $this->table,
            'items' => $articles,
            'title' => 'Новости',
            'links' => [
                'show' => 'admin.news.show',
                'edit' => 'admin.news.edit',
                'delete' => 'admin.news.destroy'
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

        $article = new Article;

        return view('admin.form',[
            'title' => 'Добавить новость',
            'action' => 'admin.news.store',
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
        $validator = Validator::make($request->all(), Article::$rules, Article::$messages);
        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        $article = Article::firstOrNew(['id' => $request->id]);

        if (Storage::exists('temp/'.$request->image)) 
            Storage::move('temp/'.$request->image,'images/'.$request->image);
        if ($article->image&&$article->image!==$request->image) 
            Storage::delete('images/'.$company->image);

        $article->fill($request->only('title','image','entry','content','market','company_id'));
        $article->save();

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

        return view('admin.form',[
            'title' => 'Редактировать новость',
            'action' => 'admin.news.store',
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
