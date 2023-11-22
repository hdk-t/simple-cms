<?php

namespace Database\Seeders\test;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * 開発用のSeeder
     */
    public function run(): void
    {
        Tag::insert([
            [
                'id'       => 1,
                'name'     => '生活情報',
                'sentence' => '生活情報説明',
            ],
            [
                'id'       => 2,
                'name'     => 'お買い得情報',
                'sentence' => 'お買い得情報説明',
            ],
        ]);
    }
}
