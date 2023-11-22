<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\UseCases\Article\IndexAction;
use App\UseCases\Article\ShowAction;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(IndexAction $action): View
    {
        $articles = $action();
        return view('articles.index', [ 'articles' => $articles ]);
    }

    public function show(int $articleId, ShowAction $action): View
    {
        $article = $action($articleId);
        return view('articles.show', [ 'article' => $article ]);
    }
}
