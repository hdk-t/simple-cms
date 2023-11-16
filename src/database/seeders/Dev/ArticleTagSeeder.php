<?php

namespace Database\Seeders\Dev;

use App\Models\Article;
use App\Models\Tag;
use App\Models\ArticleTag;
use Illuminate\Database\Seeder;
use Log;

class ArticleTagSeeder extends Seeder
{
    /**
     * 開発用のSeeder
     */
    public function run(): void
    {
        $articleIds = Article::all()->pluck('id')->toArray();
        $allTagIds = Tag::all()->pluck('id')->toArray();
        foreach ($articleIds as $articleId)
        {
            // 設定するタグID
            $tagNum = rand(0, count($allTagIds));
            if($tagNum > 0)
            {
                if($tagNum > 1)
                {
                    $tagIds = array_rand($allTagIds, $tagNum);
                }
                else
                {
                    $tagIds = [ array_rand($allTagIds, 1) ];
                }
                foreach ($tagIds as $tagId)
                {
                    ArticleTag::create([
                        'articles_id' => $articleId,
                        'tags_id'     => $tagId,
                    ]);
                }
            }
        }
    }
}
