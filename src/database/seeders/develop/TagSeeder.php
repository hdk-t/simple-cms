<?php

namespace Database\Seeders\develop;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * 開発用のSeeder
     */
    public function run(): void
    {
        Tag::factory()->count(5)->create();
    }
}
