<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Storage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{

    protected function fields (User $user) {

        return [
            [
                'name'=>'name',
                'type'=>'text',
                'placeholder'=>'Фамилия Имя Очетсва',
                'label'=>'ФИО',
                'value'=>old() ? old('name') : $user->name
            ],[
                'name' => 'image',
                'type' => 'images',
                'label' => 'Аватарка',
                'quantity' => 1,
                'values' => old() 
                    ? (array)old('image') 
                    : (array)$user->image
            ],[
                'name'=>'email',
                'type'=>'text',
                'placeholder'=>'Email',
                'label'=>'email',
                'value'=>old() ? old('email') : $user->email
            ],[
                'name'=>'phone',
                'type'=>'text',
                'placeholder'=>'Телефон',
                'label'=>'Телефон',
                'value'=>old() ? old('phone') : $user->phone
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

        $users = User::paginate(15);
        $th = [
                [
                    'title'=>'Картинка',
                    'width'=>'40px',
                ],[
                    'title'=>'Имя',
                    'width'=>'auto',
                ],[
                    'title'=>'email',
                    'width'=>'auto',
                ],[
                    'title'=>'Телефон',
                    'width'=>'auto',
                ],[
                    'title'=>'',
                    'width'=>'90px',
                ],
        ];
        $table=collect()->push($th);
        foreach ($users as $user){
            $table->push([
                [
                    'field'=>$user->image,
                    'type'=>'image',
                ],[
                    'field'=>$user->name,
                    'type'=>'text',
                ],[
                    'field'=>$user->email,
                    'type'=>'text',
                ],[
                    'field'=>$user->phone,
                    'type'=>'text',
                ],[
                    'edit' => route('admin.users.edit', $user),
                    'delete' => route('admin.users.destroy', $user),
                    'type'=>'actions',
                ],
            ]);
        }

        return view('admin.universal.index', [
            'table' => $table,
            'items' => $users,
            'title' => 'Новости',
            'pagination' => $users->render()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user = new User;

        return view('admin.universal.edit',[
            'title' => 'Добавить новость',
            'action' => route('admin.users.store'),
            'fields' => $this->fields($user),
            'item' => $user
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
        $validator = User::validator($request->all());
        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        $user = User::firstOrNew(['id' => $request->id]);

        if ($request->image&&Storage::exists('temp/'.$request->image)) 
            Storage::move('temp/'.$request->image,'images/'.$request->image);

        if ($user->image&&$user->image!==$request->image) 
            Storage::delete('images/'.$user->image);

        $user->fill($request->only('title','image','entry','content'));
        $user->save();

        return redirect()->route('admin.users.index');
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

        $user = User::find($id);

        return view('admin.universal.edit',[
            'title' => 'Редактировать новость',
            'action' => route('admin.users.store'),
            'fields' => $this->fields($user),
            'item' => $user
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
        User::find($id)->delete();

        return back();
    }
}
