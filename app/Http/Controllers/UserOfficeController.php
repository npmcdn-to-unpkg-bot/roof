<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Company;
use App\User;
use App\Http\Requests;

class UserOfficeController extends Controller
{
    
    public function index () {
    	$user = Auth::user();
    	$company = $user->company;
		return view('user.office', [
			'user' => $user,
			'company' => $company
		]);
    }

 }
