<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
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
            Test\PictureSeeder::class,
        ]);

        $this->call([
            Test\TagSeeder::class,
        ]);

        $this->call([
            Test\ArticleSeeder::class,
        ]);

        $this->call([
            Test\ArticleTagSeeder::class,
        ]);
    }
}
