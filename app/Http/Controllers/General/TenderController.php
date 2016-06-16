<?php

namespace App\Http\Controllers\General;

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
        $tenders = Tender::whereRaw('end >= NOW()')->orderBy('created_at', 'desc')->paginate(15);
        return view('general.tenders.index', [
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

        $tender = Tender::find($id);

        if (!$tender) abort(404);

        return view('general.tenders.show', [
            'tender' => $tender
        ]);
    }


    public function edit()    { abort(404); }
    public function create()  { abort(404); }
    public function store()   { abort(404); }
    public function delete()  { abort(404); }
    
}
