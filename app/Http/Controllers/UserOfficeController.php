<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Comp;
use App\User;
use App\Http\Requests;

class UserOfficeController extends Controller
{
    
    public function index () {
    	$user = Auth::user();
    	$comp = $user->comp()->first();
		return view('user.office', [
			'user' => $user,
			'comp' => $comp
		]);
    }

 }
