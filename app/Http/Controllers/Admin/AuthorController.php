<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Author;
use Storage;

class AuthorController extends Controller
{

    protected function fields (Author $author) {

        return [
            [
                'name'=>'name',
                'type'=>'text',
                'placeholder'=>'Имя',
                'label'=>'Имя',
                'value'=>old() ? old('name') : $author->name
            ],[
                'name' => 'image',
                'type' => 'images',
                'label' => 'Фото',
                'quantity' => 1,
                'values' => old() 
                    ? (array)old('image') 
                    : (array)$author->image
            ],[
                'name'=>'description',
                'type'=>'textarea',
                'placeholder'=>'Описание',
                'label'=>'Описание',
                'value'=>old() ? old('description') : $author->description
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
        $authors = Author::paginate(15);
        $th = [
                [
                    'title'=>'Картинка',
                    'width'=>'40px',
                ],[
                    'title'=>'Имя',
                    'width'=>'auto',
                ],[
                    'title'=>'',
                    'width'=>'90px',
                ],
        ];
        $table=collect()->push($th);
        foreach ($authors as $author){
            $table->push([
                [
                    'field'=>$author->image,
                    'type'=>'image',
                ],[
                    'field'=>$author->name,
                    'type'=>'text',
                ],[
                    'edit' => route('admin.news.authors.edit', $author),
                    'delete' => route('admin.news.authors.destroy', $author),
                    'type'=>'actions',
                ],
            ]);
        }

        return view('admin.universal.index', [
            'table' => $table,
            'items' => $authors,
            'title' => 'Авторы',
            'add' => route('admin.news.authors.create'),
            'pagination' => $authors->render()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $author = new Author;

        return view('admin.universal.edit',[
            'title' => 'Добавить автора',
            'action' => route('admin.news.authors.store'),
            'fields' => $this->fields($author),
            'item' => $author
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
        $validator = Author::validator($request->all());
        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        $author = Author::firstOrNew(['id' => $request->id]);

        if (Storage::exists('temp/'.$request->image)&&!&&Storage::exists('images/'.$request->image)) 
            Storage::move('temp/'.$request->image,'images/'.$request->image);

        if ($author->image&&$author->image!==$request->image) 
            Storage::delete('images/'.$author->image);

        $author->fill($request->only('name','image','description'));
        $author->save();

        return redirect()->route('admin.news.authors.index');
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
        $author = Author::find($id);

        return view('admin.universal.edit',[
            'title' => 'Редактировать данные автора',
            'action' => route('admin.news.authors.store'),
            'fields' => $this->fields($author),
            'item' => $author
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
        Author::find($id)->delete();

        return back();
    }
}
