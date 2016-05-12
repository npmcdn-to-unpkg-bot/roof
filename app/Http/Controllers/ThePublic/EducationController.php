<?php

namespace App\Http\Controllers\ThePublic;

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

        return view('public.knowladge.education.index',[
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
        return view('public.knowladge.education.show', [
            'post' => Post::find($id)
        ]);
    }

    public function category($id) {
        $posts = Category::find($id)->posts()->orderBy('created_at','desc')->paginate(20);

        return view('public.knowladge.education.index',[
            'posts' => $posts
        ]);
    }

}
