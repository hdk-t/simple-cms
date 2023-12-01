<?php

declare(strict_types = 1);

namespace App\UseCases\Admin\Article\Entities;

use JsonSerializable;

class TagEntity implements JsonSerializable
{
    private int $tagId;
    private string $name;

    public function __construct(int    $tagId,
                                string $name,)
    {
        $this->tagId = $tagId;
        $this->name  = $name;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'tagId'          => $this->tagId,
            'name'           => $this->name,
        ];
    }

    public function tagId(): int
    {
        return $this->tagId;
    }
    
    public function name(): string
    {
        return $this->name;
    }
}
