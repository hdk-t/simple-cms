<?php

namespace Database\Seeders\Dev;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Storage;

class ArticleSeeder extends Seeder
{
    /**
     * 開発用のSeeder
     */
    public function run(): void
    {
        Article::factory()->count(10)->create();
    }
}
