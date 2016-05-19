<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Models\Education\Post;
use App\Models\Education\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(20);

        return view('general.knowladge.education.index',[
            'posts' => $posts
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
        $post = Post::find($id);

        if (!$post) abort(404);

        return view('general.knowladge.education.show', [
            'post' => $post
        ]);
    }

    public function category($id) {
        $posts = Category::find($id)->posts()->orderBy('created_at','desc')->paginate(20);

        return view('general.knowladge.education.index',[
            'posts' => $posts
        ]);
    }

    public function edit()    { abort(404); }
    public function create()  { abort(404); }
    public function store()   { abort(404); }
    public function delete()  { abort(404); }

}
