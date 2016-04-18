<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Poll;
use Validator;
use App\Vote;
use App\Option;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PollController extends Controller
{

    protected $table = [
        [
            'field'=>'question',
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

    protected function fields (Poll $poll) {

        $votes = [];
        if ( old() ) {
            foreach ( array_filter(old('votes')) as $key => $vote )
                $votes[] = ['id'=>old('votes_id')[$key],'value'=>$vote];
        } else {
            foreach ($poll->votes as $vote)
                $votes[] = ['id'=> $vote->id,'value'=>$vote->answer];
        }
        $votes[]=['id'=>'','value'=>''];

        return [
            [   
                'name'=>'question',
                'type'=>'textarea',
                'placeholder'=>'Введите текст опроса',
                'label'=>'Текст опроса',
                'value'=>old() ? old('question') : $poll->question
            ],[
                'name'=>'votes',
                'type'=>'text_multi',
                'label'=>'Варианты ответа',
                'placeholder'=>'Введите вариант ответа',
                'values'=> $votes
            ],[
                'name'=>'poll_active',
                'type'=>'checkbox',
                'label'=>'Актинвый опрос',
                'value'=> old() 
                    ? old('poll_active') 
                    : Option::where(['name'=>'poll_active', 'value' => $poll->id])->first()
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
        $polls = Poll::paginate(15);

        return view('admin.table', [
            'table' => $this->table,
            'items' => $polls,
            'title' => 'Опросы',
            'links' => [
                'show' => 'admin.polls.show',
                'edit' => 'admin.polls.edit',
                'delete' => 'admin.polls.destroy'
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

        $poll = new Poll;

        return view('admin.form',[
            'title' => 'Добавить опрос',
            'action' => 'admin.polls.store',
            'fields' => $this->fields($poll),
            'item' => $poll
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

        $validator = Validator::make($request->all(), Poll::$rules, Poll::$messages);

        if ($validator->fails())
            return back()->withInput()->withErrors($validator);

        $poll = Poll::firstOrNew(['id' => $request->id])
            ->fill($request->only('question'));
        $poll->save();

        $votes=collect();

        $order=1;

        foreach (array_filter($request->votes) as $key => $answer) {
            $vote = Vote::firstOrNew(['id'=>$request->votes_id[$key]]);
            $vote->answer = $answer;
            $vote->poll_id = $poll->id;
            $vote->order = $order;
            $vote->save();
            $votes->push($vote->id);
            $order++;
        }

        $poll->votes()->whereNotIn('id',$votes)->get()->each(function ($oldvote){
            $oldvote->users()->sync([]);
            $oldvote->delete();
        });

        if ($request->poll_active) {
            Option::firstOrNew(['name' => 'poll_active'])->fill(['value' => $poll->id])->save();
        }else{
            Option::where(['name' => 'poll_active', 'value' => $poll->id])->delete();
        }

        return redirect()->route('admin.polls.index');
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

    $poll = Poll::with('votes')->find($id);

    return view('admin.form',[
            'title' => 'Редактировать опрос',
            'action' => 'admin.polls.store',
            'fields' => $this->fields($poll),
            'item' => $poll
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
        Poll::find($id)->delete();

        return back();
    }
}
