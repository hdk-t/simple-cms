<?php

declare(strict_types = 1);

namespace App\UseCases\Admin\Article;

use App\Models\Article;
use App\Models\ArticleStatus;
use App\UseCases\Admin\Article\Entities\ArticleEntity;

class IndexAction
{
    /**
     * @return array<ArticleEntity>
     */
    public function __invoke(): array
    {
        $articles = Article::whereNot('article_status_id', ArticleStatus::DELETED)
                           ->orderBy('updated_at', 'desc')
                           ->get();

        foreach ($articles as $article)
        {
            $articleEntity = new ArticleEntity(
                articleId:         $article->id,
                pictureUrl:        $article->picture_url,
                title:             $article->title,
                articleStatusId:   $article->article_status_id,
                articleStatusName: $article->article_status_name,
                publishedAt:       $article->published_at,
                createdAt:         $article->created_at,
                updatedAt:         $article->updated_at,
            );
            $articleEntities[] = $articleEntity;
        }
        return $articleEntities;
    }
}
