<?php

declare(strict_types = 1);

namespace App\UseCases\Article\Entities;

use App\Models\Picture;
use App\Services\MarkdownParseService;
use Illuminate\Support\Collection;
use DateTimeImmutable;
use JsonSerializable;

class ArticleEntity implements JsonSerializable
{
    private int $articleId;
    private string $pictureUrl;
    private string $title;
    private string $body;
    /**
     * @var array<string>
     */
    private array $tags;
    private string $publishedAt;

    /**
     * @param array<string> $tags
     */
    public function __construct(int $articleId,
                                string $pictureUrl,
                                string $title,                            
                                array $tags,
                                string $publishedAt,
                                string $body = '',)
    {
        $this->articleId = $articleId;
        $this->pictureUrl = $pictureUrl;
        $this->title = $title;
        $this->tags = $tags;
        $this->publishedAt = $publishedAt;
        $this->body = $body;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id'            => $this->articleId,
            'pictureUrl'    => $this->pictureUrl,
            'title'         => $this->title,
            'body'          => $this->body,
            'tags'          => $this->tags,
            'publishedAt'   => $this->publishedAt,
        ];
    }

    /**
     * @param Collection<int, Picture> $pictures
     */
    public function bodyToHtml(Collection $pictures): void
    {
        $markdownParseService = new MarkdownParseService($pictures);
        $this->body = $markdownParseService->markdownToHtml($this->body);
    }

    public function publishedAtFormat(string $format): void
    {
        $date = new DateTimeImmutable($this->publishedAt);
        $this->publishedAt = $date->format($format);
    }

    public function articleId(): int
    {
        return $this->articleId;
    }
    
    public function pictureUrl(): string
    {
        return $this->pictureUrl;
    }
    
    public function title(): string
    {
        return $this->title;
    }

    public function body(): string
    {
        return $this->body;
    }
    
    /**
     * @return array<string>
     */
    public function tags(): array
    {
        return $this->tags;
    }
    
    public function publishedAt(): string
    {
        return $this->publishedAt;
    }
}
