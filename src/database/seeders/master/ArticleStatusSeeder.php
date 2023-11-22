<?php

namespace Database\Seeders\master;

use App\Models\ArticleStatus;
use Illuminate\Database\Seeder;

class ArticleStatusSeeder extends Seeder
{
    /**
     * 初期データやベースデータを投入するためのSeeder
     * べき等性を保つため必ずPKを指定する必要があります
     */
    public function run(): void
    {
        // articles_statuses
        ArticleStatus::insertOrIgnore([
            ['id'=> 1, 'name'=> '下書き', 'sentence' => '記事下書き中'],
            ['id'=> 2, 'name'=> '公開',   'sentence' => '記事公開中'],
            ['id'=> 3, 'name'=> '非公開', 'sentence' => '一度公開した後に非公開にした'],
            ['id'=> 4, 'name'=> '削除済', 'sentence' => '削除済み の記事'],
        ]);
    }
}
