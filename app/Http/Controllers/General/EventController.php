<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Event;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('general.events.index');
    }

    public function calendar($date)
    {
        return view('general.events.index',[
            'current'=>$date
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('general.events.show', [
            'event' => Event::find($id)
        ]);
    }

}
