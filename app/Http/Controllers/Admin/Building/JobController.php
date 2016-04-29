<?php

namespace App\Http\Controllers\Admin\Building;

use Illuminate\Http\Request;
use App\Company;
use App\Models\Building\Job;
use App\Models\Building\Building;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class JobController extends Controller
{

    protected $table = [
        [
            'field'=>'name',
            'type'=>'text',
            'width'=>'auto',
            'title'=>'Название'
        ],[
            'field'=>'phone',
            'type'=>'text',
            'width'=>'auto',
            'title'=>'Телефон'
        ],[
            'field'=>'email',
            'type'=>'text',
            'width'=>'auto',
            'title'=>'Email'
        ],[
            'field'=>'id',
            'type'=>'actions',
            'width'=>'90px',
            'title'=>''
        ],
    ];

    protected function fields (Job $job) {

        return [
            [
                'name'=>'name',
                'type'=>'text',
                'placeholder'=>'Введите название вакансии',
                'label'=>'Название вакансии',
                'value'=>old() ? old('name') : $job->name
            ],[
                'name'=>'pay',
                'type'=>'text',
                'placeholder'=>'Введите оплату',
                'label'=>'Оплата',
                'value'=>old() ? old('pay') : $job->pay
            ],[
                'name'=>'requirements',
                'type'=>'textarea',
                'placeholder'=>'Введите требования',
                'label'=>'Требования',
                'value'=>old() ? old('requirements') : $job->requirements
            ],[
                'name'=>'duties',
                'type'=>'textarea',
                'placeholder'=>'Введите обязанности',
                'label'=>'Обязанности',
                'value'=>old() ? old('duties') : $job->duties
            ],[
                'name'=>'conditions',
                'type'=>'textarea',
                'placeholder'=>'Введите условия',
                'label'=>'Условия',
                'value'=>old() ? old('conditions') : $job->conditions
            ],[
                'name'=>'information',
                'type'=>'textarea',
                'placeholder'=>'Введите информацию',
                'label'=>'Информация',
                'value'=>old() ? old('information') : $job->information
            ],[
                'name'=>'email',
                'type'=>'text',
                'placeholder'=>'Введите email',
                'label'=>'Email',
                'value'=>old() ? old('email') : $job->email
            ],[
                'name'=>'phone',
                'type'=>'text',
                'placeholder'=>'Введите телефон',
                'label'=>'Телефон',
                'value'=>old() ? old('phone') : $job->phone
            ],[
                'name'=>'seasonality',
                'type'=>'checkbox',
                'label'=>'Сезонная работа.',
                'value'=>old() ? old('seasonality') : $job->seasonality
            ],[
                'name' => 'buildings',
                'type' => 'select_multiple',
                'label' => 'Стройки',
                'values' => old() ? (array)old('buildings') : $job->buildings->lists('id')->all(),
                'options' => Building::lists('name','id')
            ],[
                'name'=>'company_id',
                'type'=>'select',
                'settings'=>'',
                'label'=>'Компания',
                'value'=>old() 
                    ? old('company_id') 
                    : ($job->company ? $job->company->id : ''),
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

        $jobs = Job::paginate(15);

        return view('admin.table', [
            'table' => $this->table,
            'items' => $jobs,
            'title' => 'Вакансии',
            'links' => [
                'show' => 'admin.jobs.show',
                'edit' => 'admin.jobs.edit',
                'delete' => 'admin.jobs.destroy'
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

        $job = new Job;

        return view('admin.form',[
            'title' => 'Добавить новость',
            'action' => 'admin.jobs.store',
            'fields' => $this->fields($job),
            'item' => $job
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
        $validator = Job::validator($request->all());
        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        $job = Job::firstOrNew(['id' => $request->id]);
        $job->fill($request->only('name','pay','requirements','duties','conditions','information','email','phone','seasonality','company_id'));
        $job->save();
        $job->buildings()->sync((array)$request->buildings);

        return redirect()->route('admin.jobs.index');
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

        $job = Job::find($id);

        return view('admin.form',[
            'title' => 'Редактировать вакансию',
            'action' => 'admin.jobs.store',
            'fields' => $this->fields($job),
            'item' => $job
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
        Job::find($id)->delete();

        return back();
    }
}
