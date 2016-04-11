<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Job;
use App\Http\Requests;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $jobs = Auth::user()->company->jobs;

        return view('user.job.index', [
            'jobs' => $jobs
        ]);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.job.form', [
            'title' => 'Создать вакансию',
            'job' => new Job
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
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3|max:33',
            'pay' => 'required|min:3|max:33',
            'information' => 'required|max:1024',
            'requirements' => 'max:1024',
            'duties' => 'max:1024',
            'conditions' => 'max:1024',
            'phone' => 'numeric',
            'email' => 'email',
        ],[
            'name.required' => 'Введите название вакансии',
            'name.min' => 'Название вакансии должно быть не меньше 3 символов',
            'name.max' => 'Название вакансии должно быть не больше 33 символов',
            'pay.required' => 'Введите описание оплаты',
            'pay.min' => 'Текст оплаты должно быть не меньше 3 символов',
            'pay.max' => 'Текст оплаты должно быть не больше 33 символов',
            'requirements.max' => 'Текст не должен быть длинее 1024 символов',
            'duties.max' => 'Текст не должен быть длинее 1024 символов',
            'conditions.max' => 'Текст не должен быть длинее 1024 символов',
            'information.max' => 'Текст не должен быть длинее 1024 символов',
            'phone.numeric' => 'Телефон должен состоять только из цифр',
            'email.email' => 'Введите корректный email'
        ]);

        if ( $validator->fails() )
            return back()
                ->withInput()
                ->withErrors ( $validator );

        $user = Auth::user();
        
        $job = $user->company->jobs->keyBy('id')->get($request->id, new Job);

        $job->company_id = $user->company->id;
        $job->name = $request->name;
        $job->pay = $request->pay;
        $job->requirements = $request->requirements;
        $job->duties = $request->duties;
        $job->conditions = $request->conditions;
        $job->information = $request->information;
        $job->phone = $request->phone;
        $job->email = $request->email;
        $job->building_id = $request->building_id;
        $job->save();

        return redirect()->route('office.job.index');

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
        return view('user.job.form', [
            'title' => 'Редактировать вакансию',
            'job' => Auth::user()->company->jobs->keyBy('id')->get($id, new Job)
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
        //
    }

}
