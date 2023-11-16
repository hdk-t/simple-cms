<?php

namespace Database\Seeders\Dev;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Storage;

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
