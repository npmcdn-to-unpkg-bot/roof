<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Catalog\Company;
use App\Models\Building\Job;
use App\Models\Building\Building;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class JobController extends Controller
{

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
                'type'=>'price',
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
                'name'=>'speciality',
                'type'=>'text',
                'placeholder'=>'Введите специализацию',
                'label'=>'Специализация',
                'value'=>old() ? old('speciality') : $job->speciality
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
                'options' => auth()->user()->company ? auth()->user()->company->buildings()->lists('name','id') : []
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

        $jobs = auth()->user()->jobs()->paginate(15);
        $th = [
                [
                    'title'=>'Название вакансии',
                    'width'=>'auto',
                ],[
                    'title'=>'Стройки',
                    'width'=>'auto',
                ],[
                    'title'=>'',
                    'width'=>'90px',
                ],
        ];
        $table=collect()->push($th);
        foreach ($jobs as $job){
            $table->push([
                [
                    'field'=>$job->name,
                    'type'=>'text',
                ],[
                    'field'=> $job->buildings,
                    'type'=>'taxonomy',
                ],[
                    'edit' => route('user.jobs.edit', $job),
                    'delete' => route('user.jobs.destroy', $job),
                    'type'=>'actions',
                ],
            ]);
        }
        return view('admin.universal.index', [
            'table' => $table,
            'items' => $jobs,
            'title' => 'Вакансии',
            'pagination' => $jobs->render()
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

        return view('admin.universal.edit',[
            'title' => 'Добавить вакансию',
            'action' => route('user.jobs.store'),
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

        $job = auth()->user()->jobs()->firstOrNew(['id' => $request->id]);
        $job->user_id = auth()->user()->id;

        $job->company_id = auth()->user()->company ? auth()->user()->company->id : '';

        $job->fill($request->only('name','pay','requirements','duties','conditions','information','email','phone','seasonality','speciality'));
        $job->save();
        $job->buildings()->sync((array)$request->buildings);

        return redirect()->route('user.jobs.index');
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

        return view('admin.universal.edit',[
            'title' => 'Редактировать вакансию',
            'action' => route('user.jobs.store'),
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
        auth()->user()->jobs()->where('id', $id)->delete();

        return back();
    }
}
