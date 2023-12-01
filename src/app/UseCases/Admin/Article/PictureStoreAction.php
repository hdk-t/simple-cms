<?php

declare(strict_types = 1);

namespace App\UseCases\Admin\Article;

use App\Models\Article;
use App\Models\ArticleStatus;
use App\Http\Requests\Admin\ArticlePictureFormRequest;
use Carbon\Carbon;

class PictureStoreAction
{
    public function __invoke(ArticlePictureFormRequest $articlePictureForm): bool
    {
        try
        {
            if(is_null($articlePictureForm->pictureId) && strcmp($articlePictureForm->storeType, 'draft') === 0)
            {
                return true;
            }
            if(strcmp($articlePictureForm->storeType, 'draft') === 0):
                Article::where('id', $articlePictureForm->articleId)
                       ->update([
                           'picture_id' => $articlePictureForm->pictureId,
                       ]);
            elseif(strcmp($articlePictureForm->storeType, 'publish') === 0):
                Article::where('id', $articlePictureForm->articleId)
                        ->update([
                            'picture_id'        => $articlePictureForm->pictureId,
                            'article_status_id' => ArticleStatus::PUBLISH,
                            'published_at'      => Carbon::now(),
                        ]);
            endif;
            return true;
        }
        catch(\Exception $e)
        {
            report($e);
            return false;
        }
    }
}
