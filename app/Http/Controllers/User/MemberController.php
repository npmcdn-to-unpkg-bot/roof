<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
use Storage;

class MemberController extends Controller
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
                'name'=>'phone',
                'type'=>'text',
                'placeholder'=>'Телефон',
                'label'=>'Телефон',
                'value'=>old() ? old('phone') : $user->phone
            ],[
                'name'=>'job',
                'type'=>'text',
                'placeholder'=>'Должность',
                'label'=>'Должность',
                'value'=>old() ? old('job') : $user->job
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
        if (!auth()->user()->company)
            return redirect('user');

        $members = auth()->user()->company->new_users;
        $members = $members->merge( auth()->user()->company->users );

        $th = [
                [
                    'title'=>'',
                    'width'=>'90px',
                ],[
                    'title'=>'Имя',
                    'width'=>'auto',
                ],[
                    'title'=>'Email',
                    'width'=>'auto',
                ],[
                    'title'=>'',
                    'width'=>'50px',
                ],[
                    'title'=>'',
                    'width'=>'90px',
                ],
        ];
        $table=collect()->push($th);
        foreach ($members as $member){
            $table->push([
                [
                    'field'=>$member->image,
                    'type'=>'image',
                ],[
                    'field'=>$member->name,
                    'type'=>'text',
                ],[
                    'field'=>$member->email,
                    'type'=>'text',
                ],[
                    'html'=>$member->join_company_id ? '<a class="btn btn-sm btn-success" href="/user/company/staff/'.$member->id.'/accept" data-toggle="tooltip" data-original-title="Подтвердить"><i class="fa fa-check"></id></a>' : '',
                    'type'=>'html',
                ],[
                    'edit' => false,
                    'edit' => route('user.company.staff.edit', $member),
                    'delete' => route('user.company.staff.destroy', $member),
                    'type'=>'actions',
                ],
            ]);
        }
        return view('admin.universal.index', [
            'table' => $table,
            'items' => $members,
            'title' => 'Сотрудники компании',
            'pagination' => false,
            'message' => '<h4>Для того, чтобы добавить сотрудника в Вашу компанию, пользователь (являющийся вашим сотрудником) должен быть зарегистрирован на сайте. 
                <br> После регистрации он находит Вашу компанию в разделе "Каталог компаний" и нажимает кнопку "Я здесь работаю". 
                <br> После этого в вашем личном кабинете появится оповещение о том, что новый пользователь является вашим сотрудником и ему будут доступны все те же функции по управлению компанией, что и Вам.</h4>'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ],[
            'name.required' => 'Введите ваше имя.',
            'name.max' => 'Слишком длинное имя.',
        ]);
        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        $user = auth()->user()->company->users()->find($request->id);

        if (!$user) abort(404);

        if ($request->image&&Storage::exists('temp/'.$request->image)) 
            Storage::move('temp/'.$request->image,'images/'.$request->image);

        if ($user->image&&$user->image!==$request->image) 
            Storage::delete('images/'.$user->image);

        $user->fill($request->only('name','image','phone','job'));
        $user->save();

        return redirect()->route('user.company.staff.index');
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
            'title' => 'Редактировать пользователя',
            'action' => route('user.company.staff.store'),
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
        auth()->user()->company->new_users()->where('id',$id)->update([
            'join_company_id' => 0
        ]);
        auth()->user()->company->users()->where('id',$id)->update([
            'company_id' => 0
        ]);
        return back();
    }
    
    public function accept($id)
    {
        auth()->user()->company->new_users()->where('id',$id)->update([
            'join_company_id' => 0,
            'company_id' => auth()->user()->company->id
        ]);
        return back();
    }

}
