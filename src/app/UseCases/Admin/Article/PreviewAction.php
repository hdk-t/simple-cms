<?php

declare(strict_types = 1);

namespace App\UseCases\Admin\Article;

use App\Models\Article;
use App\Models\Picture;
use App\Models\Tag;
use App\UseCases\Article\Entities\ArticleEntity;
use Illuminate\Http\Request;

class PreviewAction
{
    public function __invoke(Request $request): ArticleEntity
    {
        if(is_null($request->articleId))
        {
            $articleEntity = new ArticleEntity(
                articleId:   0,
                pictureUrl:  '',
                title:       $request->title ?? '',
                tags:        Tag::tagIdsToNames($request->tagIds ?? []),
                body:        $request->body ?? '',
                publishedAt: '',
            );
            $articleEntity->bodyToHtml(Picture::all());
            return $articleEntity;
        }
        else
        {
            $article = Article::find($request->articleId);
            $pictureId = $request->pictureId ?? $article->picture_id ?? '';
            $article->picture_id = $pictureId;
            $articleEntity = new ArticleEntity(
                articleId:   $article->id,
                pictureUrl:  $article->picture_url,
                title:       $article->title ?? '',
                tags:        $article->article_tags ?? [],
                body:        $article->body ?? '',
                publishedAt: '',
            );
            $articleEntity->bodyToHtml(Picture::all());
            return $articleEntity;
        }
    }
}
