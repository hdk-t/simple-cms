<?php

declare(strict_types = 1);

namespace App\UseCases\Admin\Article;

use App\Models\Article;
use App\Models\Picture;
use App\UseCases\Admin\Article\Entities\PictureEntity;
use App\UseCases\Admin\Article\Entities\SelectPictureEntity;
use Illuminate\Http\Request;

class PictureCreateAction
{
    public function __invoke(Request $request): SelectPictureEntity
    {
        $pictures = Picture::orderBy('created_at', 'desc')
                           ->simplePaginate(5);

        foreach($pictures as $picture)
        {
            $pictureEntity = new PictureEntity(
                pictureId: $picture->id,
                path:      $picture->path,
            );
            $pictureEntity->pathToUrl();
            $pictureEntities[] = $pictureEntity;
        }

        $selectPictureEntity = new SelectPictureEntity(
            pictureEntities:          $pictureEntities,
            nextPageUrl:              $pictures->nextPageUrl(),
            previousPageUrl:          $pictures->previousPageUrl(),
            currentArticlePictureUrl: null,
        );
        return $selectPictureEntity;
    }
}
