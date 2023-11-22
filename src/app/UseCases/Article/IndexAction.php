<?php

declare(strict_types = 1);

namespace App\UseCases\Article;

use App\Models\Article;
use App\Models\ArticleStatus;
use App\UseCases\Article\Entities\ArticleEntity;

class IndexAction
{
    /**
     * @return array<ArticleEntity>
     */
    public function __invoke(): array
    {
        $articles = Article::where('article_status_id', ArticleStatus::PUBLISH)
                           ->orderBy('created_at', 'desc')
                           ->get();
                          
        $articleEntities = [];
        foreach ($articles as $article)
        {
            $articleEntity = new ArticleEntity(
                articleId:     $article->id,
                pictureUrl:    $article->picture_url,
                title:         $article->title,
                tags:          $article->article_tags,
                publishedAt:   $article->published_at,
            );
            $articleEntity->publishedAtFormat('Y年m月d日に公開');
            $articleEntities[] = $articleEntity;
        }
        return $articleEntities;
    }
}
