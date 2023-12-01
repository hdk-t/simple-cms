<?php

declare(strict_types = 1);

namespace App\UseCases\Admin\Article;

use App\Models\Tag;
use App\UseCases\Admin\Article\Entities\TagEntity;

class CreateAction
{
    /**
     * @return array<TagEntity>
     */
    public function __invoke(): array
    {
        $tags = Tag::all();

        foreach ($tags as $tag)
        {
            $tagEntity = new TagEntity(
                tagId: $tag->id,
                name:  $tag->name,
            );
            $tagEntities[] = $tagEntity;
        }
        return $tagEntities;
    }
}
