<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'               => fake()->streetName(),
            'pictures_id'         => fake()->numberBetween(1, 10),
            'body'                => '# '.fake()->streetName()."\n".'## '.fake()->realText(),
            'article_statuses_id' => fake()->numberBetween(1, 4),
        ];
    }
}
