<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Admin;

use App\UseCases\Article\Entities\ArticleEntity;
use App\UseCases\Admin\Article\IndexAction;
use App\UseCases\Admin\Article\CreateAction;
use App\UseCases\Admin\Article\CreatePreviewAction;
use App\UseCases\Admin\Article\PictureCreateAction;
use App\UseCases\Admin\Article\StoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleFormRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ArticleController extends Controller
{
    public function index(IndexAction $action): View
    {
        $articles = $action();
        return view('admin.articles.index', ['articles' => $articles]);
    }

    public function create(CreateAction $action): View
    {
        $tags = $action();
        return view('admin.articles.create', ['tags' => $tags]);
    }
    
    public function createPreview(Request $request, CreatePreviewAction $action): View
    {
        $article = $action($request);
        return view('articles.show', ['article' => $article]);
    }

    public function store(ArticleFormRequest $articleForm, StoreAction $action): RedirectResponse
    {
        $articleId = $action($articleForm);
        
        if(strcmp($articleForm->storeType, 'draft') === 0 && !is_null($articleId))
        {
            session()->flash('admin_flash_message', '記事を下書き保存しました。');
            return redirect()->route('admin.articles.index');
        }
        elseif(strcmp($articleForm->storeType, 'next') === 0 && !is_null($articleId))
        {
            return redirect()->route('admin.articles.pictures.create', ['articleId' => $articleId]);
        }
        else
        {
            session()->flash('admin_flash_message', '記事の保存に失敗しました。');
            return redirect()->route('admin.articles.index');
        }
    }

    public function pictureCreate(Request $request, PictureCreateAction $action)
    {
        $pictures = $action($request);
        return view('admin.articles.pictures.create', ['pictures' => $pictures]);
    }
}
