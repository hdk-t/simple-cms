<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\MarkdownParseService;
use App\Models\Picture;

class MarkdownParseServiceTest extends TestCase
{
    public function test_マークダウンと埋め込み画像をHTMLに変換できていること(): void
    {
        $picture = new Picture();
        $picture->id = 12;
        $picture->path = 'pictures/sample_image.jpg';
        $markdownParseService = new MarkdownParseService(collect([$picture]));
        $markdownText = <<<EOF
# タイトル
## サブタイトル
[img]12[/img]
EOF;
        $correctHtml = '<h1>タイトル</h1><h2>サブタイトル</h2><p><img height="400" src="/storage/pictures/sample_image.jpg"></p>';
        $markdownText = $markdownParseService->markdownToHtml($markdownText);
        $markdownText = str_replace("\n", '', $markdownText);
        $this->assertTrue(strcmp($markdownText, $correctHtml) === 0);
    }
    public function test_複数の画像埋め込みコードを変換できること(): void
    {
        $picture1 = new Picture();
        $picture1->id = 12;
        $picture1->path = 'pictures/sample_image1.jpg';
        $picture2 = new Picture();
        $picture2->id = 56;
        $picture2->path = 'pictures/sample_image2.jpg';
        $markdownParseService = new MarkdownParseService(collect([$picture1, $picture2]));
        $markdownText = <<<EOF
# タイトル
## サブタイトル
[img]12[/img]  
[img]56[/img]
EOF;
        $correctHtml = '<h1>タイトル</h1><h2>サブタイトル</h2><p><img height="400" src="/storage/pictures/sample_image1.jpg"><br /><img height="400" src="/storage/pictures/sample_image2.jpg"></p>';
        $markdownText = $markdownParseService->markdownToHtml($markdownText);
        $markdownText = str_replace("\n", '', $markdownText);
        $this->assertTrue(strcmp($markdownText, $correctHtml) === 0);
    }

    public function test_画像埋め込みコードの画像IDの前後に空白が入った場合でも変換できること(): void
    {
        $picture = new Picture();
        $picture->id   = 12;
        $picture->path = 'pictures/sample_image.jpg';
        $markdownParseService = new MarkdownParseService(collect([$picture]));
        $markdownText = <<<EOF
# タイトル
## サブタイトル
[img] 12 [/img]
EOF;
        $correctHtml = '<h1>タイトル</h1><h2>サブタイトル</h2><p><img height="400" src="/storage/pictures/sample_image.jpg"></p>';
        $markdownText = $markdownParseService->markdownToHtml($markdownText);
        $markdownText = str_replace("\n", '', $markdownText);
        $this->assertTrue(strcmp($markdownText, $correctHtml) === 0);
    }

    public function test_画像埋め込みコードが異常の場合は画像を表示しないこと(): void
    {
        $picture = new Picture();
        $picture->id   = 12;
        $picture->path = 'pictures/sample_image.jpg';
        $markdownParseService = new MarkdownParseService(collect([$picture]));
        $markdownText = <<<EOF
# タイトル
## サブタイトル
[img]BadPictureId123[/img]
EOF;
        $correctHtml = '<h1>タイトル</h1><h2>サブタイトル</h2>';
        $markdownText = $markdownParseService->markdownToHtml($markdownText);
        $markdownText = str_replace("\n", '', $markdownText);
        $this->assertTrue(strcmp($markdownText, $correctHtml) === 0);
    }
}
