<?php

declare(strict_types = 1);

namespace App\UseCases\Article;

use App\Models\Article;
use App\Models\ArticleStatus;
use App\Models\Picture;
use App\UseCases\Article\Entities\ArticleEntity;

class ShowAction
{
    public function __invoke(int $articleId): ArticleEntity
    {
        $article = Article::where('article_status_id', ArticleStatus::PUBLISH)
                          ->findOrFail($articleId);
        
        $articleEntity = new ArticleEntity(
            articleId:     $article->id,
            pictureUrl:    $article->picture_url,
            title:         $article->title,
            body:          $article->body,
            tags:          $article->article_tags,
            publishedAt:   $article->published_at,
        );
        $articleEntity->bodyToHtml(Picture::all());
        $articleEntity->publishedAtFormat('Y年m月d日に公開');
        return $articleEntity;
    }
}
