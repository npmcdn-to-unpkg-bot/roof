<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Models\Library\Post;
use App\Models\Library\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::orderBy('created_at','desc')->paginate(20);

        return view('general.knowladge.library.index',[
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

        return view('general.knowladge.library.show', [
            'post' => $post
        ]);
    }

    public function category($id) {
        $posts = Category::find($id)->posts()->orderBy('created_at','desc')->paginate(20);

        return view('general.knowladge.library.index',[
            'posts' => $posts
        ]);
    }

    public function edit()    { abort(404); }
    public function create()  { abort(404); }
    public function store()   { abort(404); }
    public function delete()  { abort(404); }

}
