<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Article;

class NewsBlock
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
	public function compose (View $view) {
        $articles = Article::where('market',1)->take(5)->get();
        return $view->with('articles', $articles);
    }
}

