<?php

declare(strict_types = 1);

namespace App\UseCases\Admin\Article;

use App\Models\Picture;
use App\Models\Tag;
use App\UseCases\Article\Entities\ArticleEntity;
use Illuminate\Http\Request;

class CreatePreviewAction
{
    public function __invoke(Request $request): ArticleEntity
    {
        $article = new ArticleEntity(
            articleId:   0,
            pictureUrl:  '',
            title:       $request->title ?? '',
            tags:        Tag::tagIdsToNames($request->tagIds ?? []),
            body:        $request->body ?? '',
            publishedAt: '',
        );
        $article->bodyToHtml(Picture::all());
        return $article;
    }
}
