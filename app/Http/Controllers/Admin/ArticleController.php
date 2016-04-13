<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Validator;
use Image;
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

    protected $fields = [
        [
            'name'=>'title',
            'type'=>'text',
            'placeholder'=>'Введите заголовок статьи',
            'label'=>'Заголовок'
        ],[
            'name'=>'image',
            'type'=>'image',
            'label'=>'Картинка'
        ],[
            'name'=>'entry',
            'type'=>'textarea',
            'placeholder'=>'Введите краткое содержание статьи',
            'label'=>'Краткое содержание'
        ],[
            'name'=>'content',
            'type'=>'ckeditor',
            'label'=>'Текст статьи'
        ],[
            'name'=>'market',
            'type'=>'checkbox',
            'label'=>'Поместить новость в разделе "НОВОСТИ РЫНКА"'
        ],
    ];
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

        return view('admin.form',[
            'title' => 'Добавить новость',
            'action' => 'admin.news.store',
            'fields' => $this->fields,
            'item' => new Article
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
            $image = time().'-'
                .$request->file('upload')->getClientOriginalName();
            Image::make($request
                ->file('upload'))
                ->fit(1600, 1024, function ($constraint) { $constraint->upsize(); })
                ->save(storage_path('app/images/').$image);
            $request->merge(['image' => $image]);
        }

        $validator = Validator::make($request->all(), Article::$rules, Article::$messages);

        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        Article::firstOrNew(['id' => $request->id])
            ->fill($request->only('title','image','entry','content','market'))
            ->save();

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
        return view('admin.form',[
            'title' => 'Редактировать новость',
            'action' => 'admin.news.store',
            'fields' => $this->fields,
            'item' => Article::find($id)
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
