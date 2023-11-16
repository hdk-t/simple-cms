<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Storage;

class DevSeeder extends Seeder
{
    /**
     * 開発用のSeeder
     */
    public function run(): void
    {
        $this->call([
            ArticleStatusSeeder::class,
        ]);

        $this->call([
            Dev\PictureSeeder::class,
        ]);

        $this->call([
            Dev\TagSeeder::class,
        ]);

        $this->call([
            Dev\ArticleSeeder::class,
        ]);

        $this->call([
            Dev\ArticleTagSeeder::class,
        ]);
    }
}
