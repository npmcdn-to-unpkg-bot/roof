<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PublicBuildingController extends Controller
{
    public function index () {
		return view('public.buildings.index');
    }

    public function building ($id) {
		return view('public.buildings.building');
    }
}
