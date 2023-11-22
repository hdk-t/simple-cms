<?php

namespace Database\Seeders\develop;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * 開発用のSeeder
     */
    public function run(): void
    {
        Article::factory()->count(40)->create();
    }
}
