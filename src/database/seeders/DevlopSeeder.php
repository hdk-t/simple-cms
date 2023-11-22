<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DevlopSeeder extends Seeder
{
    /**
     * 開発用のSeeder
     */
    public function run(): void
    {
        $this->call([
            Master\ArticleStatusSeeder::class,
        ]);

        $this->call([
            Develop\PictureSeeder::class,
        ]);

        $this->call([
            Develop\TagSeeder::class,
        ]);

        $this->call([
            Develop\ArticleSeeder::class,
        ]);

        $this->call([
            Develop\ArticleTagSeeder::class,
        ]);
    }
}
