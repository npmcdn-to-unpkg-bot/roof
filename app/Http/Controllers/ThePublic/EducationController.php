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
        $posts = Post::paginate(20);
        $categories = Category::all();

        return view('public.education.index',[
            'categories' => $categories,
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
        return view('public.education.show', [
            'post' => Post::find($id)
        ]);
    }

    public function category($id) {
        $posts = Category::find($id)->posts()->paginate(20);
        $categories = Category::all();

        return view('public.education.index',[
            'categories' => $categories,
            'posts' => $posts
        ]);
    }

}
