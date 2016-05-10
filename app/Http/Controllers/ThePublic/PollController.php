<?php

namespace App\Http\Controllers\ThePublic;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Poll;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polls = Poll::orderBy('created_at', 'desc')->paginate(15);
        return view('public.polls.index', [
            'polls' => $polls
        ]);
    }

}
