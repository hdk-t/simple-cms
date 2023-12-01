<?php

declare(strict_types = 1);

namespace App\UseCases\Admin\Article\Entities;

use JsonSerializable;

class SelectPictureEntity implements JsonSerializable
{
    /**
     * @var array<PictureEntity>
     */
    private array $pictureEntities;
    private string|null $nextPageUrl;
    private string|null $previousPageUrl;
    private string|null $currentArticlePictureUrl;

    public function __construct(array       $pictureEntities,
                                string|null $nextPageUrl,
                                string|null $previousPageUrl,
                                string|null $currentArticlePictureUrl)
    {
        $this->pictureEntities          = $pictureEntities;
        $this->nextPageUrl              = $nextPageUrl;
        $this->previousPageUrl          = $previousPageUrl;
        $this->currentArticlePictureUrl = $currentArticlePictureUrl;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'pictureEntities'      => $this->pictureEntities,
            'nextPageUrl'          => $this->nextPageUrl,
            'previousPageUrl'      => $this->previousPageUrl,
        ];
    }
        
    /**
     * @return array<PictureEntity>
     */
    public function pictureEntities(): array
    {
        return $this->pictureEntities;
    }

    public function nextPageUrl(): string|null
    {
        return $this->nextPageUrl;
    }

    public function previousPageUrl(): string|null
    {
        return $this->previousPageUrl;
    }

    public function currentArticlePictureUrl(): string|null
    {
        return $this->currentArticlePictureUrl;
    }
}
