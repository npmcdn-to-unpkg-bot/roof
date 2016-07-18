<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Tag;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = Article::query();

        if ($request->tag) 
            $articles = Tag::where(['name'=>$request->tag])->firstOrNew([])->articles();

        $articles = $articles->orderBy('created_at','desc');

        return view('general.news.index', [
            'articles' => $articles->paginate(15)
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

        $article = Article::find($id);

        if (!$article) abort(404);

        $related_articles = Article::whereHas('tags', function($query) use ($article){
            $query->whereIn('id',$article->tags()->lists('id')->all());
        })
        ->where('id','!=',$article->id)
        ->take(3)
        ->get();

        return view('general.news.show', [
            'article' => $article,
            'related_articles' => $related_articles
        ]);
    }

    public function edit()    { abort(404); }
    public function create()  { abort(404); }
    public function store()   { abort(404); }
    public function delete()  { abort(404); }

}
