<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Models\Education\Post;
use App\Models\Education\Category;
use App\Http\Requests;
use App\Models\Tag;
use App\Http\Controllers\Controller;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::query();

        if($request->tag)
            $posts = Tag::where(['name'=>$request->tag])->firstOrNew([])->education_posts();

        $posts = $posts->orderBy('created_at','desc');

        return view('general.knowledge.education.index',[
            'posts' => $posts->paginate(20)
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

        if ($post->price > 0 
            && auth()->user()->company->level < 3)
            abort(404);

        $related_posts = Post::whereHas('tags', function($query) use ($post){
            $query->whereIn('id',$post->tags()->lists('id')->all());
        })
        ->where('id','!=',$post->id)
        ->take(3)
        ->get();

        return view('general.knowledge.education.show', [
            'post' => $post,
            'related_posts' => $related_posts
        ]);
    }

    public function category($id) {
        $posts = Category::find($id)->posts()->orderBy('created_at','desc')->paginate(20);

        return view('general.knowledge.education.index',[
            'posts' => $posts
        ]);
    }

    public function edit()    { abort(404); }
    public function create()  { abort(404); }
    public function store()   { abort(404); }
    public function delete()  { abort(404); }

}
