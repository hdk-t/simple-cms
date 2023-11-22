<?php

namespace Database\Seeders\test;

use App\Models\Article;
use App\Models\ArticleTag;
use Illuminate\Database\Seeder;

class ArticleTagSeeder extends Seeder
{
    /**
     * 開発用のSeeder
     */
    public function run(): void
    {
        ArticleTag::insert([
            [
                'article_id' => 1,
                'tag_id'     => 1,
            ],
            [
                'article_id' => 1,
                'tag_id'     => 2,
            ],
        ]);
    }
}
