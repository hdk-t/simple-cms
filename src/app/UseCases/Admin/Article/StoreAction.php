<?php

declare(strict_types = 1);

namespace App\UseCases\Admin\Article;

use DB;
use App\Models\Article;
use App\Models\ArticleStatus;
use App\Models\ArticleTag;
use App\UseCases\Article\Entities\ArticleEntity;
use App\Http\Requests\Admin\ArticleFormRequest;
use Illuminate\Http\Request;

class StoreAction
{
    public function __invoke(ArticleFormRequest $artilceForm): int|null
    {
        try
        {
            DB::beginTransaction();
            $article = Article::create([
                'title'             => $artilceForm->title ?? '',
                'picture_id'        => null,
                'body'              => $artilceForm->body ?? '',
                'article_status_id' => ArticleStatus::DRAFT,
                'published_at'      => null,
            ]);

            foreach($artilceForm->tagIds as $tagId)
            {
                ArticleTag::create([
                    'article_id' => $article->id,
                    'tag_id'     => $tagId,
                ]);
            }
            DB::commit();
        }
        catch(\Exception $e)
        {
            DB::rollback();
            report($e);
        }
        return $article?->id;
    }
}
