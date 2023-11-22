<?php

namespace Database\Seeders\test;

use App\Models\Article;
use App\Models\ArticleStatus;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * 開発用のSeeder
     */
    public function run(): void
    {
        Article::insert([
            [
                'id'                => 1,
                'title'             => '公開タイトル',
                'picture_id'        => 1,
                'body'              => '公開本文 [img]2[/img]',
                'article_status_id' => ArticleStatus::PUBLISH,
                'published_at'      => '2023-11-12 16:35:25',
            ],
            [
                'id'                => 2,
                'title'             => '下書きタイトル',
                'picture_id'        => 1,
                'body'              => '下書き本文',
                'article_status_id' => ArticleStatus::DRAFT,
                'published_at'      => null,
            ],
            [
                'id'                => 3,
                'title'             => '非公開タイトル',
                'picture_id'        => 1,
                'body'              => '非公開本文',
                'article_status_id' => ArticleStatus::UNPUBLISHED,
                'published_at'      => '2023-11-15 19:45:12',
            ],
            [
                'id'                => 4,
                'title'             => '削除済タイトル',
                'picture_id'        => 1,
                'body'              => '削除済本文',
                'article_status_id' => ArticleStatus::DELETED,
                'published_at'      => '2023-1-19 10:21:42',
            ],
        ]);
    }
}
