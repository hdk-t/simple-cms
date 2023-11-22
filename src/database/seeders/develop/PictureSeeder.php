<?php

namespace Database\Seeders\develop;

use App\Models\Picture;
use Illuminate\Database\Seeder;

class PictureSeeder extends Seeder
{
    /**
     * 開発用のSeeder
     */
    public function run(): void
    {
        Picture::factory()->count(10)->create();
    }
}
