<?php

namespace App\Http\Controllers\Admin\Catalog;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Catalog\Post;
use App\Models\Catalog\Company;
use Storage;

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
            ],[
                'name'=>'company_id',
                'type'=>'select',
                'settings'=>'',
                'label'=>'Комания',
                'value'=>old() 
                    ? old('company_id') 
                    : ($post->company ? $post->company->id : ''),
                'options'=>Company::lists('name','id')
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
            ]
        ];
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($company)
    {
        $posts = Company::find($company)->posts()->paginate(15);
        $company = Company::find($company);
        
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
                    'edit' => route('admin.company.{company}.blog.edit',['company'=>$company,'blog'=>$post]),
                    'delete' => route('admin.company.{company}.blog.destroy',['company'=>$company,'blog'=>$post]),
                ]
            ]);
        }

        return view('admin.catalog.index', [
            'title' => 'Блог',
            'company' => $company,
            'add' => route('admin.company.{company}.blog.create',$company),
            'table' => $table,
            'pagination' => $posts->render(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company)
    {
        $post = new Post(['company_id'=>$company]);
        $company = Company::find($company);

        return view('admin.catalog.edit',[
            'title' => 'Добавить статью',
            'action' => route('admin.company.{company}.blog.store',$company),
            'company' => $company,
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
    public function store(Request $request, $company)
    {
        $validator = Post::validator($request->all());
        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        $post = Post::firstOrNew(['id' => $request->id]);

        if (Storage::exists('temp/'.$request->image)) 
            Storage::move('temp/'.$request->image,'images/'.$request->image);
        if ($post->image&&$post->image!==$request->image) 
            Storage::delete('images/'.$company->image);

        $post->fill($request->only('title','image','entry','content','company_id','meta_title','meta_description'));
        $post->save();

        return redirect()->route('admin.company.{company}.blog.index', $company);
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
        $post = Post::find($id);
        $company = Company::find($company);

        return view('admin.universal.edit',[
            'title' => 'Редактировать новость',
            'action' => route('admin.company.{company}.blog.store',$company),
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
    public function destroy($company, $id)
    {
        Post::find($id)->delete();
        return back();
    }
}
