<?php

namespace Database\Seeders\Dev;

use App\Models\Picture;
use Illuminate\Database\Seeder;
use Storage;

class PictureSeeder extends Seeder
{
    /**
     * 開発用のSeeder
     */
    public function run(): void
    {
        Storage::disk('local')->makeDirectory('public/pictures');
        Picture::factory()->count(10)->create();
    }
}
