<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Database\Seeders\TestSeeder;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(TestSeeder::class);
    }

    public function test_記事一覧表示ができること(): void
    {
        $response = $this->get('/');
        $response->assertStatus(Response::HTTP_OK)
                 ->assertSee('公開タイトル')
                 ->assertSee('/storage/pictures/test_image1.jpg')
                 ->assertSee('#生活情報')
                 ->assertSee('#お買い得情報')
                 ->assertSee('2023年11月12日に公開')
                 ->assertDontSee('下書きタイトル')
                 ->assertDontSee('非公開タイトル')
                 ->assertDontSee('削除済タイトル');
    }
    public function test_記事詳細表示ができること(): void
    {
        $response = $this->get('/articles/1');
        $response->assertStatus(Response::HTTP_OK)
                 ->assertSee('公開タイトル')
                 ->assertSee('storage/pictures/test_image1.jpg')
                 ->assertSee('#生活情報')
                 ->assertSee('#お買い得情報')
                 ->assertSee('2023年11月12日に公開')
                 ->assertSee('公開本文')
                 ->assertSee('storage/pictures/test_image2.jpg');
    }

    public function test_下書きの記事の詳細にアクセスできないこと(): void
    {
        $response = $this->get('/articles/2');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_非公開の記事の詳細にアクセスできないこと(): void
    {
        $response = $this->get('/articles/3');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_削除済の記事の詳細にアクセスできないこと(): void
    {
        $response = $this->get('/articles/4');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
