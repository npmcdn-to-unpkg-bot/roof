<?php

namespace App\Http\Controllers\ThePublic;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Tender;

class TenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenders = Tender::orderBy('created_at', 'desc')->paginate(15);
        return view('public.tenders.index', [
            'tenders' => $tenders
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
        return view('public.tenders.show', [
            'tender' => Tender::find($id)
        ]);
    }
}
