<?php

namespace Database\Seeders\test;

use App\Models\Picture;
use Illuminate\Database\Seeder;

class PictureSeeder extends Seeder
{
    /**
     * 開発用のSeeder
     */
    public function run(): void
    {
        Picture::insert([
            [
                'id'   => 1,
                'path' => 'pictures/test_image1.jpg',
            ],
            [
                'id'   => 2,
                'path' => 'pictures/test_image2.jpg',
            ],
        ]);
    }
}
