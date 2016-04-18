<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PollController extends Controller
{
    public function vote (Request $request) {
    	Auth::user()->votes()->attach($request->vote);
    	return back();
    }
}
