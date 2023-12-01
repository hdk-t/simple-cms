<?php

declare(strict_types = 1);

namespace App\UseCases\Admin\Article\Entities;

use JsonSerializable;
use Storage;

class PictureEntity implements JsonSerializable
{
    private int $pictureId;
    private string $path;

    public function __construct(int    $pictureId,
                                string $path,)
    {
        $this->pictureId = $pictureId;
        $this->path      = $path;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'pictureId' => $this->pictureId,
            'path'      => $this->path,
        ];
    }

    public function pathToUrl(): void
    {
        $this->path = Storage::url($this->path);
    }

    public function pictureId(): int
    {
        return $this->pictureId;
    }
    
    public function path(): string
    {
        return $this->path;
    }
}
