<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\ArticleStatus;
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
        $body = '## '.fake()->streetName()."\n".
                fake()->realText()."  \n".
                '[img]'.fake()->numberBetween(1, 10).'[/img]'."  \n".
                '### '.fake()->streetName()."\n".
                fake()->realText()."  \n".
                '[img] '.fake()->numberBetween(1, 10).' [/img]';
        
        $datetime = fake()->dateTimeBetween('-1year', '-1day');
        $createdAt = $datetime->format('Y-m-d H:i:s');
        $publishDate = $datetime->modify('+5hour')->format('Y-m-d H:i:s');
        $updatedAt = $datetime->modify('+5hour')->format('Y-m-d H:i:s');

        $articleStatusIds = ArticleStatus::all()->pluck('id')->toArray();
        $articleStatusId = $articleStatusIds[array_rand($articleStatusIds, 1)];
        if($articleStatusId != ArticleStatus::PUBLISH)
        {
            $publishDate = null;   
        }
        return [
            'title'             => fake()->streetName(),
            'picture_id'        => fake()->numberBetween(1, 10),
            'body'              => $body,
            'published_at'      => $publishDate,
            'article_status_id' => $articleStatusId,
            'created_at'        => $createdAt,
            'updated_at'        => $updatedAt,
        ];
    }
}
