<?php

declare(strict_types = 1);

namespace App\UseCases\Admin\Article\Entities;

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
    private int $articleStatusId;
    private string $articleStatusName;
    private string|null $publishedAt;
    private string $createdAt;
    private string $updatedAt;

    /**
     * @param array<string> $tags
     */
    public function __construct(int         $articleId,
                                string      $pictureUrl,
                                string      $title,
                                int         $articleStatusId,
                                string      $articleStatusName,
                                string|null $publishedAt,
                                string      $createdAt,
                                string      $updatedAt,
                                array       $tags = [],
                                string      $body = '',)
    {
        $this->articleId         = $articleId;
        $this->pictureUrl        = $pictureUrl;
        $this->title             = $title;
        $this->articleStatusId   = $articleStatusId;        
        $this->articleStatusName = $articleStatusName;
        $this->publishedAt       = $publishedAt;
        $this->createdAt         = $createdAt;
        $this->updatedAt         = $updatedAt;
        $this->tags              = $tags;
        $this->body              = $body;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'articleId'               => $this->articleId,
            'pictureUrl'              => $this->pictureUrl,
            'title'                   => $this->title,
            'articleStatusId'         => $this->articleStatusId,
            'articleStatusName'       => $this->articleStatusName,
            'body'                    => $this->body,
            'tags'                    => $this->tags,
            'publishedAt'             => $this->publishedAt,
            'createdAt'               => $this->createdAt,
            'updatedAt'               => $this->updatedAt,
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
        if(is_null($this->publishedAt))
        {
            $this->publishedAt = '';
        }
        else
        {
            $date = new DateTimeImmutable($this->publishedAt);
            $this->publishedAt = $date->format($format);
        }
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
    
    public function articleStatusId(): int
    {
        return $this->articleStatusId;
    }
    public function articleStatusName(): string
    {
        return $this->articleStatusName;
    }
    
    public function publishedAt(): string
    {
        return $this->publishedAt ?? '';
    }

    public function createdAt(): string
    {
        return $this->createdAt;
    }

    public function updatedAt(): string
    {
        return $this->updatedAt;
    }
}
